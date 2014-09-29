<?php

return
[
    'services' =>
    [
        'config.scalar' => 6,
        'config.array'  => 10,
    ],
    'invokables' => 
    [ 
        //application.entity.user' => 'Application\\Entity\\User',
        'application.service.mail-manager' => 'Application\\Service\\MailManager',
    ],
    'shared' =>
    [
        'application.entity.user'    => false,
        'application.entity.profile' => false,
    ],
    'factories' =>
    [
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
        'Application\Entity\EntityAbstractFactory',
        'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
        'Zend\Log\LoggerAbstractServiceFactory',
    ],
    'aliases' => 
    [
        'translator' => 'MvcTranslator',
    ]
];
