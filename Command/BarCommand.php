<?php

namespace Smile\EzUICronBundle\Command;

use Smile\CronBundle\Cron\CronAbstract;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BarCommand extends CronAbstract
{
    protected function configure()
    {
        $this
            ->setName('smile:cron:bar')
            ->setDescription('Smile cron bar');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('start bar');
        $output->writeln('end bar');
    }
}
