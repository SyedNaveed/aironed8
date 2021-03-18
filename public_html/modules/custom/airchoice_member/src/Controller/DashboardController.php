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
          <div class='alert jumbotron members-addsection'>
          <div class='members-addsection-header'>  
          <div class='members-addsection-headerh1'><h1>Manage Members</h1></div>
          <div class='members-addmembers'>
          {% if canAddMoreMembers %}
          <a class="use-ajax btn btn-success"
          data-dialog-options="{&quot;width&quot;:600}"  
          data-dialog-type="modal"
          href="{{ path('airchoice_member.add_member_form') }}"><i class="fa fa-plus-circle" ></i>Add New Member</a>
          {% else %}
          <a class="btn btn-success" href="javascript:void(0)" disabled><i class="fa fa-plus-circle" ></i>Add New Member ☹️ </a>
          {% endif %}
          </div>
          </div>
          {{ drupal_entity("user", user_id, "default") }}
          <div class='newdashboard-con'>
           
          {{ drupal_entity("profile", profile_id, "full") }}
          
          {{ drupal_entity("node", package_id, "full") }}
          <h3>Members</h3>
          
          
          
          </div>
          <div class='useradded-mem'>
          <div class="list">
          <div class='members_bar shadow'>
          <div class='row'>
          <div class='col-md-6 '>
          <div class='user-img-section'>
          <img src='CODE.jpg' />
          <a class="use-ajax"
          data-dialog-options="{&quot;width&quot;:400}" 
          data-dialog-type="modal"
          href="{{ path("airchoice_member.dashboard_controller.member_info", {user: user_id}) }}">
          <h2>{{ user.name.value }} (Self) </h2>
          </a>
         
          <div class='member_flights'>
          <svg viewBox="0 0 18.854 17.941"> <path d="M12.306,12.835,7.664,20.24c0,.052-.052.052-.1.052H5.735a.138.138,0,0,1-.157-.157l2.295-7.3H2.97L1.614,14.66c0,.052-.052.052-.1.052H.154A.138.138,0,0,1,0,14.556l.938-3.234L0,8.088a.167.167,0,0,1,.157-.157H1.51c.052,0,.1,0,.1.052L2.97,9.809h4.9l-2.295-7.3a.167.167,0,0,1,.157-.157H7.56c.052,0,.1,0,.1.052l4.641,7.406h5.059a1.513,1.513,0,0,1,0,3.025H12.306Z" transform="translate(0.003 -2.352)" fill="#411777" fill-rule="evenodd"></path></svg>
          </div>
          </div>
          </div>
          <div class='col-md-6 user-options'>
          <div class='member_buttons'>
          <a href='' class='member_view'>View Flights</a>
          <a href='' class='member_activity'>View Activity</a>
          <a href='' class='member_edit'>Edit Profile</a>
          </div>
          </div>
          </div>
         
          </div>
          {% if  members|length > 0 %}
          {% for member in members %}
          <div class='members_bar shadow'>
          <div class='row'>
          <div class='col-md-6 '>
          <div class='user-img-section'>
          <img src='CODE.jpg' />
          <a class="use-ajax"
          data-dialog-options="{&quot;width&quot;:400}"  
          data-dialog-type="modal"
          href="{{ path("airchoice_member.dashboard_controller.member_info", {user:member.id}) }}"
          >
          <h2>{{member.name.value}}</h2>
          </a>
          <div class='member_flights'>
          <svg viewBox="0 0 18.854 17.941"> <path d="M12.306,12.835,7.664,20.24c0,.052-.052.052-.1.052H5.735a.138.138,0,0,1-.157-.157l2.295-7.3H2.97L1.614,14.66c0,.052-.052.052-.1.052H.154A.138.138,0,0,1,0,14.556l.938-3.234L0,8.088a.167.167,0,0,1,.157-.157H1.51c.052,0,.1,0,.1.052L2.97,9.809h4.9l-2.295-7.3a.167.167,0,0,1,.157-.157H7.56c.052,0,.1,0,.1.052l4.641,7.406h5.059a1.513,1.513,0,0,1,0,3.025H12.306Z" transform="translate(0.003 -2.352)" fill="#411777" fill-rule="evenodd"></path></svg>
          </div>
          </div>
          </div>
          <div class='col-md-6 user-options'>
          <div class='member_buttons'>
          <a href='' class='member_view'>View Flights</a>
          <a href='' class='member_activity'>View Activity</a>
          <a href='' class='member_edit'>Edit Profile</a>
          </div>
          </div>

          </div>


          </div>
          {% endfor %}
          {% else %}
          <div class="members_bar shadow alert alert-danger"> No other members 😞 </div>
          {% endif %}
          </div>
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
        