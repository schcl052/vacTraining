<?php
/**
 * Description of User
 *
 * @author claude
 */
namespace Application\Entity;

use \Zend\EventManager\EventManagerAwareInterface;
use \Zend\EventManager\EventManagerAwareTrait;

/**
 * class for users
 * @package Application\Entity
 */
class User implements EventManagerAwareInterface
{
    
    use EventManagerAwareTrait;
    
    const NEW_PROFILE = 'new-profile';
    
    protected $profile;
    
    /**
     * 
     * @return Application\Entity\Profile
     */
    public function getProfile() {
        return $this->profile;
    }

    /**
     * 
     * @param Application\Entity\Profile $profile
     */
    public function setProfile($profile) {
        $profile->setAddress("1 rue de Test");
        $this->profile = $profile;
        
        $this->getEventManager()->trigger(self::NEW_PROFILE, $this,
                [
                    'profile' => $this->getProfile(),
                ]);
    }


}