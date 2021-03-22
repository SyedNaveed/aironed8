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

    $findFlightForm = \Drupal::formBuilder()->getForm('\Drupal\airchoice_member\Form\FindFlightForm');

    $upcomingFlights = [];
    $upcomingFlights[] = [
      'name' => 'XYZ'
    ];

    $build['page'] = [
      '#theme' => 'page-dashboard-main',
      '#data' => [
        'findFlightForm' => $findFlightForm,
        'upcomingFlights' => $upcomingFlights
      ]
    ];

    return $build;
  }
        
      
          
        }
        