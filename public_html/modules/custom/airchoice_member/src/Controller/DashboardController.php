<?php

namespace Drupal\airchoice_member\Controller;

use Drupal\airchoice_member\AirchoiceMember;
use Drupal\Core\Session\AccountInterface;

use Drupal\intelisys\Utility\TimeHelper;
use Drupal\Core\Datetime\Entity\DateFormat;

use Drupal\Core\Controller\ControllerBase;

/**
* Class DashboardController.
*/
class DashboardController extends ControllerBase {
  use \Drupal\aco_core\Traits\IntelisysTrait;

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
    
    $format .= "<div class=\"ticket_ft_big\">%h</div> <div class=\"ticket_ft_sm\">hrs</div>";
    
    
    $format .= "<div class=\"ticket_ft_big\">%I </div> <div class=\"ticket_ft_sm\">min</div>";
    
    return $interval->format($format);
  }
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
    
    //////////////////////////////////
    
    $userReservations = $user->reservations_key->getValue();
    
    $reservations = [];
    $journeyCount = 0;
    foreach($userReservations as $reservationKey)
    {
      // $build['t'.$reservationKey['value']]['#markup'] = "<h3>".$reservationKey['value']."</h3>";
      if(!$reservationKey['value'])
      {
        continue;
      }

      if($journeyCount==2)
      {
        break;
      }
      
      $reservation = [];
      
      $apiReservation = $this->callEndpoint('getReservation', [
        'key' => $reservationKey['value']
        ]);
        
        if(!$apiReservation)
        {
          continue;
        }
 
        
        $time_format = DateFormat::load('short_time')->getPattern();
        $date_format = "M jS, Y";
        
        $journeys = $apiReservation['journeys'];
        
        $reservation['name'] = $apiReservation['passengers'][0]['reservationProfile']['firstName'].' '.$apiReservation['passengers'][0]['reservationProfile']['lastName'];
        $_journeys = [];
        foreach($journeys as $journey)
        {
          
          if($journeyCount==2)
          {
            break;
          }
          $journeyCount++;


          $_journey = [];
          $_journey['date'] = TimeHelper::getLocalTime($journey['departure'], $date_format);
          
          $_journey['from'] = [
            'name' => $journey['segments'][0]['departure']['airport']['name'],
            'code' => $journey['segments'][0]['departure']['airport']['code'],
            'time' => TimeHelper::getLocalTime($journey['segments'][0]['departure'], 'h:i'),
            'ampm' => TimeHelper::getLocalTime($journey['segments'][0]['departure'], 'a'),
          ];
          $_journey['to'] = [
            'name' => $journey['segments'][count($journey['segments'])-1]['arrival']['airport']['name'],
            'code' => $journey['segments'][count($journey['segments'])-1]['arrival']['airport']['code'],
            'time' => TimeHelper::getLocalTime($journey['segments'][count($journey['segments'])-1]['arrival'], 'h:i'),
            'ampm' => TimeHelper::getLocalTime($journey['segments'][count($journey['segments'])-1]['arrival'], 'a'),
          ];
          
          
          $_segments = [];
          $lastDiff = null;
          foreach($journey['segments'] as $segment)
          {
            $_segment = [];
            
            $arrivalTime = new \DateTime($segment['arrival']['scheduledTime']);
            $departureTime = new \DateTime($segment['departure']['scheduledTime']);
            
            //calculate total and segment time
            $arr = new \DateTime($segment['arrival']['scheduledTime']);
            $dep = new \DateTime($segment['departure']['scheduledTime']);
            $diff = $arr->diff($dep, true);
            // $_segment['difference'] = $diff;
            $_segment['difference_format'] = $this->formatDiff($diff);
            if($lastDiff)
            {
              // d('before sub', $dep->diff($arr), $dep, $lastDiff);
              $dep = $dep->sub($lastDiff);
            }
            $lastDiff = $arr->diff($dep, true);
            $_segment['code'] = $segment['flight']['airlineCode']['code'];
            $_segment['code'] .= $segment['flight']['flightNumber'];
            $_segment['departure'] = [
              'time' => TimeHelper::getLocalTime($segment['departure'], 'h:ia'),
              'airport' => [
                'name' => $segment['departure']['airport']['name'],
                'code' => $segment['departure']['airport']['code'],
                ]
              ];
              
              $_segment['arrival'] = [
                'time' => TimeHelper::getLocalTime($segment['arrival'], 'h:ia'),
                'airport' => [
                  'name' => $segment['arrival']['airport']['name'],
                  'code' => $segment['arrival']['airport']['code'],
                  ]
                ];
                
                
                
                $_segments[] = $_segment;
              }
              $_journey['segments'] = $_segments;
              // $_journey['difference'] = $lastDiff;
              $_journey['difference_format'] = $this->formatDiff($lastDiff);
              $_journey['stops'] = count($_segments) - 1;
              
              
              $_journeys[] = $_journey;
            }
            
            $reservation['journeys'] = $_journeys;
            
            $reservations[] = $reservation;
          }
          
          // $findFlightForm = \Drupal::formBuilder()->getForm('\Drupal\airchoice_member\Form\FindFlightForm');
          $findFlightForm = \Drupal::formBuilder()->getForm('\Drupal\aco_book_flight\Form\SearchForm');
         

          $build['page'] = [
          '#theme' => 'page-dashboard-main',
          '#data' => [
          'findFlightForm' => $findFlightForm,
          'upcomingFlights' => $reservations,
          'currentUser' => $userInfo['user']
          ]
          ];

          return $build;
          }
          
          /**
          * Index.
          *
          * @return string
          *   Return Hello string.
          */
          public function indexOldDeleteThis(){
            
            $build = [];
            
            $uid = \Drupal::currentUser()->id();
            $user = \Drupal\user\Entity\User::load($uid);
            
            $userReservations = $user->reservations_key->getValue();
            
            $userReservations = [
              array('value'=>'AKqlh8tSfnQBx7rF3¥xvOotRtxdgXqIzw09BUƒ4¥HVZOYƒApc9¥ƒurBTOM49Y8ww')
            ];
            
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
                    s($apiReservation);
                    exit;
                    $reservation = [];
                    $reservation['passengers'] = $apiReservation['passengers'];
                    $journeys = $apiReservation['journeys'];
                    $segments = [];
                    //TimeHelper::getLocalTime($departOrArival)
                    foreach($journeys as $journey)
                    {
                      $segment = [];
                      $segmentFirst = $journey['segments'][0];
                      $segmentLast = $journey['segments'][count($journey['segments'])-1];
                      
                      $segment['from'] = $segmentLast['departure'];
                      $fromDateTime = $toDateTime = date("Y-m-d h:i a", strtotime($segment['from']['localScheduledTime']));
                      $toDateTimeSplit = explode(' ', $toDateTime, 3);
                      
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
                      
                      $format .= "<div class=\"ticket_ft_big\">%h</div> <div class=\"ticket_ft_sm\">hrs</div>";
                      
                      
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


    /////////////////////////////////



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
        