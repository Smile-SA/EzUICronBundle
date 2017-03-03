<?php

namespace Smile\EzUICronBundle\Controller;

use Smile\CronBundle\Entity\SmileCron;
use Smile\EzUICronBundle\Service\EzCronService;

/**
 * Class StatusController
 *
 * @package Smile\EzUICronBundle\Controller
 */
class StatusController extends AbstractCronController
{
    /** @var EzCronService $cronService cron service */
    protected $cronService;

    /**
     * StatusController constructor.
     *
     * @param EzCronService $cronService cron service
     */
    public function __construct(EzCronService $cronService)
    {
        $this->cronService = $cronService;
    }

    /**
     * List crons status
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        $crons = $this->cronService->listCronsStatus();
        $cronRows = array();

        foreach ($crons as $cron) {
            $cronRows[] = array(
                'alias' => $cron->getAlias(),
                'queued' => $cron instanceof SmileCron
                    ? ($cron->getQueued() ? $cron->getQueued()->format('d-m-Y H:i') : false)
                    : false,
                'started' => $cron instanceof SmileCron ? ($cron->getStarted()
                    ? $cron->getStarted()->format('d-m-Y H:i') : false)
                    : false,
                'ended' => $cron instanceof SmileCron ? ($cron->getEnded()
                    ? $cron->getEnded()->format('d-m-Y H:i') : false)
                    : false,
                'status' => $cron instanceof SmileCron ? $cron->getStatus() : false
            );
        }

        return $this->render('SmileEzUICronBundle:cron:tab/status/list.html.twig', [
            'datas' => $cronRows
        ]);
    }
}
