<?php

namespace Smile\EzUICronBundle\Controller;

use EzSystems\PlatformUIBundle\Controller\Controller;
use Smile\EzUICronBundle\Service\EzCronService;

class CronsController extends Controller
{
    /** @var EzCronService $cronService cron service */
    protected $cronService;

    public function __construct(EzCronService $cronService)
    {
        $this->cronService = $cronService;
    }

    public function listAction()
    {
        $crons = $this->cronService->getCrons();

        return $this->render('SmileEzUICronBundle:cron:tab/crons/list.html.twig', [
            'datas' => $crons
        ]);
    }
}
