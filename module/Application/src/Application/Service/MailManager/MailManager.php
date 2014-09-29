<?php

namespace Application\Service\MailManager;

use Application\Service\UserManager\UserManagerAwareInterface;
use Application\Service\UserManager\UserManagerAwareTrait;
/**
 * class for mail management
 * @package Application\Service
 */
class MailManager implements UserManagerAwareInterface
{
    use UserManagerAwareTrait;
}