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
    $form['#prefix'] = '<div id="myform">Myform';
    $form['#suffix'] = '</div>';
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
      '#default_value' => $form_state->getValue('email'),
      '#disabled' => $email?true:false,
      '#required' => true
    ];
    if($email){
      $form['username'] = [
        '#title' => 'Username',
        '#type' => 'textfield',
        '#default_value' => $form_state->getValue('username'),
        '#required' => true
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
      return $form;
    }
    
    public function myAjaxCallback(&$form, $form_state)
    {
      if($form_state->get("doneSuccess"))
      {
        $response = new \Drupal\Core\Ajax\AjaxResponse();
        $response->addCommand(new \Drupal\Core\Ajax\InvokeCommand(NULL, 'reloadPage', ['dashboard']));
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
        // $user->set("init", $email);
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
  