<?php

namespace Drupal\airchoice_member\Controller;
use Drupal\airchoice_member\AirchoiceMember;
use Drupal\Core\Session\AccountInterface;

use Drupal\Core\Controller\ControllerBase;

/**
* Class DefaultController.
*/
class Dashboard2Controller extends ControllerBase {
  
  public function removeMember(AccountInterface $user)
  {
    
    
    $delete = $_GET['delete']??null;
    $uid = \Drupal::currentUser()->id();
    if($uid === $user->id())
    {
      return ['#markup' => 'self'];
    }
    $userData = AirchoiceMember::getBasicProfileInfo($uid);
    
    
    
    if($delete)
    {
      $old = $userData['profile']->field_mem->getValue();
      $new = array_filter($old, function ($item)use($user){
        return $item['target_id'] !== $user->id();
      });
      $userData['profile']->field_mem->setValue($new);
      $userData['profile']->save();
      drupal_set_message('Member removed from package ');
      
      $response = new \Drupal\Core\Ajax\AjaxResponse();
      $response->addCommand(new \Drupal\Core\Ajax\InvokeCommand(NULL, 'reloadPage'));
      return $response;
    }
    $uid = \Drupal::currentUser()->id();
    
    $userData = AirchoiceMember::getBasicProfileInfo($uid);
    return ['page'=>[
      '#theme' => 'member-remove',
      '#data' => [
        'is_self' => $uid === $user->id(),
        'user_id'=>$user->id(),
        'user_name'=>$user->getUsername()
        ]
        ]];
        
      }
      
      public function index()
      {
        $output = [
          '#attached' => [
            'library' => [
              'airchoice_member/test1'
              ]
              ]
            ];
            
            $uid = \Drupal::currentUser()->id();
            
            $userData = AirchoiceMember::getBasicProfileInfo($uid);
            
            $user = $userData['user'];
            
            $profile = $userData['profile'];
            $package = $userData['package'];
            $members = $userData['members'];
            $canAddMoreMembers = $userData['canAddMoreMembers'];
            if(!$profile)
            {
              return ['#markup'=>'Login User paid profile not found'];
            }
            
            $link = \Drupal\Core\Url::fromRoute('airchoice_member.login_by_link_controller_hello', ['user'=>0]);
            $output['package'] = [
              '#theme' => 'page-dashboard',
              '#data' => [
                'profile_id'=>$profile->id(),
                'user' => $user,
                'user_id' => $uid,
                'package_id' => $package->id(),
                'members' => $members,
                'canAddMoreMembers' => $canAddMoreMembers
                ]
              ];
              
              return $output;
            }
            
            /**
            * Hello.
            *
            * @return string
            *   Return Hello string.
            */
            public function hello() {
              $page = [];
              
              $user = \Drupal::currentUser(1);
              $user = user_load($user->id());
              $profile = $user->paid_member_profiles->referencedEntities()[0];
              $profile_view_builder = \Drupal::entityTypeManager()->getViewBuilder('profile');
              $profile_view = $profile_view_builder->view($profile, 'default');
              
              $page['profile'] = $profile_view;
              //$text = NULL, $rel = canonical, array $options = array()
              $link = $profile->toLink("Edit", 'edit-form')->toRenderable();
              $page['s'] = $link;
              return $page;
            }
            
          }
          