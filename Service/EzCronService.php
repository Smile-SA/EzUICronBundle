<?php

namespace Smile\EzUICronBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Smile\CronBundle\Cron\CronInterface;
use Smile\CronBundle\Entity\SmileCron;
use Smile\CronBundle\Service\CronService;
use Smile\EzUICronBundle\Entity\SmileEzCron;
use Smile\EzUICronBundle\Repository\SmileEzCronRepository;

class EzCronService
{
    /** @var CronService $cronService cron service */
    protected $cronService;

    /** @var SmileEzCronRepository $repository */
    protected $repository;

    public function __construct(CronService $cronService, Registry $doctrineRegistry)
    {
        $this->cronService = $cronService;
        $entityManager = $doctrineRegistry->getManager();
        $this->repository = $entityManager->getRepository('SmileEzUICronBundle:SmileEzCron');
    }

    /**
     * Return cron status entries
     *
     * @return SmileCron[] cron status entries
     */
    public function listCronsStatus()
    {
        return $this->cronService->listCronsStatus();
    }

    /**
     * Return cron list detail
     *
     * @return array cron list
     */
    public function getCrons()
    {
        /** @var CronInterface[] $crons */
        $crons = $this->cronService->getCrons();

        /** @var SmileEzCron[] $ezCrons */
        $ezCrons = $this->repository->listCrons();

        $return = array();

        foreach ($ezCrons as $ezCron) {
            $return[$ezCron->getAlias()] = array(
                'expression' => $ezCron->getExpression(),
                'arguments' => $ezCron->getArguments(),
                'priority' => (int)$ezCron->getPriority(),
                'enabled' => (int)$ezCron->getEnabled() == 1
            );
        }

        foreach ($crons as $cron) {
            if (!isset($return[$cron->getAlias()])) {
                $return[$cron->getAlias()] = array(
                    'expression' => $cron->getExpression(),
                    'arguments' => $cron->getArguments(),
                    'priority' => (int)$cron->getPriority(),
                    'enabled' => true
                );
            }
        }

        return $return;
    }
}
