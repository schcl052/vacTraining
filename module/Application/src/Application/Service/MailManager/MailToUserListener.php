<?php

namespace Application\Service\MailManager;

use \Zend\EventManager\ListenerAggregateInterface;
use \Zend\EventManager\ListenerAggregateTrait;
use \Zend\EventManager\Event;
use \Zend\EventManager\EventManagerInterface;
use \Application\Service\UserManager\UserManager;

/**
 * MailToUserListener
 * @package Application\Service\MailManager
 */
class MailToUserListener implements ListenerAggregateInterface
{
    
    use ListenerAggregateTrait;
    
    /**
     * 
     * @param \Zend\EventManager\EventManagerInterface $events
     */
    public function attach(EventManagerInterface $events) {
        
        $this->listeners[] = $events->attach(UserManager::ADD_USER, [$this, 'onAddUser']);
    }

    /**
     * 
     * @param \Zend\EventManager\EventManagerInterface $events
     */
    public function detach(EventManagerInterface $events) {
        foreach($this->listeners as $listener) {
            $events->detach($listener);
        }
    }
    
    /**
     * 
     * @param \Zend\EventManager\Event $e
     */
    public function onAddUser(Event $e){
        echo "Mail sent to: ".$e->getParam('firstName')." ".$e->getParam('lastName')."<br>";
    }

}
