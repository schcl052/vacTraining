<?php

namespace Application\View\Helper\Table;

use Application\View\Helper\Table\Column\AbstractColumn;
use Zend\ServiceManager\Exception;
use \Zend\ServiceManager\AbstractPluginManager;

class TableColumnsPluginManager extends AbstractPluginManager
{
    protected $shareByDefault = false;
    
    public function validatePlugin($plugin) {
        if(!$plugin instanceof AbstractColumn) {
            throw new Exception('This manager must only return AbstractColumns instances');
        }
    }

}