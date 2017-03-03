<?php

namespace Smile\EzUICronBundle\Controller;

use eZ\Publish\Core\MVC\Symfony\Security\Authorization\Attribute as AuthorizationAttribute;
use eZ\Publish\Core\MVC\Symfony\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AbstractCronController extends Controller
{
    /**
     * Perform access check for cron policy
     */
    protected function performAccessChecks()
    {
        if (!$this->isGranted(new AuthorizationAttribute('uicron', 'cron'))) {
            throw new AccessDeniedException();
        }
    }
}
