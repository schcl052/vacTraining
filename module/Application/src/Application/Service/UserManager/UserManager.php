<?php
namespace Application\Service\UserManager;

use \Zend\EventManager\EventManagerAwareInterface;
use \Zend\EventManager\EventManagerAwareTrait;


/**
 * class that manages users
 * @package Application\Service
 */
class UserManager implements EventManagerAwareInterface
{
    use EventManagerAwareTrait;
     
    /**
     * @var String
     */
    const ADD_USER = "add-user";
    /**
     *
     * @var Application\Entity\User 
     */
    protected $user;
    
    /**
     * 
     * @return type
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * 
     * @param \Application\Entity\User $user
     */
    public function setUser(\Application\Entity\User $user) {
        $this->user = $user;
    }
    
    /**
     * 
     * @param type $firstName
     * @param type $lastName
     */
    public function addUser($firstName, $lastName){
        //persist data
         $this->getEventManager()->trigger(self::ADD_USER, $this, 
            [
                'firstName' => $firstName,
                'lastName'  => $lastName
            ]
         );
    }


}