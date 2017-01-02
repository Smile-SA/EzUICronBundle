<?php

namespace Smile\EzUICronBundle\Controller;

use EzSystems\PlatformUIBundle\Controller\Controller;

class CronsController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
}
