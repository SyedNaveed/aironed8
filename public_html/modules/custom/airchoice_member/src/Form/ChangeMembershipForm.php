<?php

namespace Drupal\airchoice_member\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\airchoice_member\AirchoiceMember;
use Stripe\Stripe;
use Stripe\Error\Base as StripeBaseException;
use Stripe\Charge;




/**
* Class ChangeMembershipForm.
*/
class ChangeMembershipForm extends FormBase {
  
  /**
  * {@inheritdoc}
  */
  public function getFormId() {
    return 'change_membership_form';
  }
  
  /**
  * {@inheritdoc}
  */
  public function buildForm(array $form, FormStateInterface $form_state) {
    //get current user info packages, etc
    $uid = \Drupal::currentUser()->id();
    if(!$uid)
    {
      
      return ['access denied'=>['#markup'=>'Access denied']];
      exit;
    }
    $userData = AirchoiceMember::getBasicProfileInfo($uid);
    list('user'=>$user,
    'profile'=>$profile,
    'package'=>$package,
    'package_max_members'=>$package_max_members,
    'canAddMoreMembers'=>$canAddMoreMembers
    ) = $userData;
    
    $package_price = $package->field_price->value;
   
    $amount_remaining = $user->amount_remaining->value;

    if(!$amount_remaining)
    {
      $amount_remaining = 0;
    }
    
    //get profile creation date
    $startTime =  $profile->getCreatedTime();
    
    $now = new \DateTime();
    $date2 = new \DateTime();
    $date2->setTimestamp($startTime);
    
    
    $diff = date_diff($date2, $now);
    $days = $diff->format('%a');
    $left = 365 - $days;
    if($left > 0)
    {
      $priceRemaining = $package_price*$left/365;
    }else
    {
      $priceRemaining = 0;
    }

 
    $priceRemaining += $amount_remaining;
 
    
    $form['daysRemaining'] = [
      '#type' => 'textfield',
      '#value' => $left,
      '#title' => 'Days Remaining'
    ];
    $form['priceRemaining'] = [
      '#type' => 'textfield',
      '#value' => $priceRemaining,
      '#title' => 'Price Remaining'
    ];
    
    $form_state->set('priceRemaining', $priceRemaining);
    $form_state->set('left', $left);
    
    $nids = \Drupal::entityQuery('node')->condition('type','package')->execute();
    $nodes =  \Drupal\node\Entity\Node::loadMultiple($nids);
    
    $form['packages'] = views_embed_view('front_page_packages', 'block_2');
    
    
    $packagesPrice = [];
    
    $options = [];
    $form['package'] = [
      '#type' => 'radios',
      '#required' => 'true',
      '#options' => &$options
    ];
    foreach($nodes as $node)
    {
      if($node->id() == $package->id())
      {
        $form['package']['#option_attributes'][$node->id()]['disabled'] = 'true';
      }
      $packagesPrice[$node->id()] = $node->field_price->value;
      $options[$node->id()] = $node->getTitle() . "($" . round($node->field_price->value, 2) . ") to pay $".($node->field_price->value - $priceRemaining);
    }
    $form_state->set('packagesPrice', $packagesPrice);
    
    
    $form['stripe'] = [
      '#type' => 'stripe',
      '#title' => $this->t('Credit card'),
      // The selectors are gonna be looked within the enclosing form only.
      "#stripe_selectors" => [
        // 'first_name' => ':input[name="first"]',
        // 'last_name' => ':input[name="last"]',
      ],
      '#description' => $this->t('You can use test card numbers and tokens from @link.', [
        // '@link' => $link_generator->generate('stripe docs', Url::fromUri('https://stripe.com/docs/testing')),
        ]),
      ];
      
      
      
      $form['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Submit'),
      ];
      
      return $form;
    }
    
    /**
    * {@inheritdoc}
    */
    public function validateForm(array &$form, FormStateInterface $form_state) {
      foreach ($form_state->getValues() as $key => $value) {
        // @TODO: Validate fields.
      }
      parent::validateForm($form, $form_state);
    }
    
    /**
    * {@inheritdoc}
    */
    public function submitForm(array &$form, FormStateInterface $form_state) {
      $packagesPrice = $form_state->get('packagesPrice');
      $priceRemaining = $form_state->get('priceRemaining');
      $left = $form_state->get('left');
      
      $uid = \Drupal::currentUser()->id();
      $user = \Drupal\user\Entity\User::load($uid);
      
      $amount_remaining = $user->amount_remaining->value;
      if(!$amount_remaining)
      {
        $amount_remaining = 0;
      }
      
      $packageSelected = $form_state->getValue('package');
      $packagePrice = $packagesPrice[$packageSelected];
      
      $priceToPay = $packagePrice - $priceRemaining;
      
      if($priceToPay <= 0)
      {
        $amount_remaining = -$priceToPay;
        
        $user->amount_remaining->setValue($amount_remaining);
        $user->save();
        
        $profile = \Drupal\profile\Entity\Profile::create([
          'type' => 'paid_member',
          'uid' => $uid,
          'field_package' => $packageSelected
          ]);
          
          //add condition on downgrade
          $profile->setDefault(TRUE);
          $profile->save();
          return;
        }

        $amount_remaining = 0;
        
        $user->amount_remaining->setValue($amount_remaining);
        $user->save();
        
        
        if ($this->checkTestStripeApiKey()) {
          // Make test charge if we have test environment and api key.
          $stripe_token = $form_state->getValue('stripe');
          $charge = $this->createCharge($stripe_token, round($priceToPay));
          if ($charge) {
            $this->messenger()->addStatus('Charge status: ' . $charge->status);
            if ($charge->status == 'succeeded') {
              
              $profile = \Drupal\profile\Entity\Profile::create([
                'type' => 'paid_member',
                'uid' => $uid,
                'field_package' => $packageSelected
                ]);
                
                //add condition on downgrade
                $profile->setDefault(TRUE);
                $profile->save();
                
                //create user here
                // $user->addRole('paid_member');
                // $user->save();
                $link_generator = \Drupal::service('link_generator');
                $this->messenger()->addStatus($this->t('Please check payments in @link.', [
                  '@link' => $link_generator->generate('stripe dashboard', \Drupal\core\Url::fromUri('https://dashboard.stripe.com/test/payments')),
                  ]));
                }
              }
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
          