<?php

namespace Application\Service\UserManager;

/**
 * UserManagerAwareTrait
 * @package Application\Service\UserManager
 */
trait UserManagerAwareTrait
{
    /**
     *
     * @var UserManager 
     */
    protected $userManager; 
    
    /**
     * 
     * @return UserManager
     */
    public function getUserManager(){
        return $this->userManager;
    }
    
    /**
     * 
     * @param \Application\Service\UserManager\UserManager $userManager
     */
    public function setUserManager(UserManager $userManager) {
        $this->userManager = $userManager;
    }
}
