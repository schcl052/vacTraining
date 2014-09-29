<?php

namespace Application\View\Helper\Table\Column;

use \Zend\ServiceManager\AbstractFactoryInterface;

/**
 * Description of AbstractColumnFactory
 *
 * @author claude
 */
class AbstractColumnFactory  implements AbstractFactoryInterface
{
    public function canCreateServiceWithName(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
        return in_array($requestedName,
                    [
                        'text', 'number', 'progressbar'
                    ]
                );
    }

    public function createServiceWithName(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
        $className = '\\Application\\View\\Helper\Table\\Column\\'. ucfirst($requestedName);
        return new $className();
    }

}

?>
