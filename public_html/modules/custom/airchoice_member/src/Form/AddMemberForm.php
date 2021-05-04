<?php

namespace Drupal\airchoice_member\Form;
use Drupal\airchoice_member\AirchoiceMember;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;
use CommerceGuys\Addressing\AddressFormat\AddressField;
use Drupal\address\Event\AddressEvents;

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
  public function buildForm(array $form, FormStateInterface $form_state, User $subUser=null) {
    
    $is_edit = false;
    
    $uid = \Drupal::currentUser()->id();
    $userData = AirchoiceMember::getBasicProfileInfo($uid);
    list('user'=>$user,
    'profile'=>$profile,
    'package'=>$package,
    'package_max_members'=>$package_max_members,
    'members_value' => $members_value,
    'canAddMoreMembers'=>$canAddMoreMembers) = $userData;
    
    if($subUser)
    {
      //check for permission that current user is sub user of this user
      $is_my_sub = false;
      foreach($members_value as $member)
      {
        if($member['target_id'] == $subUser->id())
        {
          $is_my_sub = true;
          break;
        }
      }
      if(!$is_my_sub)
      {
        throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
      }
      
      $is_edit = true;
      $form_state->set('uid', $subUser->id());
    }
    $form_state->set('is_edit', $is_edit);
    
    $form['#attached']['library'][] = 'airchoice_member/test1';
    $form['#theme'] = 'form__add_member';
    
    
    
    if(!$canAddMoreMembers && !$is_edit)
    {
      return ['#markup'=> "Can't add more members. Package members limit is ".$package_max_members];
    }
    
    
    $lastName = $is_edit?$subUser->last_name->getValue():[];  
    $lastName = isset($lastName[0])?$lastName[0]:'';
    $subUserAddress = $is_edit?$subUser->address->getValue():null;
    $subUserAddress = isset($subUserAddress[0])?$subUserAddress[0]:[
      'country_code' => 'US',
      'address_line1' => '',
      'address_line2' => '',
      'locality' => '',
      'administrative_area' => '',
      'postal_code' => '',
    ];
    
    $defaults = [
      'email' => $form_state->getValue('email', $is_edit?$subUser->getEmail():''),
      'username' => $form_state->getValue('username', $is_edit?$subUser->getUsername():''),
      'last_name' => $form_state->getValue('last_name', $is_edit?$lastName:''),
      'company' => $form_state->getValue('company', $is_edit?$subUser->company->value:''),
      'phone' => $form_state->getValue('phone', $is_edit?$subUser->phone->value:''),
      'loyalty_id' => $form_state->getValue('loyalty_id', $is_edit?$subUser->loyalty_id->value:''),
      'sms_text' => $form_state->getValue('sms_text', $is_edit?$subUser->sms_text->value:''),
      'email_notified' => $form_state->getValue('email_notified', $is_edit?$subUser->email_notified->value:''),
      'role' => $form_state->getValue('role', $is_edit?$subUser->role ->value:''),
      'address' => $form_state->getValue('address', $subUserAddress),
      'month' => $form_state->getValue('month', $is_edit?$subUser->month->value:''),
      'day' => $form_state->getValue('day', $is_edit?$subUser->day ->value:''),
      'year' => $form_state->getValue('year', $is_edit?$subUser->year ->value:''),
    ];
    
    
    
    
    $email = $form_state->get('email');
    $form['email'] = [
      '#title' => 'Email',
      '#type' => 'email',
      '#default_value' => $defaults['email'],
      '#disabled' => $email || $is_edit?true:false,
      '#required' => true
    ];
    if($email || $is_edit){
      
      // ddefaulte user form 
      $entity = $subUser?$subUser:\Drupal::entityTypeManager()->getStorage('user')->create(array());
      $formObject = \Drupal::entityTypeManager()
      ->getFormObject('user', 'register')
      ->setEntity($entity);
      $form2 = \Drupal::formBuilder()->getForm($formObject);
      
      $form['username'] = [
        '#title' => 'Username',
        '#type' => 'textfield',
        '#disabled' => $is_edit?true:false,
        '#default_value' => $defaults['username'],
        '#required' => true
      ];
      $form['last_name'] = [
        '#title' => 'Lastname',
        '#type' => 'textfield',
        '#default_value' => $defaults['last_name'],
        '#required' => true
      ];
      $form['company'] = [
        '#title' => 'Company',
        '#type' => 'textfield',
        '#default_value' => $defaults['company'],
        '#required' => true
      ];
      $form['phone'] = [
        '#title' => 'Phone',
        '#type' => 'textfield',
        '#default_value' => $defaults['phone'],
        '#required' => true
      ];
      $form['loyalty_id'] = [
        '#title' => 'Loyalty ID',
        '#type' => 'textfield',
        '#default_value' => $defaults['loyalty_id'],
        
      ];
      
      $form['membership_type'] =  [
        '#type' => 'select',
        '#title' => $form2['membership_type']['widget']['#title'],
        '#disabled' => true,
        // '#options' => $form2['membership_type']['widget']['#options'],
        // '#default_value' => $form_state->getValue('membership_type', ''),
      ];
      
      $form['sms_text'] = [
        '#title' => 'SMS/Text',
        '#type' => 'checkbox',
        '#default_value' => $defaults['sms_text'],
        
      ];
      $form['email_notified'] = [
        '#title' => 'Email',
        '#type' => 'checkbox',
        '#default_value' => $defaults['email_notified'],
        
      ];
      $form['month'] = [
        '#title' => 'Month',
        '#type' => 'textfield',
        '#default_value' => $defaults['month'],
        '#required' => true
      ];
      $form['day'] = [
        '#title' => 'Day',
        '#type' => 'textfield',
        '#attributes' => ['type' => 'number'] , 
        '#default_value' => $defaults['day'],
        '#required' => true
      ];
      $form['year'] = [
        '#title' => 'Year',
        '#type' => 'textfield',
        '#attributes' => ['type' => 'number'] , 
        '#default_value' => $defaults['year'],
        '#required' => true
      ];
      $form['role'] = [
        '#title' => 'Role',
        '#type' => 'textfield',
        '#default_value' => $defaults['role'],
        
      ];
      // AddressField
      
      
      
      $form['address'] = [
        '#type' => 'address',
        '#default_value' => $defaults['address'],
        '#used_fields' => [
          AddressField::ADDRESS_LINE1,
          AddressField::POSTAL_CODE,
          AddressField::ADDRESS_LINE2,
          AddressField::ADMINISTRATIVE_AREA,
          AddressField::LOCALITY,
        ],
        // '#available_countries' => ['US'],
      ];
      
      
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
      
      if($is_edit){
        unset($form['submit']['#ajax']);
      }
      
      
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
      $is_edit = $form_state->get('is_edit');
      
      $email = $form_state->get('email');
      
      if($is_edit)
      {
        //  print_r("EDIT CASE validate");
        //   exit;
      }else{
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
          
          $user->company->setValue($form_state->getValue('company'));
          $user->last_name->setValue($form_state->getValue('last_name'));
          $user->phone->setValue($form_state->getValue('phone'));
          $user->loyalty_id->setValue($form_state->getValue('loyalty_id'));
          $user->role->setValue($form_state->getValue('role'));
          $user->sms_text->setValue($form_state->getValue('sms_text'));
          $user->email_notified->setValue($form_state->getValue('email_notified'));
          $user->address->setValue($form_state->getValue('address'));
          $user->month->setValue($form_state->getValue('month'));
          $user->day->setValue($form_state->getValue('day'));
          $user->year->setValue($form_state->getValue('year'));
          
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
      }
      parent::validateForm($form, $form_state);
    }
    
    /**
    * {@inheritdoc}
    */
    public function submitForm(array &$form, FormStateInterface $form_state) {
      $form_state->setRebuild(true);
      
      $is_edit = $form_state->get('is_edit');
      
      if($is_edit)
      {
        
        $uid = \Drupal::currentUser()->id();
        $user = \Drupal\user\Entity\User::load($uid);
        
        $subUser = \Drupal\user\Entity\User::load($form_state->get('uid'));
        
        
        $profiles = $user->paid_member_profiles->referencedEntities();
        $profile = $profiles[0];
        $old  = $profile->field_mem->getValue();
        
        
        $ncuser = $form_state->getValue('username');
        $email = $form_state->get('email');
        
        $subUser->company->setValue($form_state->getValue('company'));
        $subUser->last_name->setValue($form_state->getValue('last_name'));
        $subUser->phone->setValue($form_state->getValue('phone'));
        $subUser->loyalty_id->setValue($form_state->getValue('loyalty_id'));
        $subUser->role->setValue($form_state->getValue('role'));
        $subUser->sms_text->setValue($form_state->getValue('sms_text'));
        $subUser->email_notified->setValue($form_state->getValue('email_notified'));
        $subUser->address->setValue($form_state->getValue('address'));
        $subUser->month->setValue($form_state->getValue('month'));
        $subUser->day->setValue($form_state->getValue('day'));
        $subUser->year->setValue($form_state->getValue('year'));

        $subUser->save();
        
        drupal_set_message("User Updated.");
        $form_state->setRebuild(false);
      }else{
        
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
          
          // user status active 
          $newUser->status= 1;
          $newUser->activate();
          
          $newUser->addRole('free_member');
          // save password
          
          $newUser->setPassword($passcustom);
          $newUser->save();
          
          // send email custom
          $params = [];
          $params['subject'] = $this->t('Thanks to registered on Air one Choice ');
          $params['body'] = [$this->t("Your mail @email registered on site.\n you can now login using username:'@username' and password:'@password'", ['@email'=>$email, '@username'=>$ncuser, '@password'=>$passcustom])];
          customMailSend($email,'register', $params);
          
          
          $old[] = ['target_id'=>$newUser->id()];
          $profile->field_mem->setValue($old);
          $profile->save();
          drupal_set_message("User added to package");
          $form_state->set('doneSuccess', true);
          $form_state->setRebuild(false);
          
        }
      }
    }
    
  }
  