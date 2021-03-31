<?php

namespace Drupal\airchoice_member\Controller;

use Drupal\airchoice_member\AirchoiceMember;
use Drupal\Core\Session\AccountInterface;

use Drupal\Core\Controller\ControllerBase;

/**
* Class DashboardController.
*/
class DashboardController extends ControllerBase {
  
  /**
  * Index.
  *
  * @return string
  *   Return Hello string.
  */
  public function index(){
    
    $build = [];

    $userSession = \Drupal::currentUser();
    $uid = $userSession->id();
    $userInfo = AirchoiceMember::getBasicProfileInfo($uid);



    // $findFlightForm = \Drupal::formBuilder()->getForm('\Drupal\airchoice_member\Form\FindFlightForm');
    $findFlightForm = \Drupal::formBuilder()->getForm('\Drupal\aco_book_flight\Form\SearchForm');
    $upcomingFlights = [];
    $upcomingFlights[] = [
      'name' => 'XYZ'
    ];

    $build['page'] = [
      '#theme' => 'page-dashboard-main',
      '#data' => [
        'findFlightForm' => $findFlightForm,
        'upcomingFlights' => $upcomingFlights,
        'currentUser'  => $userInfo['user']
      ]
    ];

    return $build;
  }
        
      
          
        }
        