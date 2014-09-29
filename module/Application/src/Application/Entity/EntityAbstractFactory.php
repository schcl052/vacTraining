<?php

/**
 * Description of EntityAbstractFactory
 *
 * @author claude
 */

namespace Application\Entity;

use \Zend\ServiceManager\AbstractFactoryInterface;

/**
 * EntityAbstractFactory
 * @package Application\Entity
 */
class EntityAbstractFactory implements AbstractFactoryInterface
{
    /**
     * 
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @param type $name
     * @param type $requestedName
     * @return Boolean
     */
    public function canCreateServiceWithName(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
        //test if the name starts with the given string
        return substr($requestedName, 0, strlen('application.entity.')) == 'application.entity.';
    }

    /**
     * 
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @param type $name
     * @param type $requestedName
     * @return \Application\Entity\class
     */
    public function createServiceWithName(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
        //get the last part of the name
        $explodedName = explode('.', $requestedName);
        $className = ucfirst(array_pop($explodedName));
        //create the full class name with namespace
        $class= 'Application\\Entity\\'.$className;
        return new $class();
    }

}

?>
