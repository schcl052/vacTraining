<?php

namespace Application\Controller;

use \Zend\Mvc\Controller\AbstractActionController;
use \Zend\View\Model\ViewModel;

class AuthenticationController extends AbstractActionController
{
    public function indexAction() {
        return [];
    }
    
    public function loginAction() {
        $column = 
        [
            ['type' => 'text', 'title' => 'id'       , 'valueKey' => 'id'],
            ['type' => 'text', 'title' => 'firstname', 'valueKey' => 'firstname'],
            ['type' => 'text', 'title' => 'lastname' , 'valueKey' => 'lastname'],
            ['type' => 'text', 'title' => 'age'      , 'valueKey' => 'age'],
           // ['type' => 'progressBar', 'title' => '-'      , 'valueKey' => 'age', 'color' => 'red'],
        ];
        
        $userData = 
        [
            ['id' => 1, 'firstname' => 'Claude', 'lastname' => 'Schmitz', 'age' => 24],
        ];
        //$tableColumnPluginManager = $this->getServiceLocator('TableColumnPluginManager');
        return new ViewModel(
        [
            'column' => $column,
            'userData' => $userData
        ]);
    }
}
