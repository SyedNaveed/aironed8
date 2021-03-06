<?php
namespace Drupal\airchoice_member;

class AirchoiceMember
{
    
    /**
    * Get profile info by uid
    * @param uid User id 
    * @return
    */
    public static function getBasicProfileInfo($uid)
    {
        static $userInfo = [];
        if(!isset($userInfo[$uid]))
        {
            $user = \Drupal\user\Entity\User::load($uid);
            $profiles = $user->paid_member_profiles->referencedEntities();
            $profile = $profiles[0]??null;
            $packages = $profile->field_package->referencedEntities();
            $package = $packages[0]??null; 
            $package_max_members = $package->field_max_members->getValue()[0]['value'];
            $members  = $profile->field_mem->referencedEntities();
            $canAddMoreMembers = count($members) < $package_max_members-1;
            $userInfo[$uid] = compact(['user',
            'members',
            'profiles', 
            'profile', 
            'packages',
            'package',
            'package_max_members',
            'canAddMoreMembers']);
        }
        return $userInfo[$uid];
    }
    
    public static function getPaidProfiles($uid)
    {
        $user = \Drupal\user\Entity\User::load($uid);
        $profiles = $user->paid_member_profiles->referencedEntities();
    }   
    
    public static function checkMemberLimit($uid)
    {
        
    }
    
    public static function addMember($package, $uid)
    {
        
    }
    
    
}