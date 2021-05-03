<?php

namespace Drupal\airchoice_member\Controller;

use DateInterval;
use Drupal\airchoice_member\AirchoiceMember;
use Drupal\Core\Session\AccountInterface;

use Drupal\Core\Controller\ControllerBase;
use Drupal\aco_core\Traits\IntelisysTrait;

use Drupal\intelisys\Utility\TimeHelper;
use Drupal\Core\Datetime\Entity\DateFormat;


/**
* Class DashboardController.
*/
class UpcomingController extends ControllerBase {
  use IntelisysTrait; 
  
  public static function formatDiff($interval)
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
  
  public function index(){
    
    $build = [];
    
    $uid = \Drupal::currentUser()->id();
    $user = \Drupal\user\Entity\User::load($uid);
    
    $reservations = UpcomingController::getUserReservations($user);
    
    
    $build['page'] = [
      '#theme' => 'page-upcoming-flights-main',
      '#data' => [
        'reservations' => $reservations
        ]
      ];
      
      return $build;
    }
    
        
        
        public static function getUserReservations($user)
        {
          $userReservations = $user->reservations_key->getValue();
          
          $reservations = [];
          foreach($userReservations as $reservationKey)
          {
            $build['t'.$reservationKey['value']]['#markup'] = "<h3>".$reservationKey['value']."</h3>";
            if(!$reservationKey['value'])
            {
              continue;
            }
            
            $reservation = [];
            $thisObject = new UpcomingController();
            $apiReservation = $thisObject->callEndpoint('getReservation', [
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
                  $_segment['difference_format'] = UpcomingController::formatDiff($diff);
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
                    $_journey['difference_format'] = UpcomingController::formatDiff($lastDiff);
                    $_journey['stops'] = count($_segments) - 1;
                    
                    
                    $_journeys[] = $_journey;
                  }
                  
                  $reservation['journeys'] = $_journeys;
                  
                  $reservations[] = $reservation;
                }
                return $reservations;
              }
              
              
              
            }
            