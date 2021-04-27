<?php

namespace Drupal\aco_core\Traits;

use Drupal\Component\Utility\Html;
use Drupal\Component\Utility\NestedArray;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Datetime\DateHelper;
use Drupal\Core\Form\FormStateInterface;
use Drupal\intelisys\Utility\CommunicationChannels;
use Drupal\intelisys\Utility\Locations;
use Drupal\intelisys\Utility\TimeHelper;
use Drupal\aco_core\Utility\Defaults;
use Drupal\aco_core\Utility\Fields;

/**
 * A form builder trait.
 */
trait FormBuilderTrait {

  /**
   * Get contact information form by adult and child counts.
   *
   * @param array $form
   *   The form to add the fields to.
   * @param array $values
   *   The values.
   * @param bool $editing_owner
   *   Whether to add the reservation owner header or not.
   */
  protected function getMultipleContactInformationForms(array &$form, array &$values, $editing_owner = TRUE) {
    $adultCount = $values['adultCount'];
    $childCount = $values['childCount'];
    $passenger_count = $adultCount + $childCount;
    for ($i = 0; $i < $passenger_count; $i++) {
      $default_values = [];
      if (isset($values['passengers']) && isset($values['passengers'][$i])) {
        $default_values = $values['passengers'][$i];
      }
      if ($adultCount > 0) {
        if ($editing_owner && $i == 0) {
          $passenger = [
            '#type' => 'container',
            '#prefix' => '<div class="new-passenger row">',
            '#suffix' => '</div>',
            'header' => [
              '#type' => 'container',
              '#markup' => $this->t('<h3>Primary Reservation Contact Information</h3>'),
              '#prefix' => '<div class="new-passenger-title">',
            '#suffix' => '</div>',
            ],
          ];
          $this->getContactInformationForm($passenger, $default_values, [
            'context' => $i,
            'edit_mode' => FALSE,
          ]);
          $form['passengers'][] = $passenger;
        }
        else {
          $passenger = [
            '#type' => 'container',
            '#prefix' => '<div class="new-passenger row">',
            '#suffix' => '</div>',
            'header' => [
              '#type' => 'container',
              '#prefix' => '<div class="new-passenger-title">',
              '#suffix' => '</div>',
              '#markup' => $this->t('<h3>Additional Passenger #@count Information (Adult)</h3>', [
                '@count' => $i + 1,
              ]),
            ],
          ];
          $this->getAdultContactInformationForm($passenger, $default_values, [
            'context' => $i,
            'edit_mode' => FALSE,
          ]);
          $form['passengers'][] = $passenger;
        }
        $adultCount--;
      }
      elseif ($childCount > 0) {
        $passenger = [
          '#type' => 'container',
            '#prefix' => '<div class="new-passenger row">',
            '#suffix' => '</div>',
          'header' => [
            '#type' => 'container',
            '#prefix' => '<div class="new-passenger-title">',
              '#suffix' => '</div>',
            '#markup' => $this->t('<h3>Additional Passenger #@count Information (Child)</h3>', [
              '@count' => $i + 1,
            ]),
          ],
        ];
        $this->getChildContactInformationForm($passenger, $default_values, [
          'context' => $i,
          'edit_mode' => FALSE,
        ]);
        $form['passengers'][] = $passenger;
        $childCount--;
      }
    }
  }

  /**
   * Get contact information form based on values.
   *
   * @param array $form
   *   The form to add the fields to.
   * @param array $values
   *   An array of values to populate the form with.
   * @param bool $fill
   *   Whether or not to use default values.
   */
  protected function getContactInformationFormByValues(array &$form, array &$values, $fill = TRUE) {
    // Prepare values.
    $combined = [
      Defaults::contactInformation(),
      $values['reservationProfile'],
      ['advancePassengerInformation' => $values['advancePassengerInformation']],
    ];
    $defaults = NestedArray::mergeDeepArray($combined, TRUE);
    if (isset($values['infants']) && !empty($values['infants'])) {
      $defaults['withInfant'] = 1;
      $defaults['infant'] = $values['infants'][0]['reservationProfile'];
    }

    
    if (!empty($defaults['personalContactInformation']['notificationPreferences'])) {
      $preferences = [];
      foreach ($defaults['personalContactInformation']['notificationPreferences'] as &$preference) {
        $id = $preference['identifier'];
        $preferences[$id] = $id;
      }
      $defaults['personalContactInformation']['notificationPreferences'] = $preferences;
    }
    else {
      $defaults['personalContactInformation']['notificationPreferences'] = [];
    }

    if ($values['reservationOwner']) {
      if ($fill) {
        $this->getContactInformationForm($form, $defaults);
      }
      else {
        $this->getContactInformationForm($form);
      }
    }
    else {
      $birth = strtotime($defaults['birthDate']);
      $is_adult = TimeHelper::isAdult($birth);
      if ($is_adult) {
        if ($fill) {
          $this->getAdultContactInformationForm($form, $defaults);
        }
        else {
          $this->getAdultContactInformationForm($form);
        }
      }
      elseif ($fill) {
        $this->getChildContactInformationForm($form, $defaults);
      }
      else {
        $this->getChildContactInformationForm($form);
      }
    }
  }

  /**
   * Get contact information form.
   *
   * @param array $form
   *   The form to add the fields to.
   * @param array $values
   *   An array of values to populate the form with.
   * @param array $options
   *   An array of options.
   */
  protected function getContactInformationFields(array &$form, array &$values = [], array $options = []) {
    // passengers form fields here 
    $form['title'] = [
      '#type' => 'select',
      '#title' => $this->t('Title'),
      '#title_display' => 'invisible',
      '#default_value' => $values['title'],
      
      '#required' => TRUE,
      '#options' => [
        'Mr' => $this->t('Mr.'),
        'Ms' => $this->t('Ms.'),
        'Mrs' => $this->t('Mrs.'),
      ],
      '#empty_option' => $this->t('Title *'),
    ];
    $form['firstName'] =  Fields::nameField($this->t('First Name'),  $values['firstName']);
    $form['middleName'] = Fields::nameField($this->t('Middle Name'), $values['middleName'], FALSE) ;
    $form['lastName'] = Fields::nameField($this->t('Last Name'), $values['lastName']);

    // custom col class for firstname input fields 
    $form['title']['#prefix'] = '<div class="col-md-3 col-sm-6">';
    $form['title']['#suffix'] = '</div>';
    $form['firstName']['#prefix'] = '<div class="col-md-3 col-sm-6">';
    $form['firstName']['#suffix']  =  '</div>';
    $form['middleName']['#prefix'] = '<div class="col-md-3 col-sm-6">';
    $form['middleName']['#suffix'] = '</div>';
    $form['lastName']['#prefix'] = '<div class="col-md-3 col-sm-6">';
    $form['lastName']['#suffix'] = '</div>';



    $this->getAddressFields($form, $values, $options);
    $form['customH']=[
      '#markup' => '<h3>Date of Birth</h3>',
    ];
    $this->getBirthDateFields($form, $values, $options);
    $form['customL']=[
      '#markup' => '<h3>Loyalty & Traveler Number</h3>',
    ];
    $form['loyaltyProgram']['number'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Loyalty ID'),
      '#title_display' => 'invisible',
      '#placeholder' => $this->t('Loyalty ID (exclude 3E)'),
      '#default_value' => !empty($values['loyaltyProgram']) ? $values['loyaltyProgram']['number'] : NULL,
      '#maxlength' => 128,
    ];
    $form['advancePassengerInformation']['redressNumber'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Redress Number'),
      '#title_display' => 'invisible',
      '#placeholder' => $this->t('Redress Number'),
      '#default_value' => !empty($values['advancePassengerInformation']) ? $values['advancePassengerInformation']['redressNumber'] : NULL,
      '#maxlength' => 13,
    ];
    $form['advancePassengerInformation']['knownPassengerNumber'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Known Traveler Number'),
      '#title_display' => 'invisible',
      '#placeholder' => $this->t('Known Traveler Number'),
      '#default_value' => !empty($values['advancePassengerInformation']) ? $values['advancePassengerInformation']['knownPassengerNumber'] : NULL,
      '#maxlength' => 25,
    ];
    $form['customPh']=[
      '#markup' => '<h3>Phone & Email</h3>',
    ];

    $form['personalContactInformation']['email'] = Fields::emailField($this->t('Email'), $values['personalContactInformation']['email']);
    $form['personalContactInformation']['verifyEmail'] = Fields::emailField($this->t('Repeat Email'), $values['personalContactInformation']['email']);
    $form['personalContactInformation']['phoneNumber'] = Fields::phoneField($this->t('Phone Number'), $values['personalContactInformation']['phoneNumber']);
    $form['personalContactInformation']['mobileNumber'] = Fields::phoneField($this->t('Mobile Number'), $values['personalContactInformation']['mobileNumber']);


    $form['personalContactInformation']['customNo5']=[
      '#markup' => '<h3>Notification Preferences</h3>',
    ];
    $form['personalContactInformation']['notificationPreferences'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Notification Preferences'),
      '#title_display' => 'invisible',
      '#options' => CommunicationChannels::getNotificationPreferencesOptions(),
      '#default_value' => $values['persloyaltyProgramonalContactInformation']['notificationPreferences'],
      '#multiple' => TRUE,
      // Once a preference has been set, it can't be unset.
      '#required' => $options['edit_mode'] && !empty($values['personalContactInformation']['notificationPreferences']),
    ];


    // custom col class for Notification input fields 
    $form['personalContactInformation']['notificationPreferences']['#prefix'] = '<div class="col-md-12 notificaton-section">';
    $form['personalContactInformation']['notificationPreferences']['#suffix'] = '</div>';

    // custom col class for loyalty input fields 
    $form['loyaltyProgram']['number']['#prefix'] = '<div class="col-md-4">';
    $form['loyaltyProgram']['number']['#suffix'] = '</div>';
    $form['advancePassengerInformation']['redressNumber']['#prefix'] = '<div class="col-md-4">';
    $form['advancePassengerInformation']['redressNumber']['#suffix']  =  '</div>';
    $form['advancePassengerInformation']['knownPassengerNumber']['#prefix'] = '<div class="col-md-4">';
    $form['advancePassengerInformation']['knownPassengerNumber']['#suffix'] = '</div>';

    // custom col class for phone input fields 
    $form['personalContactInformation']['email']['#prefix'] = '<div class="col-md-6">';
    $form['personalContactInformation']['email']['#suffix'] = '</div>';
    $form['personalContactInformation']['verifyEmail']['#prefix'] = '<div class="col-md-6">';
    $form['personalContactInformation']['verifyEmail']['#suffix']  =  '</div>';
    $form['personalContactInformation']['phoneNumber']['#prefix'] = '<div class="col-md-6">';
    $form['personalContactInformation']['phoneNumber']['#suffix'] = '</div>';
    $form['personalContactInformation']['mobileNumber']['#prefix'] = '<div class="col-md-6">';
    $form['personalContactInformation']['mobileNumber']['#suffix'] = '</div>';
 
  }

  /**
   * Get infant form.
   *
   * @param array $form
   *   The form to add the fields to.
   * @param array $values
   *   An array of values to populate the form with.
   */
  protected function getWithInfantFields(array &$form, array &$values = []) {
    $with_infant_id = Html::getUniqueId('with-infant-checkbox');
    $form['withInfantt'] = [
      '#markup' => '<h3>Infant Information</h3>'
    ];



    $form['withInfant'] = [
      '#type' => 'checkbox',
      '#id' => $with_infant_id,
      '#title' => $this->t('With infant?'),
      '#default_value' => intval($values['withInfant']),
      
    ];
    $form['infant']['firstName'] = Fields::nameField($this->t('First Name'), $values['infant']['firstName'], FALSE);
    $form['infant']['firstName']['#states'] = [
      'disabled' => [
        '#' . $with_infant_id => ['checked' => FALSE],
      ],
      'required' => [
        '#' . $with_infant_id => ['checked' => TRUE],
      ],
    ];
    $form['infant']['lastName'] = Fields::nameField($this->t('Last Name'), $values['infant']['lastName'], FALSE);
    $form['infant']['lastName']['#states'] = [
      'disabled' => [
        '#' . $with_infant_id => ['checked' => FALSE],
      ],
      'required' => [
        '#' . $with_infant_id => ['checked' => TRUE],
      ],
    ];
    $form['infant']['infanth3h'] = [
      '#markup' => '<h3>Infant Date of Birth</h3>',
    ];

    $this->getBirthDateFields($form['infant'], $values['infant'], ['age_limit' => TimeHelper::INFANT_AGE_LIMIT], FALSE);
    $form['infant']['birthDateMonth']['#states'] = [
      'disabled' => [
        '#' . $with_infant_id => ['checked' => FALSE],
      ],
      'required' => [
        '#' . $with_infant_id => ['checked' => TRUE],
      ],
    ];
    $form['infant']['birthDateDay']['#states'] = [
      'disabled' => [
        '#' . $with_infant_id => ['checked' => FALSE],
      ],
      'required' => [
        '#' . $with_infant_id => ['checked' => TRUE],
      ],
    ];
    $form['infant']['birthDateYear']['#states'] = [
      'disabled' => [
        '#' . $with_infant_id => ['checked' => FALSE],
      ],
      'required' => [
        '#' . $with_infant_id => ['checked' => TRUE],
      ],
    ];

    

    // custom col class for With infant input fields 
    $form['withInfant']['#prefix'] = '<div class="col-md-12 infant-section">';
    $form['withInfant']['#suffix'] = '</div>';
    $form['infant']['firstName']['#prefix'] = '<div class="col-md-6 infant-fname">';
    $form['infant']['firstName']['#suffix'] = '</div>';
    $form['infant']['lastName']['#prefix'] = '<div class="col-md-6 infant-lastName">';
    $form['infant']['lastName']['#suffix'] = '</div>';
   


  }

  /**
   * Get contact information form.
   *
   * @param array $form
   *   The form to add the fields to.
   * @param array $values
   *   An array of values to populate the form with.
   * @param array $options
   *   An array of options.
   */
  protected function getContactInformationForm(array &$form, array &$values = [], array $options = []) {
    $default_options = [
      'context' => NULL,
      'edit_mode' => TRUE,
      'age_limit' => TimeHelper::LIFE_EXPECTANCY,
    ];
    $settings = array_merge($default_options, $options);
    $combined = [Defaults::contactInformation(), $values];
    $defaults = NestedArray::mergeDeepArray($combined, TRUE);
    $this->getContactInformationFields($form, $defaults, $settings);
    // $withInfant = [
    //   '#type' => 'container',
  
    //   '#prefix' => '<h1>HELLLLLLOOOOOOOOO</h1><div class="random-class">',
    //   '#suffix' => '</div>',
    // ];
    // $this->getWithInfantFields($withInfant, $defaults);
    // $form['withInfant'] = $withInfant;


    $this->getWithInfantFields($form, $defaults);
  }

  /**
   * Get adult contact information form.
   *
   * @param array $form
   *   The form to add the fields to.
   * @param array $values
   *   An array of values to populate the form with.
   * @param array $options
   *   An array of options.
   */
  protected function getAdultContactInformationForm(array &$form, array $values = [], array $options = []) {
    $this->getContactInformationForm($form, $values, $options);
    unset($form['middleName']);
    unset($form['address']);
    unset($form['personalContactInformation']['mobileNumber']);
    unset($form['personalContactInformation']['email']);
    unset($form['personalContactInformation']['verifyEmail']);
    unset($form['personalContactInformation']['notificationPreferences']);
  }

  /**
   * Get child contact information form.
   *
   * @param array $form
   *   The form to add the fields to.
   * @param array $values
   *   An array of values to populate the form with.
   * @param array $options
   *   An array of options.
   */
  protected function getChildContactInformationForm(array &$form, array $values = [], array $options = []) {
    $default_options = [
      'context' => NULL,
      'edit_mode' => TRUE,
      'age_limit' => TimeHelper::CHILD_AGE_LIMIT,
    ];
    $settings = array_merge($default_options, $options);
    $combined = [Defaults::contactInformation(), $values];
    $defaults = NestedArray::mergeDeepArray($combined, TRUE);
    $this->getContactInformationFields($form, $defaults, $settings);
    $form['title']['#options'] = [
      '' => $this->t('Title'),
      'Master' => $this->t('Master'),
      'Miss' => $this->t('Miss'),
    ];
    unset($form['middleName']);
    unset($form['address']);
    unset($form['personalContactInformation']['mobileNumber']);
    unset($form['personalContactInformation']['email']);
    unset($form['personalContactInformation']['verifyEmail']);
    unset($form['personalContactInformation']['notificationPreferences']);
  }

  /**
   * Helper function to build birth date fields.
   *
   * @param array $form
   *   The form to add the fields to.
   * @param array $defaults
   *   An array of values to populate the form with.
   * @param array $options
   *   An array of options.
   * @param bool $required
   *   If the fields are required.
   */
  protected function getBirthDateFields(array &$form, array &$defaults, array $options = [], $required = TRUE) {
    static $current_year;

    // Get the current year.
    if (!isset($current_year)) {
      $current_year = date('Y', REQUEST_TIME);
    }
    // for date of birthday 


    // Extract birthday date.
    $birthDate = $birthDateYear = $birthDateMonth = $birthDateDay = '';
    if (!empty($defaults['birthDate'])) {
      $birthDate = $defaults['birthDate'];
    }
    elseif (!empty($defaults['birthDateYear']) &&
      !empty($defaults['birthDateMonth']) &&
      !empty($defaults['birthDateDay'])) {
      $birthDate = TimeHelper::getYmd($defaults['birthDateYear'], $defaults['birthDateMonth'], $defaults['birthDateDay']);
    }
    if (!empty($birthDate)) {
      try {
        $date = DrupalDateTime::createFromFormat('Y-m-d', $birthDate);
        if ($date instanceof DrupalDateTime && !$date->hasErrors()) {
          $birthDateYear = $date->format('Y');
          $birthDateMonth = $date->format('m');
          $birthDateDay = $date->format('d');
        }
      }
      catch (\Exception $e) {
        // Reset values.
        $birthDate = $birthDateYear = $birthDateMonth = $birthDateDay = '';
      }
    }

    $form['birthDateMonth'] = [
      '#type' => 'select',
      '#title' => $this->t('Date of Birth Month'),
      '#title_display' => 'invisible',
      '#options' => ['' => $required ? $this->t('Month *') : $this->t('Month')] + DateHelper::monthNames(TRUE),
      '#default_value' => empty($birthDateMonth) ? '' : intval($birthDateMonth),
      '#required' => $required,
    ];
    $form['birthDateDay'] = [
      '#type' => 'select',
      '#title' => $this->t('Date of Birth Day'),
      '#title_display' => 'invisible',
      '#options' => ['' => $required ? $this->t('Day *') : $this->t('Day')] + DateHelper::days(TRUE),
      '#default_value' => empty($birthDateDay) ? '' : intval($birthDateDay),
      '#required' => $required,
    ];
    $form['birthDateYear'] = [
      '#type' => 'select',
      '#title' => $this->t('Date of Birth Year'),
      '#title_display' => 'invisible',
      '#options' => ['' => $required ? $this->t('Year *') : $this->t('Year')] + DateHelper::years(intval($current_year - $options['age_limit']), intval($current_year), TRUE),
      '#default_value' => empty($birthDateYear) ? '' : intval($birthDateYear),
      '#required' => $required,
    ];

    // custom col class for birthday input fields 
    $form['birthDateMonth']['#prefix'] = '<div class="col-md-3">';
    $form['birthDateMonth']['#suffix'] = '</div>';
    $form['birthDateDay']['#prefix'] = '<div class="col-md-2 conteact-infoday">';
    $form['birthDateDay']['#suffix']  =  '</div>';
    $form['birthDateYear']['#prefix'] = '<div class="col-md-3">';
    $form['birthDateYear']['#suffix'] = '</div>';
     
  }


  /**
   * Get address fields.
   *
   * @param array $form
   *   The form to add the fields to.
   * @param array $defaults
   *   An array of values to populate the form with.
   * @param array $options
   *   An array of options.
   */
  protected function getAddressFields(array &$form, array &$defaults, array $options = []) {
    $form['address']['address1'] = [
      '#type' => 'textfield',
      '#prefix' => ' <div class="col-md-6">',
      
      '#title' => $this->t('Address Line 1'),
      // '#title_display' => 'invisible',
      '#placeholder' => $this->t('Address Line 1 *'),
      '#default_value' => $defaults['address']['address1'],
      '#maxlength' => 50,
      '#required' => TRUE,
      '#suffix' => '</div>',
    ];
    $form['address']['address2'] = [
      '#type' => 'textfield',
      '#prefix' => '<div class="col-md-6">',
      '#title' => $this->t('Address Line 2'),
      // '#title_display' => 'invisible',
      '#placeholder' => $this->t('Address Line 2'),
      '#default_value' => $defaults['address']['address2'],
      '#maxlength' => 50,
      '#suffix' => '</div> ',
    ];
    $form['address']['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      // '#title_display' => 'invisible',
      '#placeholder' => $this->t('City *'),
      '#default_value' => $defaults['address']['city'],
      '#maxlength' => 50,
      '#required' => TRUE,
    ];
    $html_id = 'address';
    if (isset($options['context']) && !is_null($options['context'])) {
      $html_id .= '-' . $options['context'];
    }
    $form['address']['location']['country']['code'] = [ 
      '#type' => 'select',
      '#title' => $this->t('Country'),
      // '#title_display' => 'invisible',
      '#options' => ['' => $this->t('Country *')] + Locations::getCountryOptions(),
      '#default_value' => !empty($form['address']['location']) ? $defaults['address']['location']['country']['code'] : Locations::DEFAULT_COUNTRY_CODE,
      '#required' => TRUE,
      '#attributes' => ['data-ajax-province' => $html_id . '-country'],
      '#ajax' => [
        'event' => 'change',
        'callback' => [$this, 'populateProvice'],
        'wrapper' => $html_id . '-province',
        'progress' => [
          'type' => 'fullscreen',
        ],
      ],
     
    ];
    $form['address']['location']['province']['code'] = [
      
      '#type' => 'select',
      '#title' => $this->t('State'),
      // '#title_display' => 'invisible',
      '#options' => ['' => $this->t('State *')] + Locations::getProvinceOptions(!empty($defaults['address']['location']) ? $defaults['address']['location']['country']['code'] : Locations::DEFAULT_COUNTRY_CODE),
      '#default_value' => !empty($defaults['address']['location']) ? $defaults['address']['location']['province']['code'] : NULL,
      '#required' => TRUE,
      '#validated' => TRUE,
      '#prefix' => '<div id="' . $html_id . '-province" ',
      '#suffix' => '</div>',
      '#states' => [
        'disabled' => [
          ':input[data-ajax-province="' . $html_id . '-country"]' => ['value' => ''],
        ],
      ],
    
    ];
    $form['address']['postalCode'] = [
      
      '#type' => 'textfield',
      '#title' => $this->t('Zip Code'),
      // '#title_display' => 'invisible',
      '#placeholder' => $this->t('Zip Code *'),
      '#default_value' => $defaults['address']['postalCode'],
      '#maxlength' => 50,
      '#required' => TRUE,
      
    ];


    // custom col class for input fields 
    $form['address']['city']['#prefix'] = '<div class="col-md-4">';
    $form['address']['city']['#suffix'] = '</div>';
    $form['address']['location']['country']['code']['#prefix'] = '<div class="col-md-4">';
    $form['address']['location']['country']['code']['#suffix']  =  '</div>';
    $form['address']['postalCode']['#prefix'] = '<div class="col-md-2 conteact-infoday">';
    $form['address']['postalCode']['#suffix'] = '</div>';
    $form['address']['location']['province']['code']['#prefix'] = '<div class="col-md-2 conteact-infoday">';
    $form['address']['location']['province']['code']['#suffix'] = '</div>';


  }

  /**
   * Get purchase fields.
   *
   * @param array $form
   *   The form to add the fields to.
   * @param array $values
   *   The default values to use.
   * @param bool $copy_primary_passenger
   *   Add the copy primary passenger functionality to the form fields.
   */
  protected function getPurchaseFields(array &$form, array &$values, $copy_primary_passenger = TRUE) {
    $combined = [Defaults::billing(), $values];
    $defaults = NestedArray::mergeDeepArray($combined, TRUE);

    $form['paymentMethod'] = ['#tree' => TRUE];
    $form['paymentMethod']['identifier'] = [
      '#type' => 'radios',
      '#title' => $this->t('<h2>Payment Information</h2>'),
      '#required' => true,
      '#options' => [
        'amex' => $this->t('<span class="amex">American Express</span>'),
        'visa' => $this->t('<span class="visa">Visa</span>'),
        'discover' => $this->t('<span class="discover">Discover</span>'),
        'mastercard' => $this->t('<span class="mastercard">MasterCard</span>'),
      ],
    ];
    $form['billing'] = ['#tree' => TRUE];
    $form['billing']['creditCard']['number'] = [
      '#type' => 'textfield',
      '#prefix' => '<div class="row"><div class="col-md-6">',
      '#title' => $this->t('Credit Card'),
      // '#title_display' => 'invisible',
      '#placeholder' => $this->t('Credit Card *'),
      '#required' => TRUE,
      '#suffix' => '</div>',
    ];

    $today = DrupalDateTime::createFromTimestamp(REQUEST_TIME);
    $today->modify('first day of this month');
    $start = (new \DateTime($today->format('Y-m-d')));
    $end = (new \DateTime($today->format('Y-m-d')))->modify('+10 years');
    $interval = \DateInterval::createFromDateString('1 month');
    $period = new \DatePeriod($start, $interval, $end);
    $options = [];
    foreach ($period as $date) {
      $options[$date->format('Y/m')] = $date->format('F Y');
    }
    $form['billing']['creditCard']['expiry'] = [
      '#prefix' => '<div class="col-md-3">',
      '#type' => 'select',
      '#title' => $this->t('Expiration'),
      // '#title_display' => 'invisible',
      '#default_value' => $today->format('Y/m'),
      '#options' => $options,
      '#required' => TRUE,
      '#suffix' => '</div>',
    ];
    $form['billing']['creditCard']['verificationNumber'] = [
      '#prefix' => '<div class="col-md-3">',
      '#type' => 'textfield',
      '#title' => $this->t('Credit CVV'),
      // '#title_display' => 'invisible',
      '#placeholder' => $this->t('Credit CVV *'),
      '#required' => TRUE,
      '#suffix' => '</div></div>',
    ];
    $form['billing']['creditCard']['billing'] = [
      '#type' => 'container',
      // '#markup' => $this->t('<h4>Cardholder Information</h4>'),
    ];
    if ($copy_primary_passenger) {
      $form['billing']['creditCard']['billing']['copyPrimaryPassengerAddress'] = [
        '#type' => 'checkbox',
        '#name' => '',
        '#title' => $this->t('Use the primary passenger address for the billing address?'),
        '#attributes' => [
          'data-copy-group' => 'primarypassenger',
        ],
      ];
    }
    $form['billing']['creditCard']['billing']['contactInformation']['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Full Name'),
      // '#title_display' => 'invisible',
      '#placeholder' => $this->t('Full Name *'),
      '#default_value' => $defaults['billing']['creditCard']['billing']['contactInformation']['name'],
      '#required' => TRUE,
    ];
    $this->getAddressFields($form['billing']['creditCard']['billing'], $defaults['billing']['creditCard']['billing']);
    $form['billing']['creditCard']['billing']['phoneNumber'] = Fields::phoneField($this->t('Phone Number'), $defaults['billing']['creditCard']['billing']['phoneNumber']);
    unset($form['billing']['creditCard']['billing']['phoneNumber']['#title_display']);
    $form['billing']['creditCard']['billing']['phoneNumber']['#prefix'] = '<div class="col-md-3">';
    $form['billing']['creditCard']['billing']['phoneNumber']['#suffix'] = '</div>';

    if ($copy_primary_passenger) {
      $form['billing']['creditCard']['billing']['contactInformation']['name']['#attributes'] = [
        'data-primarypassenger' => $defaults['passengers'][0]['firstName'] . ' ' . $defaults['passengers'][0]['lastName'],
      ];
      $form['billing']['creditCard']['billing']['address']['address1']['#attributes'] = [
        'data-primarypassenger' => $defaults['passengers'][0]['address']['address1'],
      ];
      $form['billing']['creditCard']['billing']['address']['address2']['#attributes'] = [
        'data-primarypassenger' => $defaults['passengers'][0]['address']['address2'],
      ];
      $form['billing']['creditCard']['billing']['address']['city']['#attributes'] = [
        'data-primarypassenger' => $defaults['passengers'][0]['address']['city'],
      ];
      $form['billing']['creditCard']['billing']['address']['location']['country']['code']['#attributes'] = [
        'data-primarypassenger' => $defaults['passengers'][0]['address']['location']['country']['code'],
      ];
      $form['billing']['creditCard']['billing']['address']['location']['province']['code']['#attributes'] = [
        'data-primarypassenger' => $defaults['passengers'][0]['address']['location']['province']['code'],
      ];
      $form['billing']['creditCard']['billing']['address']['postalCode']['#attributes'] = [
        'data-primarypassenger' => $defaults['passengers'][0]['address']['postalCode'],
      ];
      $form['billing']['creditCard']['billing']['phoneNumber']['#attributes'] = [
        'data-primarypassenger' => $defaults['passengers'][0]['personalContactInformation']['phoneNumber'],
      ];
    }
  }

  /**
   * Get booking fields.
   *
   * @param array $form
   *   The form to add the fields to.
   * @param Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   * @param array $values
   *   The default values.
   */
  protected function getBookingFields(array &$form, FormStateInterface $form_state, array &$values) {
    $options = Locations::getOriginAirportOptions();
    $all_options = Locations::getAirportOptions();

    $form['departure'] = [
      '#type' => 'select',
      '#title' => $this->t('Departure'),
      // '#title_display' => 'invisible',
      '#options' => $options,
      '#empty_option' => $this->t('City of Origin'),
      '#default_value' => $values['departure'],
      '#required' => TRUE,
      '#ajax' => [
        'event' => 'change',
        'callback' => [$this, 'populateDestinationCity'],
        'wrapper' => 'destination-city-wrapper',
        'progress' => [
          'type' => 'fullscreen',
        ],
      ],
    ];
    $form['arrival'] = [
      '#type' => 'select',
      '#title' => $this->t('Arrival'),
      // '#title_display' => 'invisible',
      '#options' => $all_options,
      '#empty_option' => $this->t('Destination City'),
      '#default_value' => $values['arrival'],
      '#required' => TRUE,
      '#prefix' => '<div id="destination-city-wrapper">',
      '#suffix' => '</div>',
      '#states' => [
        'disabled' => [
          ':input[name="departure"]' => ['value' => ''],
        ],
      ],
    ];
    $now = DrupalDateTime::createFromTimestamp(REQUEST_TIME);
    $format = 'm/d/Y';
    $from = '';
    if (!empty($values['from'])) {
      $date = DrupalDateTime::createFromTimestamp(strtotime($values['from']));
      $from = $date->format($format);
    }
    $form['#attached']['library'][] = 'webform/webform.form';
    $form['from'] = [
      '#type' => 'date',
      '#datepicker' => TRUE,
      '#title' => $this->t('Departure Date'),
      // '#title_display' => 'invisible',
      '#placeholder' => $this->t('MM/DD/YYYY'),
      '#default_value' => $from,
      '#required' => TRUE,
      '#attributes' => [
        'type' => 'text',
        'placeholder' => $this->t('MM/DD/YYYY'),
        'min' => $now->format($format),
        'data-min-year' => $now->format('Y'),
        'data-drupal-date-format' => $format,
        'style' => 'text-transform:uppercase;',
      ],
      '#attached' => [
        'drupalSettings' => ['webform' => ['dateFirstDay' => 0]],
        'library' => ['webform/webform.element.date'],
      ],
      '#ajax' => [
        'event' => 'change',
        'callback' => [$this, 'updateReturnDate'],
        'wrapper' => 'return-date-wrapper',
        'progress' => [
          'type' => 'fullscreen',
        ],
        'disable-refocus' => TRUE,
      ],
    ];
    $to = '';
    if (!empty($values['to'])) {
      $date = DrupalDateTime::createFromTimestamp(strtotime($values['to']));
      $to = $date->format($format);
    }
    $to_min = $now->format($format);
    if ($from = $form_state->getValue('from')) {
      $date = DrupalDateTime::createFromTimestamp(strtotime($from));
      $to_min = $date->format($format);
    }
    $form['to'] = [
      '#type' => 'date',
      '#datepicker' => TRUE,
      '#title' => $this->t('Return Date'),
      // '#title_display' => 'invisible',
      '#placeholder' => $this->t('MM/DD/YYYY'),
      '#default_value' => $to,
      '#prefix' => '<div id="return-date-wrapper">',
      '#suffix' => '</div>',
      '#disabled' => $values['isRoundtrip'] ? FALSE : TRUE,
      '#attributes' => [
        'type' => 'text',
        'placeholder' => $this->t('MM/DD/YYYY'),
        'min' => $to_min,
        'data-min-year' => $now->format('Y'),
        'data-drupal-date-format' => $format,
        'style' => 'text-transform:uppercase;',
      ],
      '#attached' => [
        'drupalSettings' => ['webform' => ['dateFirstDay' => 0]],
        'library' => ['webform/webform.element.date'],
      ],
      '#states' => [
        'disabled' => [
          ':input[name="isRoundtrip"]' => ['checked' => FALSE],
        ],
        'required' => [
          ':input[name="isRoundtrip"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['adultCount'] = [
      '#type' => 'number',
      '#title' => $this->t('Adults'),
      // '#title_display' => 'invisible',
      '#placeholder' => $this->t('Adults *'),
      '#default_value' => $values['adultCount'] == 0 ? 1 : $values['adultCount'],
      '#required' => TRUE,
      '#min' => 1,
    ];
    $form['childCount'] = [
      '#type' => 'number',
      '#title' => $this->t('Child'),
      // '#title_display' => 'invisible',
      '#placeholder' => $this->t('Child'),
      '#default_value' => $values['childCount'] == 0 ? '' : $values['childCount'],
      '#min' => 0,
    ];
    $form['infantCount'] = [
      '#type' => 'number',
      '#title' => $this->t('Infant'),
      // '#title_display' => 'invisible',
      '#placeholder' => $this->t('Infant'),
      '#default_value' => $values['infantCount'] == 0 ? '' : $values['infantCount'],
      '#min' => 0,
    ];
    $form['promoCode'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promo Code'),
      // '#title_display' => 'invisible',
      '#placeholder' => $this->t('Promo Code'),
      '#default_value' => $values['promoCode'],
    ];
    $form['isRoundtrip'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Round trip?'),
      '#default_value' => $values['isRoundtrip'],
    ];

    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Find Your Flight'),
    ];
  }

  /**
   * AJAX callback handler to populate the destination city.
   */
  public function populateDestinationCity(array $form, FormStateInterface $form_state) {
    $options = Locations::getDestinationAirportOptions($form_state->getValue('departure'));
    $form['arrival']['#options'] = ['' => $this->t('Destination City')] + $options;
    return $form['arrival'];
  }

  /**
   * AJAX callback handler to update return date.
   */
  public function updateReturnDate(array $form, FormStateInterface $form_state) {
    return $form['to'];
  }

  /**
   * AJAX callback handler to populate the province.
   */
  public function populateProvice(array $form, FormStateInterface $form_state) {
    // Find the field to update.
    $field = &$form;
    $name = $form_state->getTriggeringElement()['#name'];
    foreach (explode('[', $name) as $element_name) {
      // Chop off the ']' that may exist.
      if (substr($element_name, -1) == ']') {
        $element_name = substr($element_name, 0, -1);
      }
      if ($element_name == 'address') {
        break;
      }
      $field = &$field[$element_name];
    }

    $options = Locations::getProvinceOptions($form_state->getTriggeringElement()['#value']);
    $field['address']['location']['province']['code']['#options'] = ['' => $this->t('State *')] + $options;
    return $field['address']['location']['province']['code'];
  }

}
