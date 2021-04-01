<?php

namespace Drupal\airchoice_member\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Stripe\Charge;
use Stripe\Error\Base as StripeBaseException;
use Stripe\Stripe;
use Drupal\airchoice_member\AirchoiceMember;

/**
* Class UserRegisterForm.
*/
class UserRegisterForm extends FormBase {
  
  /**
  * {@inheritdoc}
  */
  public function getFormId() {
    return 'airchoice_user_register_form';
  }
  
  public function checkUserName($form, FormStateInterface $form_state)
  {
    return ['#markup' => '<div id="error-username">Error</div>'];
  }
  
  /**
  * {@inheritdoc}
  */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#theme'] = 'form__register_member';
    


    

    // ddefaulte user form 
    $entity = \Drupal::entityTypeManager()->getStorage('user')->create(array());
    $formObject = \Drupal::entityTypeManager()
    ->getFormObject('user', 'register')
    ->setEntity($entity);
    $form2 = \Drupal::formBuilder()->getForm($formObject);
    
    if (!class_exists('Stripe\Stripe')) {
      drupal_set_message("Stripe installtion required", 'error');
      $form['msg']['#markup'] = "Stripe is not installed on site.";
      return $form;
    }
    
    
    $package_id = $_GET['package']??null;
    $package = \Drupal\node\Entity\Node::load($package_id);
    if(!$package || $package->bundle() !== 'package')
    {
      $form['msg']['#markup'] = 'Package not found';
      return $form;
    }
    
    $price = $package->field_price->value;
    
    $form_state->set('price', $price);
    
    $link_generator = \Drupal::service('link_generator');
    
    
    $form['package'] = [
      '#type' => 'hidden',
      '#value' => $package_id,
    ];
    
    $form['first'] = [
      '#title' => $this->t("First Name"),
      '#type' => 'textfield',
      '#required' => true
    ];
    
    // $form['last'] = [
      //   '#title' => $this->t("Last Name"),
      //   '#type' => 'textfield',
      //   '#required' => true
      // ];
      
      $form['account'] = [
        "#type" => "container",
      ];
      $form['account']['email'] = [
        '#title' => $this->t('Email address'),
        "#type" => "email",
        "#required" => "1",
      ];
      
      
      
      $form['price'] = [
        '#title' => $this->t("Price"),
        '#type' => 'textfield',
        '#value' => $price,
        '#disabled' => true
      ];
      
      $form['stripe'] = [
        '#type' => 'stripe',
        '#title' => $this->t('Credit card'),
        // The selectors are gonna be looked within the enclosing form only.
        "#stripe_selectors" => [
          'first_name' => ':input[name="first"]',
          'last_name' => ':input[name="last"]',
        ],
        '#description' => $this->t('You can use test card numbers and tokens from @link.', [
          '@link' => $link_generator->generate('stripe docs', Url::fromUri('https://stripe.com/docs/testing')),
          ]),
        ];
        
        $form['username'] = [
          '#title' => 'Username',
          '#type' => 'textfield',
          '#default_value' => $form_state->getValue('username'),
          '#required' => true
        ];
        $form['last_name'] = [
          '#title' => 'Lastname',
          '#type' => 'textfield',
          '#default_value' => $form_state->getValue('last_name'),
          '#required' => true
        ];
        $form['company'] = [
          '#title' => 'Company',
          '#type' => 'textfield',
          '#default_value' => $form_state->getValue('company'),
          '#required' => true
        ];
        $form['phone'] = [
          '#title' => 'Phone',
          '#type' => 'textfield',
          '#default_value' => $form_state->getValue('phone'),
          '#required' => true
        ];
        $form['loyalty_id'] = [
          '#title' => 'Loyalty ID',
          '#type' => 'textfield',
          '#default_value' => $form_state->getValue('loyalty_id'),
          
        ];

        $form['membership_type'] =  [
          '#type' => 'select',
          '#title' => $form2['membership_type']['widget']['#title'],
          '#options' => $form2['membership_type']['widget']['#options'],
          '#default_value' => $form_state->getValue('membership_type', ''),
        ];

        $form['membership_type']['#default_value'] = $form_state->getValue('membership_type', '');

        //add other fields here
        



        $form['sms_text'] = [
          '#title' => 'SMS/Text',
          '#type' => 'checkbox',
          '#default_value' => 0,
          
        ];
        $form['email_notified'] = [
          '#title' => 'Email',
          '#type' => 'checkbox',
          '#default_value' => 0,
          
        ];
        $form['month'] = [
          '#title' => 'Month',
          '#type' => 'textfield',
          '#default_value' => $form_state->getValue('month'),
          '#required' => true
        ];
        $form['day'] = [
          '#title' => 'Day',
          '#type' => 'textfield',
          '#attributes' => ['type' => 'number'] , 
          '#default_value' => $form_state->getValue('day'),
          '#required' => true
        ];
        $form['year'] = [
          '#title' => 'Year',
          '#type' => 'textfield',
          '#attributes' => ['type' => 'number'] , 
          '#default_value' => $form_state->getValue('year'),
          '#required' => true
        ];
        $form['role'] = [
          '#title' => 'Role',
          '#type' => 'textfield',
          '#default_value' => $form_state->getValue('role'),
          
        ];

        $form['address'] = [
          '#type' => 'address',
          '#title' => "Address",
          '#field_overrides' => [
            "givenName" => "hidden", 
            "additionalName" => "hidden", 
            "familyName" => "hidden", 
            "organization" => "hidden", 
            "postalCode" => "optional", 
            "sortingCode" => "hidden", 
            "dependentLocality" => "optional", 
            "locality" => "optional", 
            "administrativeArea" => "optional",
            ] 
          ];
        
        
        
        $form['submit'] = [
          '#type' => 'submit',
          '#value' => $this->t('Submit'),
        ];
        
        if ($this->checkTestStripeApiKey()) {
          $form['submit']['#value'] = $this->t('Pay $'.$price);
        }
        
        $form['#attached']['library'][] = 'airchoice_stripe/custom';
        
        return $form;
      }
      
      public function validateForm(array &$form, FormStateInterface $form_state) {
        $email = $form_state->getValue('email');
        if(!$email)
        {
          $form_state->setErrorByName('email', 'Email required.');
        }else{
          $user = user_load_by_mail($email);
          if($user)
          {
            $form_state->setErrorByName('email', 'Email already exits');
          }
        }

        $username = $form_state->getValue('username');
        if(!$username)
        {
          $form_state->setErrorByName('username', 'Username required.');
        }else{
          $user = user_load_by_name($username);
          if($user)
          {
            $form_state->setErrorByName('username', 'Username already exits');
          }
        }
        
        parent::validateForm($form, $form_state);
      }
      
      /**
      * {@inheritdoc}
      */
      public function submitForm(array &$form, FormStateInterface $form_state) {
    
        $price = $form_state->get('price');

        $last_name = $form_state->getValue('last_name');

        
        $membership_type = $form_state->getValue('membership_type');
      
        // $address = $form_state->getValue('address');
        
        $email = $form_state->getValue('email');
        $first = $form_state->getValue('first');
        $package = $form_state->getValue('package');
        $username = $form_state->getValue('username');  
        $company = $form_state->getValue('company');  
        $phone = $form_state->getValue('phone');  
        $role = $form_state->getValue('role');  
        $loyalty_id = $form_state->getValue('loyalty_id');  
        $sms_text = $form_state->getValue('sms_text');  
        $email_notified = $form_state->getValue('email_notified');  
        $month = $form_state->getValue('month');  
        $day = $form_state->getValue('day');  
        $year = $form_state->getValue('year');  
        $email_name = explode("@", $email, 2)[0];

        // send email custom 
      $params = [ ];
      $params['subject'] = $this->t('Thanks to registered on Air one Choice ');
      $params['body'] = [$this->t('Test message , your Username is '.$username.' and password ')];
      customMailSend('nav@yopmail.com',implode("\r\n", $params));
      
        // do{
        //   $username = $email_name.'_'. substr(uniqid(), -5) ;
        // }while(user_load_by_name($username));
        
        //create user
        $user = \Drupal\user\Entity\User::create();
        $user->setEmail($email);
        $user->setUsername($username);
        $user->enforceIsNew();
        $user->set('init', 'email');
        

        $user->first_name->setValue($first);
        $user->last_name->setValue($last_name); 

        // $user->address->setValue($address);
        $user->company->setValue($company);
        $user->day->setValue($day);
        $user->month->setValue($month);
        $user->email_notified->setValue($email_notified);
        $user->loyalty_id->setValue($loyalty_id);
        $user->membership_type->setValue($membership_type);
        $user->phone->setValue($phone);
        $user->role->setValue($role);
        $user->sms_text->setValue($sms_text);
        $user->year->setValue($year);
        
        $user->save();
        
        $profile = \Drupal\profile\Entity\Profile::create([
          'type' => 'paid_member',
          'uid' => $user->id(),
          'field_package' => $package
          ]);
          
          $profile->setDefault(TRUE);
          $profile->save();
          
          if ($this->checkTestStripeApiKey()) {
            // Make test charge if we have test environment and api key.
            $stripe_token = $form_state->getValue('stripe');
            $charge = $this->createCharge($stripe_token, $price);
            if ($charge) {
              $this->messenger()->addStatus('Charge status: ' . $charge->status);
              if ($charge->status == 'succeeded') {
                
                //create user here
                $user->addRole('paid_member');
                $user->save();
                $link_generator = \Drupal::service('link_generator');
                $this->messenger()->addStatus($this->t('Please check payments in @link.', [
                  '@link' => $link_generator->generate('stripe dashboard', Url::fromUri('https://dashboard.stripe.com/test/payments')),
                  ]));
                }
              }
            }
            // Display result.
            foreach ($form_state->getValues() as $key => $value) {
              $this->messenger()->addStatus($key . ': ' . $value);
            }
            
          }
          
          /**
          * Helper function for making sure stripe key is set for test and has the necessary keys.
          */
          private function checkTestStripeApiKey() {
            $status = FALSE;
            $config = \Drupal::config('stripe.settings');
            if ($config->get('environment') == 'test' && $config->get('apikey.test.secret')) {
              $status = TRUE;
            }
            return $status;
          }
          
          /**
          * Helper function for test charge.
          *
          * @param string $stripe_token
          *   Stripe API token.
          * @param int $amount
          *   Amount for charge.
          *
          * @return /Stripe/Charge
          *   Charge object.
          */
          private function createCharge($stripe_token, $amount) {
            try {
              $config = \Drupal::config('stripe.settings');
              Stripe::setApiKey($config->get('apikey.test.secret'));
              $charge = Charge::create([
                'amount' => $amount * 100,
                'currency' => 'usd',
                'description' => "Example charge",
                'source' => $stripe_token,
                ]);
                return $charge;
              }
              catch (StripeBaseException $e) {
                $this->messenger()->addError($this->t('Stripe error: %error', ['%error' => $e->getMessage()]));
              }
            }
            
          }
          