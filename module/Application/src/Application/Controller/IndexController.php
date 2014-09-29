<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * @package Application\Controller
 */
class IndexController extends AbstractActionController
{
    /**
     * default index action
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction() {
        return new ViewModel();
    }
    
    /**
     * Get the services config and send them to the view
     * @return \Zend\View\Model\ViewModel
     */
    public function servicesAction() {
        $configScalar = $this->getServiceLocator()->get('config.scalar');
        $configArray = $this->getServiceLocator()->get('config.array');
        
        $user1 = $this->getServiceLocator()->get('application.entity.user');
        $user2 = $this->getServiceLocator()->get('application.entity.user');
        $user1->setProfile($this->getServiceLocator()->get('application.entity.profile'));
        $user2->setProfile($this->getServiceLocator()->get('application.entity.profile'));

        $userManager = $this->getServiceLocator()->get('application.service.user-manager');
        $mailManager = $this->getServiceLocator()->get('application.service.mail-manager');
        
        $profile1 = $this->getServiceLocator()->get('application.entity.profile');
        $profile2 = $this->getServiceLocator()->get('application.entity.profile');

        $userManager->addUser("Claude","Schmitz");
        return new ViewModel(
            [
                'configScalar' => $configScalar,
                'configArray' => $configArray,
                'user1' => $user1,
                'user2' => $user2,
                'userManager' => $userManager,
                'mailManager' => $mailManager,
                'profile1' => $profile1,
                'profile2' => $profile2,
            ]
        );
    }
    
    public function buzzerAction(){
        $this->buzzer()->setLevel(10)
                               ->setSound('glock');        
        return new ViewModel($this->buzzer()->buzz());
                 
    }
}
