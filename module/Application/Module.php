<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use \Zend\EventManager\StaticEventManager;
use \Zend\ModuleManager\Feature\InitProviderInterface;
use \Zend\ModuleManager\ModuleManagerInterface;

class Module implements InitProviderInterface
{
    
    public function init(ModuleManagerInterface $manager) {
        $sm = $manager->getEvent()->getParam('ServiceManager');
        
        $serviceListener = $sm->get('ServiceListener');
        
        $serviceListener->addServiceManager(
            'TableColumnsPluginManager',
            'table_columns',
            'Application\View\Helper\Table\TableColumnsProviderInterface',
            'getTableColumnsConfig'
        );
    }

    /**
     * 
     * @param \Zend\Mvc\MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        $mailToUserListerner = new Service\MailManager\MailToUserListener();
        $mailToUserListerner->attach($e->getApplication()
                ->getServiceManager()
                ->get('application.service.user-manager')
                ->getEventManager());
        
        /**
         * Event Manager
         */
        /*
        $e->getApplication()
                ->getServiceManager()
                ->get('application.service.user-manager')
                ->getEventManager()
                ->attach(Service\UserManager\UserManager::ADD_USER, [$this, 'onAddUser']);
        */
        /**
         * Example of StaticEventManager
         */
        StaticEventManager::getInstance()
                ->attach('Application\Entity\User', Entity\User::NEW_PROFILE, [$this, 'onNewProfile']);
    }
    
    /**
     * 
     * @param \Zend\EventManager\Event $e
     */
    public function onAddUser(\Zend\EventManager\Event $e){
        echo "User added ";
        var_dump($e->getParams());
        echo "<br>";
    }
    
    /**
     * 
     * @param \Zend\EventManager\Event $e
     */
    public function onNewProfile(\Zend\EventManager\Event $e){
        echo "new Profile ";
        var_dump($e->getParam('profile'));
        echo "<br>";
    }

    /**
     * 
     * @return type
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * 
     * @return type
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
