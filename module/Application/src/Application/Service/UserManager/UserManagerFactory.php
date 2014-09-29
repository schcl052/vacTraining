<?php

namespace Application\Service\UserManager;
use Application\Service\UserManager\UserManager;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * factory class for the UserManager
 * @package Application\Service\UserManager
 */
class UserManagerFactory implements \Zend\ServiceManager\FactoryInterface
{
    /**
     * create a new service
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @return \Application\Service\UserManager\UserManager
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $user = $serviceLocator->get('application.entity.user');
        $userManager = new UserManager();
        $userManager->setUser($user);
        return $userManager;
    }

}
