<?php

namespace Drupal\airchoice_member\Form;
use Drupal\airchoice_member\AirchoiceMember;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
* Class AddMemberForm.
*/
class AddMemberForm extends FormBase {
  
  /**
  * {@inheritdoc}
  */
  public function getFormId() {
    return 'add_member_form';
  }
  
  /**
  * {@inheritdoc}
  */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#attached']['library'][] = 'airchoice_member/test1';
    $form['#theme'] = 'form__add_member';

     

    // $form['address'] = [
    //   '#type' => 'address',
    // ];


 
    // $form['#prefix'] = '<div id="myform">Myform';
    // $form['#suffix'] = '</div>';
    $uid = \Drupal::currentUser()->id();
    $userData = AirchoiceMember::getBasicProfileInfo($uid);
    list('user'=>$user,
    'profile'=>$profile,
    'package'=>$package,
    'package_max_members'=>$package_max_members,
    'canAddMoreMembers'=>$canAddMoreMembers) = $userData;
    
    
    if(!$canAddMoreMembers)
    {
      return ['#markup'=> "Can't add more members. Package members limit is ".$package_max_members];
    }
    
    
    
    $email = $form_state->get('email');
    $form['email'] = [
      '#title' => 'Email',
      '#type' => 'email',
      '#default_value' => $form_state->getValue('email',''),
      '#disabled' => $email?true:false,
      '#required' => true
    ];
    if($email){

          // ddefaulte user form 
    $entity = \Drupal::entityTypeManager()->getStorage('user')->create(array());
    $formObject = \Drupal::entityTypeManager()
    ->getFormObject('user', 'register')
    ->setEntity($entity);
    $form2 = \Drupal::formBuilder()->getForm($formObject);

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
      

      $form['address'] = $form2['address'];
      

      
      

    }
    
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#ajax' =>[
        'callback' => '::myAjaxCallback',
        'wrapper' => 'myform',
        'progress' => [
          'type' => 'throbber',
          'message' => 'Please wait',
        ],
        ]
      ];
      return $form;
    }
    
    public function myAjaxCallback(&$form, $form_state)
    {
      if($form_state->get("doneSuccess"))
      {
        $response = new \Drupal\Core\Ajax\AjaxResponse();
        $response->addCommand(new \Drupal\Core\Ajax\InvokeCommand(NULL, 'reloadPage', ['manage-members']));
        return $response;
        

      }
      return $form;
    }
    
    /**
    * {@inheritdoc}
    */
    public function validateForm(array &$form, FormStateInterface $form_state) {
      
      $email = $form_state->get('email');
      
      if(!$email)
      {
        $email = $form_state->getValue('email');
        $user = user_load_by_mail($email);
        if($user)
        {
          $form_state->setErrorByName('email', 'Email already exits');
        }
      }else{
        $username = $form_state->getValue('username');
   
        $user = \Drupal\user\Entity\User::create();
        $user->setEmail($email);
        $user->setUsername($username);
        $user->set("init", $email);
        $user->enforceIsNew();
        $validate = $user->validate();
        
        if(count($validate))
        {
          //remove below line
          $form_state->set('newUser', $user);

          // $form_state->setErrorByName('username', $validate->get(0)->getMessage());
        }else{
          $form_state->set('newUser', $user);
        }
      }
      parent::validateForm($form, $form_state);
    }
    
    /**
    * {@inheritdoc}
    */
    public function submitForm(array &$form, FormStateInterface $form_state) {
      $form_state->setRebuild(true);
      if(!$form_state->get('email'))
      {
        $form_state->set('email', $form_state->getValue('email'));
      }else{
        
        
        $uid = \Drupal::currentUser()->id();
        $user = \Drupal\user\Entity\User::load($uid);

        
        $profiles = $user->paid_member_profiles->referencedEntities();
        $profile = $profiles[0];
        $old  = $profile->field_mem->getValue();
        
        $newUser = $form_state->get('newUser');

        //!TODO save user fields
        $passcustom = randomPassword1();
        $ncuser = $form_state->getValue('username');
        $email = $form_state->get('email');
        // send email custom
        $params = [];
        $params['subject'] = $this->t('Thanks to registered on Air one Choice ');
         $params['body'] = [$this->t("Your mail @email registered on site.\n you can now login using username:'@username' and password:'@password'", ['@email'=>$email, '@username'=>$ncuser, '@password'=>$passcustom])];

        customMailSend($email,'register', $params);
          // user status active 
          $newUser->status= 1;
          $newUser->activate(); 
          // save password 
          $newUser->setPassword($passcustom);
          $newUser->save();
        
        
        $old[] = ['target_id'=>$newUser->id()];
        $profile->field_mem->setValue($old);
        $profile->save();
        drupal_set_message("User added to package");
        $form_state->set('doneSuccess', true);
        $form_state->setRebuild(false);
        
      }
    }
    
  }
  