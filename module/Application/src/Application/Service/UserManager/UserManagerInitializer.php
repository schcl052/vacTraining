<?php

namespace Application\Service\UserManager;

use Zend\ServiceManager\InitializerInterface;

/**
 * UserManagerInitializer
 * @package Application\Service\UserManager
 */
class UserManagerInitializer implements InitializerInterface
{
    /**
     * 
     * @param type $instance
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     */
    public function initialize($instance, \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        if(method_exists($instance, 'setUserManager')) {
            $instance->setUserManager($serviceLocator->get('application.service.user-manager'));
        }
    }

}