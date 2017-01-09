<?php

namespace Smile\EzUICronBundle\Controller;

use eZ\Publish\Core\MVC\Symfony\Security\Authorization\Attribute;
use EzSystems\PlatformUIBundle\Controller\Controller;
use Smile\EzUICronBundle\Service\EzCronService;
use Symfony\Component\HttpFoundation\Request;

class CronsController extends Controller
{
    /** @var EzCronService $cronService cron service */
    protected $cronService;

    public function __construct(EzCronService $cronService)
    {
        $this->cronService = $cronService;
    }

    public function performAccessChecks()
    {
        parent::performAccessChecks();
        $this->denyAccessUnlessGranted(new Attribute('uicron', 'cron'));
    }

    public function listAction()
    {
        $crons = $this->cronService->getCrons();

        return $this->render('SmileEzUICronBundle:cron:tab/crons/list.html.twig', [
            'datas' => $crons
        ]);
    }

    public function editAction(Request $request)
    {

    }
}
