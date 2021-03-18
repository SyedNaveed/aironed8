<?php

namespace Drupal\airchoice_member\Controller;
use Drupal\user\Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Session\AccountInterface;


use Drupal\Core\Controller\ControllerBase;

/**
* Class LoginByLinkController.
*/
class LoginByLinkController extends ControllerBase {
  
  
  public static function addLinksToBlock(&$variables)
  {
    $show_debug = \Drupal\Core\Site\Settings::get('custom_show_debug_info');
    if(!$show_debug)
    {
      return;
    }
    $_uid = \Drupal::currentUser()->id();
    $query = \Drupal::entityQuery('user')->condition('status', true);
    $uids = $query->execute();
    
    $link = \Drupal\Core\Url::fromRoute('airchoice_member.login_by_link_controller_hello', ['user'=>0]);
    $href = 0 == $_uid ? '#':$link->toString();
    $class = 0 == $_uid ? 'text-danger':'';
    $links = "<a class='$class' href='$href'>Anonymouse</a><br/>";
    
    foreach($uids as $uid)
    {
      $link = \Drupal\Core\Url::fromRoute('airchoice_member.login_by_link_controller_hello', ['user'=>$uid]);
      $href = $uid == $_uid ? '#':$link->toString();
      $class = $uid == $_uid ? 'text-danger':'';
      $links .= "<a class='$class' href='$href'>User $uid</a><br/>";
    }
    $variables['content']['testy'] = ['#markup'=>"<h3>Switch User</h3><div class='small' >For development purpose.</div>$links"];
  }
  
  /**
  * Hello.
  *
  * @return string
  *   Return Hello string.
  */
  public function hello(AccountInterface $user) {
    $show_debug = \Drupal\Core\Site\Settings::get('custom_show_debug_info');
    if(!$show_debug){
      throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
    }
    user_login_finalize($user);
    $user_destination = \Drupal\Core\Url::fromRoute('<front>')->toString();
    $response = new RedirectResponse($user_destination);
    $response->send();
    exit(0);
  }
  
}
