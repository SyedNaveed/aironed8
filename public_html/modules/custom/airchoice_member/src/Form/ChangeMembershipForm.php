<?php

namespace Drupal\airchoice_member\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\airchoice_member\AirchoiceMember;
use Stripe\Stripe;
use Stripe\Error\Base as StripeBaseException;
use Stripe\Charge;






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
    'canAddMoreMembers'=>$canAddMoreMembers,
    'members' => $members,
    'members_value' => $members_value,
    'profiles' => $profiles,
    ) = $userData;

    $form_state->set('members_value', $members_value);
    
    $package_price = $package->field_price->value;

    $currentMembersOptions = [];



    $form['members_added'] = [
      '#type' => 'hidden',
      '#title' => 'members added count (hidden)',
      '#value' => count($members),
      '#weight' => 100,
    ];
    foreach($members as $member)
    {
      $currentMembersOptions[$member->id()] = $member->getUsername();
    }

   
    $amount_remaining = $user->amount_remaining->value;

    if(!$amount_remaining)
    {
      $amount_remaining = 0;
    }
    

    $form['max_members'] = [
      '#type' => 'hidden',
      '#title' => "Max members (hidden)",
      '#value' => $package_max_members,
      '#weight' => 100
    ];

  

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

 
    $priceRemaining += $amount_remaining;
 
    
    $form['daysRemaining'] = [
      '#type' => 'hidden',
      '#value' => $left,
      '#title' => 'Days Remaining'
    ];
    $form['priceRemaining'] = [
      '#type' => 'hidden',
      '#value' => $priceRemaining,
      '#title' => 'Price Remaining'
    ];
    
    $form_state->set('priceRemaining', $priceRemaining);
    $form_state->set('left', $left);
    
    $nids = \Drupal::entityQuery('node')->condition('type','package')->execute();
    $nodes =  \Drupal\node\Entity\Node::loadMultiple($nids);
    
    $form['packages'] = views_embed_view('front_page_packages', 'block_2', $package->id());
    
    
    $packagesPrice = [];
    
    $options = [];
    $form['package'] = [
      '#type' => 'radios',
      '#required' => 'true',
      '#options' => &$options
    ];
    $allowed_members_list = [];
    foreach($nodes as $node)
    {

      if($node->id() == $package->id())
      {
        $form['package']['#option_attributes'][$node->id()]['disabled'] = 'true';
      }
      $allowed_members = $node->field_max_members->value - 1;
      $packagesPrice[$node->id()] = $node->field_price->value;
      $allowed_members_list[$node->id()] = $allowed_members;
      $options[$node->id()] = "<div data-max-members=\"$allowed_members\" class='confirm-membership-h2' ><h2>Confirm Membership Change</h2></div><div class='membershipinfo'><span>New Membership: </span><span>" . $node->getTitle() . "</span></div><div class='membershipinfo'><span>Due Today: </span><span>" . ($node->field_price->value - $priceRemaining) . " </span></div><div class='membershipinfo'><span>Membership Renews: </span><span> " . $left . " Days </span></div>";
      // $options[$node->id()] =   "<div ><h2>Confirm Membership Change</h2></div><div class='membershipinfo'><span>New Membership: </label>".$node->getTitle()."($" . round($node->field_price->value, 2) . ") to pay $".($node->field_price->value - $priceRemaining);
    }
    $form_state->set('allowed_members_list', $allowed_members_list);
    $form_state->set('packagesPrice', $packagesPrice);
    
    
    $form['stripe'] = [
      '#type' => 'stripe',
      '#title' => $this->t('Credit card'),
      // The selectors are gonna be looked within the enclosing form only.
      "#stripe_selectors" => [
        // 'first_name' => ':input[name="first"]',
        // 'last_name' => ':input[name="last"]',
      ],
      '#description' => $this->t('You can use test card numbers and tokens from @link.', [
        // '@link' => $link_generator->generate('stripe docs', Url::fromUri('https://stripe.com/docs/testing')),
        ]),
      ];


      $form['members_to_remove'] = [
        '#title' => $this->t("Users to remove after downgrade"),
        '#type' => 'checkboxes',
        '#options' => $currentMembersOptions,
        '#attributes' => [
          'class' => ['members-to-remove-checkbox'],
        ],
        '#description' => '<div id="members_to_remove_desc">Select @count Users.</h1>',
        '#prefix' => '<div class="hidden" id="members-to-remove">',
        '#suffix' => '</div>'
      ];
      
      
      
      $form['submit'] = [
        '#type' => 'submit',
        '#weight' => 1000,
        '#value' => $this->t('Submit'),
      ];
      
      return $form;
    }
    
    /**
    * {@inheritdoc}
    */
    public function validateForm(array &$form, FormStateInterface $form_state) {
      $allowed_members_list = $form_state->get('allowed_members_list');
      $member_to_remove = array_filter($form_state->getValue('members_to_remove'), function($e){
        return $e !== 0;
      });

      $member_to_remove_count = count($member_to_remove);
      $packageSelected = $form_state->getValue('package');
      $members_added = $form_state->getValue('members_added');
      
      if(!$packageSelected)
      {
        $form_state->setErrorByName('package', "Package selection is required.");
        parent::validateForm($form, $form_state);
        return;
      }
      
      
      $allowed_members = $allowed_members_list[$packageSelected];
      
      if($allowed_members>0 && $members_added-$member_to_remove_count > $allowed_members)
      {
        $form_state->setErrorByName("members_to_remove", "You must select ".($members_added-($allowed_members+$member_to_remove_count))." more to remove from package.");
      }
      
      parent::validateForm($form, $form_state);
    }
    
    /**
    * {@inheritdoc}
    */
    public function submitForm(array &$form, FormStateInterface $form_state) {
      $packagesPrice = $form_state->get('packagesPrice');
      $priceRemaining = $form_state->get('priceRemaining');
      $members_value = $form_state->get('members_value');
      $left = $form_state->get('left');
      
      $member_to_remove = array_filter($form_state->getValue('members_to_remove'), function($e){
        return $e !== 0;
      });

     

      $members_value = $form_state->get('members_value');
      $members_to_save = array_map(function($e){ return $e['target_id']; }, $members_value);
      
      $members_to_save = array_diff($members_to_save, $member_to_remove);
      $members_to_save = array_map(function($e){ return ['target_id'=>$e]; }, $members_to_save);
      
      $uid = \Drupal::currentUser()->id();
      $user = \Drupal\user\Entity\User::load($uid);
      
      $amount_remaining = $user->amount_remaining->value;
      if(!$amount_remaining)
      {
        $amount_remaining = 0;
      }
      
      $packageSelected = $form_state->getValue('package');
      $packagePrice = $packagesPrice[$packageSelected];
      
      $priceToPay = $packagePrice - $priceRemaining;
      
      if($priceToPay <= 0)
      {
        $amount_remaining = -$priceToPay;


        //block users selected to be removed
        $userToRemove = \Drupal\user\Entity\User::loadMultiple($member_to_remove);
        foreach($userToRemove as $userRemove)
        {
          $userRemove->block();
          $userRemove->save();
        }
        
        $user->membership_type->setValue($packageSelected);
        $user->amount_remaining->setValue($amount_remaining);
        $user->save();
        
        $profile = \Drupal\profile\Entity\Profile::create([
          'type' => 'paid_member',
          'uid' => $uid,
          'field_package' => $packageSelected 
        ]);

        $profile->field_mem->setValue($members_to_save);
          
          //add condition on downgrade
          $profile->setDefault(TRUE);
          $profile->save();

          return;
        }

        $amount_remaining = 0;
        
        $user->amount_remaining->setValue($amount_remaining);
        $user->membership_type->setValue($packageSelected);
        

        $user->save();
        
        
        if ($this->checkTestStripeApiKey()) {
          // Make test charge if we have test environment and api key.
          $stripe_token = $form_state->getValue('stripe');
          $charge = $this->createCharge($stripe_token, round($priceToPay));
          if ($charge) {
            $this->messenger()->addStatus('Charge status: ' . $charge->status);
            if ($charge->status == 'succeeded') {
              
              $profile = \Drupal\profile\Entity\Profile::create([
                'type' => 'paid_member',
                'uid' => $uid,
                'field_package' => $packageSelected
                ]);

                $profile->field_mem->setValue($members_to_save);
                //add condition on downgrade
                $profile->setDefault(TRUE);
                $profile->save();
                
                //create user here
                // $user->addRole('paid_member');
                // $user->save();
                $link_generator = \Drupal::service('link_generator');
                $this->messenger()->addStatus($this->t('Please check payments in @link.', [
                  '@link' => $link_generator->generate('stripe dashboard', \Drupal\core\Url::fromUri('https://dashboard.stripe.com/test/payments')),
                  ]));
                }
              }
            }
            
            
          }
          
          /**
          * Helper function for making sure stripe key is set for test and has the necessary keys.
          */
          private function checkTestStripeApiKey() {
            $status = FALSE;
            $config = \Drupal::config('stripe.settings');
            if ($config->get('environment') == 'test' && $config->get('apikey.test.secret')) {
              $status = TRUE;
            }
            return $status;
          }
          
          /**
          * Helper function for test charge.
          *
          * @param string $stripe_token
          *   Stripe API token.
          * @param int $amount
          *   Amount for charge.
          *
          * @return /Stripe/Charge
          *   Charge object.
          */
          private function createCharge($stripe_token, $amount) {
            try {
              $config = \Drupal::config('stripe.settings');
              Stripe::setApiKey($config->get('apikey.test.secret'));
              $charge = Charge::create([
                'amount' => $amount * 100,
                'currency' => 'usd',
                'description' => "Example charge",
                'source' => $stripe_token,
                ]);
                return $charge;
              }
              catch (StripeBaseException $e) {
                $this->messenger()->addError($this->t('Stripe error: %error', ['%error' => $e->getMessage()]));
              }
            }
            
            
            
          }
          