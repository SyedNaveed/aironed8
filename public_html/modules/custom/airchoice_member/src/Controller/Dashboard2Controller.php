<?php

namespace Drupal\airchoice_member\Controller;
use Drupal\airchoice_member\AirchoiceMember;
use Drupal\Core\Session\AccountInterface;

use Drupal\Core\Controller\ControllerBase;
use Drupal\intelisys\Utility\TimeHelper;
use Drupal\Core\Datetime\Entity\DateFormat;

/**
* Class DefaultController.
*/
class Dashboard2Controller extends ControllerBase {

  public function formatDiff($interval)
  {
    $format = "%r";
    if($interval->m > 0)
    {
      $format .= "<div class=\"ticket_ft_big\">%M </div> <div class=\"ticket_ft_sm\">M</div>";
    }
    if($interval->d > 0)
    {
      $format .= "<div class=\"ticket_ft_big\">%D </div> <div class=\"ticket_ft_sm\">D</div>";
    }
    
    $format .= "<div class=\"ticket_ft_big\">%H</div> <div class=\"ticket_ft_sm\">hrs</div>";
    
    
    $format .= "<div class=\"ticket_ft_big\">%I </div> <div class=\"ticket_ft_sm\">min</div>";
    
    return $interval->format($format);
  }
  
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

            
            $selfReservations = \Drupal\airchoice_member\Controller\UpcomingController::getUserReservations($user);      

            
            $profile = $userData['profile'];
            $package = $userData['package'];
            $members = $userData['members'];
            $canAddMoreMembers = $userData['canAddMoreMembers'];
            if(!$profile)
            {
              return ['#markup'=>'Login User paid profile not found'];
            }
            
            $userData = \Drupal::service('user.data');

            
            $mwm = [];
            $userReservations = [];
            
            $data = $userData->get('userlog', $uid, 'activity');
            $userReservations[$uid] = $selfReservations;
            $mwm[$uid] = json_decode($data);
            
            
            foreach($members as $member)
            {
              $data = $userData->get('userlog', $member->id(), 'activity');
              $mwm[$member->id()] = json_decode($data);
              $userReservations[$member->id()] = \Drupal\airchoice_member\Controller\UpcomingController::getUserReservations($member);
            }


            
            $link = \Drupal\Core\Url::fromRoute('airchoice_member.login_by_link_controller_hello', ['user'=>0]);
            $output['package'] = [
              '#theme' => 'page-dashboard',
              '#data' => [
                'profile_id'=>$profile->id(),
                'mwm' => $mwm,
                'userReservations'=>$userReservations,
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
          