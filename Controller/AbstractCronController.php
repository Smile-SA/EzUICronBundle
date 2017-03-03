<?php

namespace Smile\EzUICronBundle\Controller;

use eZ\Publish\Core\MVC\Symfony\Security\Authorization\Attribute;
use EzSystems\PlatformUIBundle\Controller\Controller;

class AbstractCronController extends Controller
{
    /**
     * Perform access check for cron policy
     */
    public function performAccessChecks()
    {
        parent::performAccessChecks();
        $this->denyAccessUnlessGranted(new Attribute('uicron', 'cron'));
    }
}
