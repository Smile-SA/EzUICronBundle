<?php

namespace Smile\EzUICronBundle\Controller;

use EzSystems\PlatformUIBundle\Controller\Controller;

class CronsController extends Controller
{
    public function listAction()
    {
        $datas = array();

        return $this->render('SmileEzUICronBundle:cron:tab/crons/list.html.twig', [
            'datas' => $datas
        ]);
    }
}
