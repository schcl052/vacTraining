<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return 
[
    'router' => 
    [
        'routes' => 
        [
            'home' => 
            [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => 
                [
                    'route'    => '/',
                    'defaults' => 
                    [
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ],
                ],
            ],
            'login' =>
            [
                'type'    => 'Segment',
                    'options' => 
                    [
                        'route'    => '/login[/:id]',
                        'defaults' => 
                        [
                            'id'            => 0,
                            '__NAMESPACE__' => 'Application\Controller',
                            'controller'    => 'Authentication',
                            'action'        => 'login',
                        ],
                    ],
                    'may_terminate' => true,
            ],
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => 
            [
                'type'    => 'Literal',
                'options' => 
                [
                    'route'    => '/application',
                    'defaults' => 
                    [
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => 
                [
                    'default' => 
                    [
                        'type'    => 'Segment',
                        'options' => 
                        [
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => 
                            [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                            'defaults' => 
                            [
                            ],
                        ],
                    ],
                    
                ],
            ],
        ],
        
    ],
    'service_manager' =>    
    [
        'services' =>
        [
            'config.scalar' => 6,
            'config.array'  => 10,
        ],
        'invokables' => 
        [ 
            //application.entity.user' => 'Application\\Entity\\User',
            'application.service.mail-manager' => 'Application\\Service\\MailManager\\MailManager',
            //'text' => 'Application\\View\\Helper\\Table\\Column\\Text'

        ],
        'shared' =>
        [
            'application.entity.user' => false,
            'application.entity.profile' => false,
        ],
        'factories' =>
        [
            'TableColumnsPluginManager' => 'Application\\View\\Helper\\Table\\TableColumnsManagerFactory',
            'application.service.user-manager' => 'Application\\Service\\UserManager\UserManagerFactory',
            'application.entity.user' => function($sm)
                {
                    $user = new \Application\Entity\User();
                    $user->setProfile($sm->get('application.entity.profile'));
                    return $user;
                }
        ],
        'initializers' =>
        [
            'Application\\Service\\UserManager\\UserManagerInitializer',
        ],
        'abstract_factories' => 
        [
            'Application\View\Helper\Table\Column\AbstractColumnFactory',
            'Application\Entity\EntityAbstractFactory',
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ],
        'aliases' => 
        [
            'translator' => 'MvcTranslator',
        ],
    ],
    'translator' => 
    [
        'locale' => 'en_US',
        'translation_file_patterns' => 
        [
            [
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ],
        ],
    ],
    'controllers' => 
    [
        'invokables' => 
        [
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Authentication' => 'Application\Controller\AuthenticationController'
        ],
    ],
    'controller_plugins' =>
    [
        'invokables' =>
        [
            'buzzer' => 'Application\\Controller\\Plugin\\Buzzer',            
        ],
    ],
    'view_manager' => 
    [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => 
        [
            __DIR__ . '/../view',
        ],
    ],
    // Placeholder for console routes
    'console' => 
        [
        'router' => 
        [
            'routes' => 
            [
            ],
        ],
    ],
    'view_helpers' =>
    [        
        'invokables' =>
        [
            'table' => 'Application\\View\\Helper\\Table\\Table',
            'text'  => 'Application\\View\\Helper\\Table\\Column\\Text',
        ],
        /*'abstract_factories' =>
        [
            'Application\\View\\Helper\\Table\\Column\\AbstractColumnFactory',
        ]*/
    ],
];
