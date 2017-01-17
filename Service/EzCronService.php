<?php

namespace Smile\EzUICronBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Registry;
use eZ\Publish\Core\Base\Exceptions\InvalidArgumentException;
use eZ\Publish\Core\Base\Exceptions\NotFoundException;
use Smile\CronBundle\Cron\CronHandler;
use Smile\CronBundle\Cron\CronInterface;
use Smile\CronBundle\Entity\SmileCron;
use Smile\CronBundle\Service\CronService;
use Smile\EzUICronBundle\Entity\SmileEzCron;
use Smile\EzUICronBundle\Repository\SmileEzCronRepository;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Translation\TranslatorInterface;

class EzCronService
{
    /** @var CronService $cronService cron service */
    protected $cronService;

    /** @var CronHandler $cronHandler */
    protected $cronHandler;

    /** @var SmileEzCronRepository $repository */
    protected $repository;

    /** @var TranslatorInterface $translator */
    protected $translator;

    public function __construct(
        CronService $cronService,
        CronHandler $cronHandler,
        Registry $doctrineRegistry,
        TranslatorInterface $translator
    ) {
        $this->cronService = $cronService;
        $this->cronHandler = $cronHandler;
        $entityManager = $doctrineRegistry->getManager();
        $this->repository = $entityManager->getRepository('SmileEzUICronBundle:SmileEzCron');
        $this->translator = $translator;
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

    public function updateCron($alias, $type, $value)
    {
        $cron = $this->repository->find($alias);

        if (!$cron) {
            $crons = $this->getCrons();
            if (!isset($crons[$alias]))
                throw new NotFoundException(
                    $this->translator->trans('cron alias not found', [], 'smileezcron'),
                    'smileezcron'
                );

            $cron = new SmileEzCron();
            $cron->setAlias($crons[$alias]['alias']);
            $cron->setExpression($crons[$alias]['expression']);
            $cron->setArguments($crons[$alias]['arguments']);
            $cron->setPriority($crons[$alias]['priority']);
            $cron->setEnabled($crons[$alias]['enabled']);
        }

        try {
            $this->repository->updateCron($cron, $type, $value);
        } catch(InvalidArgumentException $e) {
            throw new InvalidArgumentException(
                $type, $this->translator->trans('cron.invalid.type', ['%type%' => $type], 'smileezcron')
            );
        }
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
                'alias' => $ezCron->getAlias(),
                'expression' => $ezCron->getExpression(),
                'arguments' => $ezCron->getArguments(),
                'priority' => (int)$ezCron->getPriority(),
                'enabled' => (int)$ezCron->getEnabled() == 1
            );
        }

        foreach ($crons as $cron) {
            if (!isset($return[$cron->getAlias()])) {
                $return[$cron->getAlias()] = array(
                    'alias' => $cron->getAlias(),
                    'expression' => $cron->getExpression(),
                    'arguments' => $cron->getArguments(),
                    'priority' => (int)$cron->getPriority(),
                    'enabled' => true
                );
            }
        }

        return $return;
    }

    public function isQueued($alias)
    {
        return $this->cronService->isQueued($alias);
    }

    public function addQueued($alias)
    {
        $this->cronService->addQueued($alias);
    }

    public function runQueued(InputInterface $input, OutputInterface $output, Application $application)
    {
        /** @var SmileCron[] $smileCrons */
        $smileCrons = $this->cronService->listQueued();

        /** @var CronInterface[] $crons */
        $crons = $this->cronHandler->getCrons();

        /** @var array() $eZCrons */
        $eZCrons = $this->getCrons();

        $cronAlias = array();

        foreach ($crons as $cron) {
            if (isset($eZCrons[$cron->getAlias()])) {
                $cronAlias[$cron->getAlias()] = array(
                    'cron' => $cron,
                    'arguments' => $eZCrons[$cron->getAlias()]['arguments'],
                    'priority' => $eZCrons[$cron->getAlias()]['priority']
                );
            }
        }

        $cronsToRun = array();

        if ($smileCrons) {
            foreach ($smileCrons as $smileCron) {
                if (isset($cronAlias[$smileCron->getAlias()])) {
                    $priority = $cronAlias[$smileCron->getAlias()]['priority'];
                    if (!isset($cronsToRun[$priority]))
                        $cronsToRun[$priority] = array();
                    $cronsToRun[$priority][] = $smileCron;
                }
            }
        }

        ksort($cronsToRun);

        foreach ($cronsToRun as $priority => $crons) {
            foreach ($crons as $smileCron) {
                $this->cronService->run($smileCron);
                /** @var CronInterface $cron */
                $cron = $cronAlias[$smileCron->getAlias()]['cron'];
                $cron->addArguments($cronAlias[$smileCron->getAlias()]['arguments']);
                $cron->initApplication($application);
                $status = $cron->run($input, $output);
                $this->cronService->end($smileCron, $status);
            }
        }
    }
}
