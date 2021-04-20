<?php

namespace Drupal\airchoice_member\Controller;

use Drupal\airchoice_member\AirchoiceMember;
use Drupal\Core\Session\AccountInterface;

use Drupal\Core\Controller\ControllerBase;

/**
* Class DashboardController.
*/
class DashboardController extends ControllerBase {
  use \Drupal\aco_core\Traits\IntelisysTrait;
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

    $user = $userInfo['user'];
    
    $userReservations = $user->reservations_key->getValue();
  
    $userReservations = array_slice($userReservations, -2, 2);
    
    $reservations = [];
    foreach($userReservations as $reservationKey)
    {
      if($reservationKey['value'])
      {
        $apiReservation = $this->callEndpoint('getReservation', [
          'key' => $reservationKey['value']
          ]);
          
          if($apiReservation)
          {
            $reservation = [];
            $reservation['passengers'] = $apiReservation['passengers'];
            $journeys = $apiReservation['journeys'];
            $segments = [];
            foreach($journeys as $journey)
            {
              $segment = [];
              $segmentFirst = $journey['segments'][0];
              $segmentLast = $journey['segments'][count($journey['segments'])-1];
              
              $segment['from'] = $segmentLast['departure'];
              $fromDateTime = $toDateTime = date("Y-m-d h:i a", strtotime($segment['from']['localScheduledTime']));
              $toDateTimeSplit = explode(' ', $toDateTime, 3);


              
              

              // <div class="ticket_ft_big">3</div>
							// <div class="ticket_ft_sm">hrs</div>
							// <div class="ticket_ft_big">29</div>
							// <div class="ticket_ft_sm">min</div>
              

              $segment['from']['dateTime'] = [
                'date'=>$toDateTimeSplit[0],
                'time'=>$toDateTimeSplit[1],
                'AMPM' => $toDateTimeSplit[2],
              ];

              
              $segment['to'] = $segmentFirst['arrival'];
              $toDateTime = date("Y-m-d h:i a", strtotime($segment['to']['localScheduledTime']));
              $toDateTimeSplit = explode(' ', $toDateTime, 3);



              $origin = new \DateTime($fromDateTime);
              $target = new \DateTime($toDateTime);

              $interval = $origin->diff($target);
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


              // $segment['from']['dateTime'] = $toDateTimeSplit;
              $segment['to']['dateTime'] = [
                'date'=>$toDateTimeSplit[0],
                'time'=>$toDateTimeSplit[1],
                'AMPM' => $toDateTimeSplit[2],
                'left' => $interval->format($format)

            ];

              $segments[] = $segment;
            }
            $reservation['journeys'] = $segments;
            $reservations[] = $reservation;
          }
          
        }
      }



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
        'upcomingFlights' => $reservations,
        'currentUser'  => $userInfo['user']
      ]
    ];

    return $build;
  }
        
      
          
        }
        