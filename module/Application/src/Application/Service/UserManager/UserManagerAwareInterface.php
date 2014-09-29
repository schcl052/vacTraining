<?php

namespace Application\Service\UserManager;

/**
 * UserManagerAwareTrait
 * @package Application\Service\UserManager
 */
interface UserManagerAwareInterface
{
    /**
     * 
     * @param \Application\Service\UserManager\UserManager $userManager
     */
    public function setUserManager(UserManager $userManager);
    
    /**
     * @return UserManager
     */
    public function getUserManager();
    
}
