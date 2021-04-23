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
    
    $format .= "<div class=\"ticket_ft_big\">%H</div> <div class=\"ticket_ft_sm\">hrs</div>";
    
    
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
            
            // $apiReservation = $this->callEndpoint('getReservation', [
              //   'key' => $reservationKey['value']
              //   ]);
              
              $apiReservation = '{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=","key":"diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=","number":123456,"locator":"AB12CD","directParentReservation":null,"subsidiaryReservations":null,"bookingInformation":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/bookingInformation/idiJkTZqRwES¥0Fo8YƒyYw==","key":"idiJkTZqRwES¥0Fo8YƒyYw==","sessionIdentifier":"","distributionChannel":{"href":"/distributionChannels/W","identifier":"W","description":"Web"},"externalLocators":null,"agency":{"href":"/agencies/t2MkLBokPWOfz6DEMcdjeg==","key":"t2MkLBokPWOfz6DEMcdjeg==","iataNumber":"1234567890","name":"InteliSys Aviation Systems"},"company":{"href":"/companies/HKZ5y8N4qƒt1JH¥ZJz9CXQ==","key":"HKZ5y8N4qƒt1JH¥ZJz9CXQ==","identifier":"ABC123456","name":"InteliSys Aviation Systems"},"currency":{"href":"/currencies/CAD","code":"CAD","description":"Canadian Dollar"},"contactInformation":{"name":"Smith, John","phoneNumber":"555-555-1234","extension":"987","email":"sample@sample.com","language":{"href":"/languages/en","code":"en","name":"English"},"notificationPreferences":[{"href":"/communicationChannels/email","identifier":"email","name":"E-Mail"}]},"creation":{"time":"2021-04-17 09:41:06Z"},"hold":null,"cancellation":null,"bookingType":{"eticketed":false,"groupReserved":false,"frequentFlyerRedeemed":false},"frequentFlyer":null,"notes":"This is a test call center reservation."},"passengers":[{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/passengers/t2MkLBokPWOfz6DEMcdjeg==","key":"t2MkLBokPWOfz6DEMcdjeg==","reference":"AtqIuj8Z1X","reservationOwner":true,"reservationStatus":{"confirmed":true,"cancelled":false},"fareApplicability":{"adult":true,"child":false},"passengerTypeCode":null,"reservationProfile":{"lastName":"Smith","firstName":"John","middleName":"","title":"Mr","gender":"Male","address":{"address1":"123 Sample Road","address2":"","city":"Springfield","location":{"country":{"href":"/countries/CAN","code":"CAN","name":"Canada"},"province":{"href":"/countries/CAN/provinces/NB","code":"NB","name":"New-Brunswick"}},"postalCode":"Z0Z 0Z0"},"birthDate":"1991-04-23","nationCountry":{"href":"/countries/CAN","code":"CAN"},"personalContactInformation":{"phoneNumber":"555-555-1234","mobileNumber":"555-555-3456","email":"sample@sample.com","language":{"href":"/languages/en","code":"en","name":"English"},"notificationPreferences":[{"href":"/communicationChannels/email","identifier":"email","name":"E-Mail"}]},"businessContactInformation":{"phoneNumber":"555-555-1234","faxNumber":"555-555-2345","extension":"987"},"destinationContactInformation":null,"passport":{"number":"P019283747","expiryDate":"2028-05-30","issuingCountry":{"href":"/countries/CAN","code":"CAN"},"issuingCity":"Springfield","issuingDate":"2018-04-16"},"loyaltyProgram":null,"preBoard":false,"status":{"active":true,"inactive":false,"denied":false},"reference1":"","reference2":"","notes":""},"frequentFlyer":{"href":"/frequentFlyers/zafIƒ9rMƒx7Fqƒq0J1Vc=","key":"zafIƒ9rMƒx7Fqƒq0J1Vc=","reservationProfile":{"lastName":"Smith","firstName":"John"}},"advancePassengerInformation":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/passengers/t2MkLBokPWOfz6DEMcdjeg==/advancePassengerInformation/rF3¥WXX9Q0bIoVoEJSCGK","key":"rF3¥WXX9Q0bIoVoEJSCGK","lastName":"Doe","firstName":"John","middleName":"Jane","gender":"Male","title":"Mr","birthDate":"1991-04-23","nationCountry":{"href":"/countries/CAN","code":"CAN"},"residentCountry":{"href":"/countries/CAN","code":"CAN"},"redressNumber":"1234567","knownPassengerNumber":"7654321","clearanceAirport":{"href":"/airports/YVR","code":"YVR","name":"Vancouver International"},"destinationAddress":{"address1":"123 Sample Road","address2":"","city":"Springfield","location":{"country":{"href":"/countries/CAN","code":"CAN"},"province":{"href":"/countries/CAN/provinces/NB","code":"NB"}},"postalCode":"Z0Z 0Z0"},"destinationContactInformation":{"phoneNumber":"555-555-1234","mobileNumber":"555-555-3456","email":"sample@sample.com"},"documents":[{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/passengers/t2MkLBokPWOfz6DEMcdjeg==/advancePassengerInformation/rF3¥WXX9Q0bIoVoEJSCGK/advancePassengerInformationDocuments/rF3¥WXX9Q¥0bEJSCGK","key":"rF3¥WXX9Q¥0bEJSCGK","documentType":{"code":"P","name":"Passport"},"documentInformation":{"lastName":"Doe","firstName":"John","middleName":"Jane","birthDate":"1991-04-23","nationCountry":{"href":"/countries/CAN","code":"CAN"},"number":"1234560","expiryDate":"2028-04-23","issuingCountry":{"href":"/countries/CAN","code":"CAN"},"issuingCity":"Springfield"}}],"verified":false},"passengerServiceRequests":[{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/passengers/t2MkLBokPWOfz6DEMcdjeg==/passengerServiceRequests/MkLBokƒx7Fqƒq0JkfzPWOf","key":"MkLBokƒx7Fqƒq0JkfzPWOf","serviceRequest":{"href":"/serviceRequests/VCdctXmbmONuZuKmN5n7bnvfZMfkuyrs=","key":"VCdctXmbmONuZuKmN5n7bnvfZMfkuyrs=","code":"BLND"},"notes":"Requires wheel chair."}],"passengerCostCenter":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/passengers/t2MkLBokPWOfz6DEMcdjeg==/passengerCostCenter/xc8qLRNTRoR4g¥CmugeF7","key":"xc8qLRNTRoR4g¥CmugeF7","costCenter":{"name":"98054920-1230","number":"12","project":{"name":"City Hall Refurb","businessUnit":{"name":"City Hall","vendor":{"name":"Major Projects","job":{"name":"Contractor"}}}}}},"infants":[{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/passengers/t2MkLBokPWOfz6DEMcdjeg==/infants/idiJkTZqRwES¥0Fo8YƒyYw==","key":"idiJkTZqRwES¥0Fo8YƒyYw==","passengerTypeCode":null,"reservationProfile":{"lastName":"Smith","firstName":"Jane","middleName":"","gender":"Female","birthDate":"2021-04-23"},"advancePassengerInformation":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/passengers/t2MkLBokPWOfz6DEMcdjeg==/infants/idiJkTZqRwES¥0Fo8YƒyYw==/advancePassengerInformation/rF3¥WXX9Q0bIoVoEJSCGK","key":"rF3¥WXX9Q0bIoVoEJSCGK","lastName":"Smith","firstName":"Jane","middleName":"","gender":"Female","title":"Inf","birthDate":"2021-04-23","nationCountry":{"href":"/countries/CAN","code":"CAN"},"residentCountry":{"href":"/countries/CAN","code":"CAN"},"redressNumber":"1234567","knownPassengerNumber":"7654321","clearanceAirport":{"href":"/airports/YVR","code":"YVR","name":"Vancouver International"},"destinationAddress":{"address1":"123 Sample Road","address2":"","city":"Springfield","location":{"country":{"href":"/countries/CAN","code":"CAN"},"province":{"href":"/countries/CAN/provinces/NB","code":"NB"}},"postalCode":"Z0Z 0Z0"},"destinationContactInformation":{"phoneNumber":"555-555-1234","mobileNumber":"555-555-3456","email":"sample@sample.com"},"documents":[{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/passengers/t2MkLBokPWOfz6DEMcdjeg==/infants/idiJkTZqRwES¥0Fo8YƒyYw==/advancePassengerInformation/rF3¥WXX9Q0bIoVoEJSCGK/advancePassengerInformationDocuments/rF3¥WXX9Q¥0bEJSCGK","key":"rF3¥WXX9Q¥0bEJSCGK","documentType":{"code":"P","name":"Passport"},"documentInformation":{"lastName":"Smith","firstName":"Jane","middleName":"","birthDate":"2021-04-23","nationCountry":{"href":"/countries/CAN","code":"CAN"},"number":"1234560","expiryDate":"2028-04-23","issuingCountry":{"href":"/countries/CAN","code":"CAN"},"issuingCity":"Springfield"}}],"verified":false},"notes":""}],"weight":null,"notes":""}],"journeys":[{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/journeys/idiJkTZqRwES¥0Fo8YƒyYw==","key":"idiJkTZqRwES¥0Fo8YƒyYw==","departure":{"scheduledTime":"2021-04-23 09:41:06Z","airport":{"href":"/airports/YVR","code":"YVR","name":"Vancouver International","utcOffset":{"iso":"-07:00","hours":-7,"minutes":-420}}},"segments":[{"key":"OwK7VhanpmfvaUGDcnYedQ==","flight":{"href":"/flights/0HIsZirkHemOXnkAIAAav02YGyUhnSULjg5vIb0x7Ks=","key":"0HIsZirkHemOXnkAIAAav02YGyUhnSULjg5vIb0x7Ks=","airlineCode":{"href":"/airlineCodes/YY","code":"YY"},"flightNumber":"705","operatingPartnerCarrier":null,"aircraftModel":{"href":"/aircraftModels/Mwm8o8aYgXBwJ5RWWW¥N8plREjGQ8CZoAXW5UBPahY=","key":"Mwm8o8aYgXBwJ5RAskD¥N8plREjGQ8CZoAXW5UBPaXXY=","identifier":"A320","name":"Airbus A320"}},"departure":{"scheduledTime":"2021-04-23 09:41:06Z","airport":{"href":"/airports/YVR","code":"YVR","name":"Vancouver International","utcOffset":{"iso":"-07:00","hours":-7,"minutes":-420}}},"arrival":{"scheduledTime":"2021-04-23 14:11:06Z","airport":{"href":"/airports/YYZ","code":"YYZ","name":"Toronto Pearson","utcOffset":{"iso":"-04:00","hours":-4,"minutes":-240}}},"legs":[{"key":"NpI97qWƒPw2ZHpXcQTEtGw==","departure":{"scheduledTime":"2021-04-23 09:41:06Z","airport":{"href":"/airports/YVR","code":"YVR","name":"Vancouver International","utcOffset":{"iso":"-07:00","hours":-7,"minutes":-420}}},"arrival":{"scheduledTime":"2021-04-23 14:11:06Z","airport":{"href":"/airports/YYZ","code":"YYZ","name":"Toronto Pearson","utcOffset":{"iso":"-04:00","hours":-4,"minutes":-240}}}}],"reservationStatus":{"cancelled":false,"open":false,"finalized":false,"external":false}},{"key":"NpI97qWƒPw2ZHpXcQTEtGw==","flight":{"href":"/flights/0HIsZirkHemOXnkAIAAav02YGyUhnSULjg5vIb0x7Ks=","key":"0HIsZirkHemOXnkAIAAav02YGyUhnSULjg5vIb0x7Ks=","airlineCode":{"href":"/airlineCodes/YY","code":"YY"},"flightNumber":"702","operatingPartnerCarrier":null,"aircraftModel":{"href":"/aircraftModels/OwK7VhanpmfvaUGDcnYedQ==","key":"OwK7VhanpmfvaUGDcnYedQ ==","identifier":"B737","name":"Boeing B737"}},"departure":{"scheduledTime":"2021-04-23 14:41:06Z","airport":{"href":"/airports/YYZ","code":"YYZ","name":"Toronto Pearson","utcOffset":{"iso":"-04:00","hours":-4,"minutes":-240}}},"arrival":{"scheduledTime":"2021-04-23 17:21:04Z","airport":{"href":"/airports/YYT","code":"YYT","name":"St. John\'s International","utcOffset":{"iso":"-02:30","hours":-2.5,"minutes":-150}}},"legs":[{"key":"OwK7VhanpmfvaUGDcnYedQ==","departure":{"scheduledTime":"2021-04-23 14:41:06Z","airport":{"href":"/airports/YYZ","code":"YYZ","name":"Toronto Pearson","utcOffset":{"iso":"-04:00","hours":-4,"minutes":-240}}},"arrival":{"scheduledTime":"2021-04-23 17:21:04Z","airport":{"href":"/airports/YYT","code":"YYT","name":"St. John\'s International","utcOffset":{"iso":"-02:30","hours":-2.5,"minutes":-150}}}}],"reservationStatus":{"cancelled":false,"open":false,"finalized":false,"external":false}}],"passengerJourneyDetails":[{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/journeys/idiJkTZqRwES¥0Fo8YƒyYw==/passengerJourneyDetails/HKZ5y8N4qƒt1JH¥ZJz9CXQ==","key":"HKZ5y8N4qƒt1JH¥ZJz9CXQ==","passenger":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/passengers/t2MkLBokPWOfz6DEMcdjeg==","key":"t2MkLBokPWOfz6DEMcdjeg=="},"segment":null,"bookingKey":"5f22441a877f15c21e9d236a5d44fa0811a90f2583a48ffec325e5babd1532ef","fareClass":{"href":"/fareClasses/wb4xb3F9Evee1nOH8bSvfc4Tho49bdnSLPZxoKni%C2%A5nY=","key":"wb4xb3F9Evee1nOH8bSvfc4Tho49bdnSLPZxoKni¥nY=","code":"YOWFF","description":"One Way Full-Fare"},"bookingCode":{"href":"/bookingCodes/Y","code":"Y","description":"Unrestricted"},"cabinClass":{"href":"/cabinClasses/Y","code":"Y","description":"Economy"},"realizedRevenue":false,"shuttle":false,"privateFares":false,"ticketNumber":"","notes":"","reservationStatus":{"confirmed":true,"waitlist":false,"standby":false,"cancelled":false,"open":false,"finalized":false,"external":false}}],"reservationStatus":{"cancelled":false,"open":false,"finalized":false,"external":false}}],"insurancePolicies":[{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/insurancePolicies/1cTUzafIƒ9rMcTU3R","key":"1cTUzafIƒ9rMcTU3R","purchaseKey":"afR9z3Iƒ9rMcTU3afIƒ91VcR9z3rMcTU3","number":"YYAVNAA0000001","insuranceProvider":{"key":"UzcTU3afafIƒ9rMccTU3af","name":"Star Insurance"},"policyStatus":{"confirmed":true,"cancelled":false,"finalized":false}}],"ancillaryPurchases":[{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/ancillaryPurchases/idiJkTZqRwES¥0Fo8YƒyYw==","key":"idiJkTZqRwES¥0Fo8YƒyYw==","purchaseKey":"5f22441a877f15c21e9d236a5d44fa0811a90f2583a48ffec325e5babd1532ef","passenger":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/passengers/t2MkLBokPWOfz6DEMcdjeg==","key":"t2MkLBokPWOfz6DEMcdjeg=="},"journey":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/journeys/idiJkTZqRwES¥0Fo8YƒyYw==","key":"idiJkTZqRwES¥0Fo8YƒyYw=="},"requirementLocation":{"date":"2021-04-23","airport":null,"cityPair":null,"flight":{"href":"/flights/0HIsZirkHemOXnkAIAAav02YGyUhnSULjg5vIb0x7Ks=","key":"0HIsZirkHemOXnkAIAAav02YGyUhnSULjg5vIb0x7Ks=","airlineCode":{"href":"/airlineCodes/YY","code":"YY"},"flightNumber":"705"}},"ancillaryItem":{"key":"HKZ5y8N4qƒt1JH¥ZJz9CXQ==","name":"Chicken Soup","ancillaryCategory":{"key":"NpI97qWƒPw2ZHpXcQTEtGw==","name":"Meal","external":false},"serviceRequest":{"href":"/serviceRequests/VCdctXmbmONuZuKmN5n7bnvfZMfkuyrs=","key":"VCdctXmbmONuZuKmN5n7bnvfZMfkuyrs=","code":"SPML"},"serviceRequestNote":""},"ancillaryRedemption":{"reference":"","status":{"available":true,"redeemed":false}}}],"seatSelections":[{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/seatSelections/iRfZBj7taPIrT6mFp38s4C6928m8e","key":"iRfZBj7taPIrT6mFp38s4C6928m8e","selectionKey":"T6mFp38s4C66mFp38s4C","passenger":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/passengers/t2MkLBokPWOfz6DEMcdjeg==","key":"t2MkLBokPWOfz6DEMcdjeg=="},"journey":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/journeys/idiJkTZqRwES¥0Fo8YƒyYw==","key":"idiJkTZqRwES¥0Fo8YƒyYw=="},"segment":{"key":"OwK7VhanpmfvaUGDcnYedQ==","legs":[{"key":"NpI97qWƒPw2ZHpXcQTEtGw=="}]},"seatMapCell":{"key":"HKZ5y8N4qƒt1JH¥ZJz9CXQ==","rowIdentifier":"15","seatIdentifier":"A"},"reservationStatus":{"confirmed":true,"open":false}}],"passengerLegDetails":[{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/passengerLegDetails/fIƒ9rMVcTU3Rvƒx7Fq==","key":"fIƒ9rMVcTU3Rvƒx7Fq==","passenger":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/passengers/t2MkLBokPWOfz6DEMcdjeg==","key":"t2MkLBokPWOfz6DEMcdjeg=="},"journey":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/journeys/idiJkTZqRwES¥0Fo8YƒyYw==","key":"idiJkTZqRwES¥0Fo8YƒyYw=="},"segment":{"key":"OwK7VhanpmfvaUGDcnYedQ=="},"leg":{"key":"afIƒ9rMƒx7Fqƒq0J1VcTU=="},"reservationStatus":{"confirmed":true,"waitlist":false,"standby":false,"cancelled":false,"finalized":false,"external":false},"travelStatus":{"notCheckedIn":false,"checkedIn":true,"boarded":false,"noshow":false},"boardingSequenceNumber":"1","thru":false}],"charges":[{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/charges/Hm4kRrUOQubXzfVX9qNvTMC6A==","key":"Hm4kRrUOQubXzfVX9qNvTMC6A==","passenger":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/passengers/t2MkLBokPWOfz6DEMcdjeg==","key":"t2MkLBokPWOfz6DEMcdjeg=="},"journey":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/journeys/idiJkTZqRwES¥0Fo8YƒyYw==","key":"idiJkTZqRwES¥0Fo8YƒyYw=="},"chargeTime":"2021-04-18 09:41:06Z","description":"Airport Tax Domestic","chargeType":{"href":"/chargeTypes/AI","code":"AI","description":"Airport Improvement Fund"},"surcharge":{"href":"/surcharges/X2fXNzLhG1ZdI6mgOVBri8ETHP1","key":"X2fXNzLhG1ZdI6mgOVBri8ETHP1¥z0ESQynMzbzZtIw=","identifier":"AXD","description":"Airport Tax Domestic"},"currencyAmounts":[{"baseAmount":123.45,"discountAmount":0,"taxAmount":0,"taxRateAmounts":null,"totalAmount":123.45,"currency":{"href":"/currencies/CAD","code":"CAD","description":"Canadian Dollar"},"exchangeRate":1}],"taxConfiguration":{"href":"/taxConfigurations/ijZS0t2ƒmaj2aZgJƒ0sQƒy8Gsƒs1K2WdTV4Swjst1Ql=","key":"ijZS0t2ƒmaj2aZgJƒ0sQƒy8Gsƒs1K2WdTV4Swjst1Ql=","name":"TAX EXEMPT"},"status":{"active":true,"historical":false,"pending":false},"discount":{"href":"/discounts/gUR3YMKBb2HB5w6mMxWYPot%C6%92SSgcXw7hqxM%C6%92f85IRak=","key":"gUR3YMKBb2HB5w6mMxWYPotƒSSgcXw7hqxMƒf85IRak=","identifier":"ID10","description":"10% OFF"},"refundable":true,"privateFares":false,"notes":null}],"paymentTransactions":[{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/paymentTransactions/t2MkLBokPWOfz6DEMcdjeg==","key":"t2MkLBokPWOfz6DEMcdjeg==","paymentTime":"2021-04-18 09:41:06Z","description":"Payment Transaction Description","paymentMethod":{"href":"/paymentMethods/tfCeB5%C2%A5mircWvs2C4HkDdNvKIxzt2qfC4wYVrOrXTkU=","key":"tfCeB5%C2%A5mircWvs2C4HkDdNvKIxzt2qfC4wYVrOrXTkU=","identifier":"CA"},"paymentMethodCriteria":{"creditCard":{"number":"1234********5678","expiryMonth":3,"expiryYear":18,"verificationNumber":null,"cardHolder":"John Smith","reference":"Credit Card Reference","paymentMonths":2,"billing":{"contactInformation":{"name":"Smith, John"},"address":{"address1":"123 Sample Road","address2":"","city":"Springfield","location":{"country":{"href":"/countries/CAN","code":"CAN","name":"Canada"},"province":{"href":"/countries/CAN/provinces/NB","code":"NB","name":"New-Brunswick"}},"postalCode":"Z0Z 0Z0"}},"shipping":null,"clientIP":null,"transaction":{"identifier":"Transation Id","reference":"Transaction Reference","authorization":"Transaction Authorization"},"redirect":null,"threeDSecure":null}},"currencyAmounts":[{"totalAmount":123.45,"currency":{"href":"/currencies/CAD","code":"CAD","description":"Canadian Dollar","baseCurrency":true},"exchangeRate":1}],"payerDescription":"Payer Description","receiptNumber":123456,"payments":[{"key":"idiJkTZqRwES¥0Fo8YƒyYw==","currencyAmounts":[{"totalAmount":123.45,"currency":{"href":"/currencies/CAD","code":"CAD","description":"Canadian Dollar","baseCurrency":true},"exchangeRate":1}],"passenger":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/passengers/t2MkLBokPWOfz6DEMcdjeg==","key":"t2MkLBokPWOfz6DEMcdjeg=="}}],"refundTransactions":[{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/paymentTransactions/t2MkLBokPWOfz6DEMcdjeg==/refundTransactions/idiJkTZqRwES¥0Fo8YƒyYw==","key":"idiJkTZqRwES¥0Fo8YƒyYw==","refundTime":"2021-04-19 09:41:06Z","currencyAmounts":[{"totalAmount":123.45,"currency":{"href":"/currencies/CAD","code":"CAD","description":"Canadian Dollar","baseCurrency":true},"exchangeRate":1}],"refunds":[{"key":"idiJkTZqRwES¥0Fo8YƒyYw==","payment":{"key":"idiJkTZqRwES¥0Fo8YƒyYw==","passenger":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/passengers/t2MkLBokPWOfz6DEMcdjeg==","key":"t2MkLBokPWOfz6DEMcdjeg=="}},"currencyAmounts":[{"totalAmount":123.45,"currency":{"href":"/currencies/CAD","code":"CAD","description":"Canadian Dollar","baseCurrency":true},"exchangeRate":1}]}]}],"notes":"Payment Transaction Notes"}],"eTickets":[{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/eTickets/fzFo8YƒyYw6DEMcdjeg==","key":"fzFo8YƒyYw6DEMcdjeg==","external":true,"passenger":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/passengers/t2MkLBokPWOfz6DEMcdjeg==","key":"t2MkLBokPWOfz6DEMcdjeg=="},"journey":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/journeys/idiJkTZqRwES¥0Fo8YƒyYw==","key":"idiJkTZqRwES¥0Fo8YƒyYw=="},"segment":{"key":"Bx7rF3C2A5xvOFklg="},"charges":[{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/charges/Hm4kRrUOQubXzfVX9qNvTMC6A==","key":"Hm4kRrUOQubXzfVX9qNvTMC6A=="}],"number":"9672100000680C1","status":{"active":true,"historical":false},"assignment":"Assigned","couponStatus":{"description":"Open For Use","iataCode":"O","padisCode":"I"},"infant":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/passengers/t2MkLBokPWOfz6DEMcdjeg==/infants/idiJkTZqRwES¥0Fo8YƒyYw==","key":"idiJkTZqRwES¥0Fo8YƒyYw=="}}],"eMiscellaneousDocuments":[{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/eMiscellaneousDocuments/hzHo8YƒyYw6DcMcdjeg==","key":"hzHo8YƒyYw6DcMcdjeg==","external":true,"passenger":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/passengers/t2MkLBokPWOfz6DEMcdjeg==","key":"t2MkLBokPWOfz6DEMcdjeg=="},"journey":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/journeys/idiJkTZqRwES¥0Fo8YƒyYw==","key":"idiJkTZqRwES¥0Fo8YƒyYw=="},"reasonForIssuance":{"reasonForIssuanceCode":{"code":"A","description":"Air Transportation"},"reasonForIssuanceSubCode":{"code":"0B5","description":"PRE-RESERVED SEAT ASSIGNMENT"}},"charge":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/charges/Hm4kRrUOQubXzfVX9qNvTMC6A==","key":"Hm4kRrUOQubXzfVX9qNvTMC6A=="},"number":"9672100000680C1","couponStatus":{"description":"Open For Use","iataCode":"O","padisCode":"I"},"infant":{"href":"/reservations/diVR9z3ƒnzz1zafIƒ9rMƒx7Fqƒq0J1VcTU3Rvirs0Uk=/passengers/t2MkLBokPWOfz6DEMcdjeg==/infants/idiJkTZqRwES¥0Fo8YƒyYw==","key":"idiJkTZqRwES¥0Fo8YƒyYw=="}}]}';
              
              $apiReservation = json_decode($apiReservation, 1);
              
              
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
                  'time' => TimeHelper::getLocalTime($journey['segments'][0]['departure'], 'H:i'),
                  'ampm' => TimeHelper::getLocalTime($journey['segments'][0]['departure'], 'a'),
                ];
                $_journey['to'] = [
                  'name' => $journey['segments'][count($journey['segments'])-1]['arrival']['airport']['name'],
                  'code' => $journey['segments'][count($journey['segments'])-1]['arrival']['airport']['code'],
                  'time' => TimeHelper::getLocalTime($journey['segments'][count($journey['segments'])-1]['arrival'], 'H:i'),
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
                    'time' => TimeHelper::getLocalTime($segment['departure'], 'H:ia'),
                    'airport' => [
                      'name' => $segment['departure']['airport']['name'],
                      'code' => $segment['departure']['airport']['code'],
                      ]
                    ];
                    
                    $_segment['arrival'] = [
                      'time' => TimeHelper::getLocalTime($segment['arrival'], 'H:ia'),
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
            