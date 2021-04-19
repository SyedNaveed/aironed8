<?php

namespace Drupal\airchoice_member\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\airchoice_member\AirchoiceMember;


/**
 * Class ChangeMembershipForm.
 */
class ChangeMembershipForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'change_membership_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {


    //get current user info packages, etc
    $uid = \Drupal::currentUser()->id();
    if(!$uid)
    {
      
      return ['access denied'=>['#markup'=>'Access denied']];
      exit;
    }
    $userData = AirchoiceMember::getBasicProfileInfo($uid);
    list('user'=>$user,
    'profile'=>$profile,
    'package'=>$package,
    'package_max_members'=>$package_max_members,
    'canAddMoreMembers'=>$canAddMoreMembers
    ) = $userData;

    $package_price = $package->field_price->value;

    //get profile creation date
    $startTime =  $profile->getCreatedTime();

    $now = new \DateTime();
    $date2 = new \DateTime();
    $date2->setTimestamp($startTime);


    $diff = date_diff($date2, $now);
    $days = $diff->format('%a');
    $left = 365 - $days;
    if($left > 0)
    {
      $priceRemaining = $package_price*$left/365;
    }else
    {
      $priceRemaining = 0;
    }

    $form['daysRemaining'] = [
      '#type' => 'textfield',
      '#value' => $left,
      '#title' => 'Days Remaining'
    ];
    $form['priceRemaining'] = [
      '#type' => 'textfield',
      '#value' => $priceRemaining,
      '#title' => 'Price Remaining'
    ];

    $nids = \Drupal::entityQuery('node')->condition('type','package')->execute();
    $nodes =  \Drupal\node\Entity\Node::loadMultiple($nids);

    $form['packages'] = views_embed_view('front_page_packages', 'block_2');
    
    $options = [];
    $form['package'] = [
      '#type' => 'radios',
      '#options' => &$options
    ];
    foreach($nodes as $node)
    {
      if($node->id() == $package->id())
      {
        $form['package']['#option_attributes'][$node->id()]['disabled'] = 'true';
      }
      $options[$node->id()] = $node->getTitle() . "($" . $node->field_price->value . ") to pay $".($node->field_price->value - $priceRemaining);
    }




    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    foreach ($form_state->getValues() as $key => $value) {
      // @TODO: Validate fields.
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
      \Drupal::messenger()->addMessage($key . ': ' . ($key === 'text_format'?$value['value']:$value));
    }
  }

}
