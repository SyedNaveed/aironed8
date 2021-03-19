<?php

namespace Drupal\airchoice_member\Controller;
use Drupal\airchoice_member\AirchoiceMember;
use Drupal\Core\Session\AccountInterface;


use Drupal\Core\Controller\ControllerBase;

/**
* Class DefaultController.
*/
class DashboardController extends ControllerBase {
  
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
    if($uid === $user->id())
    {
      return ['#markup' => 'self'];
    }
    $userData = AirchoiceMember::getBasicProfileInfo($uid);
    
    return [
      '#type' => 'inline_template',
      '#template' => "Info about {{ user_name }}
      <a class=\"use-ajax\"
      href=\"{{ path(\"airchoice_member.dashboard_controller.member_info\", {user:user_id}) }}?delete=1\"
      >
      👉 Remove
      </a>
      ",
      '#context'=>[
        'user_id'=>$user->id(),
        'user_name'=>$user->getUsername()
        ]
      ];
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
          $template = <<<EOF
          <div class='alert jumbotron'>
          <h3>User</h3>
          {{ drupal_entity("user", user_id, "default") }}
          <div class='newdashboard-con'>
          <h3>Profile</h3>
          {{ drupal_entity("profile", profile_id, "full") }}
          <h3>Package</h3>
          {{ drupal_entity("node", package_id, "full") }}
          <h3>Members</h3>
          <ul class="list">
          <li>
          <a class="use-ajax"
          data-dialog-options="{&quot;width&quot;:400}" 
          data-dialog-type="modal"
          href="{{ path("airchoice_member.dashboard_controller.member_info", {user: user_id}) }}">
          👉 {{ user.name.value }} (Self)
          </a>
          </li>
          {% if  members|length > 0 %}
          {% for member in members %}
          <li>
          <a class="use-ajax"
          data-dialog-options="{&quot;width&quot;:400}"  
          data-dialog-type="modal"
          href="{{ path("airchoice_member.dashboard_controller.member_info", {user:member.id}) }}"
          >
          👉 {{member.name.value}}
          </a>
          </li>
          {% endfor %}
          {% else %}
          <li class="alert alert-danger"> No other members 😞 </li>
          {% endif %}
          </ul>
          
          {% if canAddMoreMembers %}
          <a class="use-ajax btn btn-success"
          data-dialog-options="{&quot;width&quot;:600}"  
          data-dialog-type="modal"
          href="{{ path('airchoice_member.add_member_form') }}">Add member</a>
          {% else %}
          <a class="btn btn-success" href="javascript:void(0)" disabled>☹️ Add member ☹️ </a>
          {% endif %}
          </div>
          </div>
          EOF;
          $output['package'] = [
            '#type' => 'inline_template',
            '#template' => $template,
            '#context' => [
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
        