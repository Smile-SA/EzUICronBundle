<?php

namespace Smile\EzUICronBundle\Controller;

use EzSystems\PlatformUIBundle\Controller\Controller;

class StatusController extends Controller
{
    public function listAction()
    {
        $datas = $this->getCrons();

        return $this->render('SmileEzUICronBundle:cron:tab/status/list.html.twig', [
            'datas' => $datas
        ]);
    }

    protected function getCrons()
    {
        return array();
    }
}
