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
            if($user->hasRole('paid_member'))
            {
                
                $profiles = $user->paid_member_profiles->referencedEntities();
                // $profiles[0]->delete();
                

                
                $profile = $profiles[0]??null;
                $packages = isset($profile->field_package)?$profile->field_package->referencedEntities():[];
                $package = $packages[0]??null; 
                if($package){
                    $package_max_members = $package->field_max_members->getValue()[0]['value'];
                }else{
                    $package_max_members = null;
                }
                $members  = $profile->field_mem->referencedEntities();
                $members_value  = $profile->field_mem->getValue();
                $canAddMoreMembers = count($members) < $package_max_members-1;
                $userInfo[$uid] = compact(['user',
                'members',
                'members_value',
                'profiles', 
                'profile', 
                'packages',
                'package',
                'package_max_members',
                'canAddMoreMembers']);
            }else{
                $userInfo[$uid] = [
                    'user' => $user
                ];
            }
            
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