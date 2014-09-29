<?php

namespace Application\View\Helper\Table;

use \Zend\Mvc\Service\AbstractPluginManagerFactory;

class TableColumnsManagerFactory extends AbstractPluginManagerFactory
{
    const PLUGIN_MANAGER_CLASS = 'Application\View\Helper\Table\TableColumnsPluginManager';

}
