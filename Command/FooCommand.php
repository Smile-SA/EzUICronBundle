<?php

namespace Smile\EzUICronBundle\Command;

use Smile\CronBundle\Cron\CronAbstract;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FooCommand extends CronAbstract
{
    protected function configure()
    {
        $this
            ->setName('smile:cron:foo')
            ->addArgument('foo', InputArgument::REQUIRED, 'foo argument')
            ->setDescription('Smile cron foo');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('start foo');
        $output->writeln('foo argument : ' . $this->getArgument($input, 'foo'));
        $output->writeln('end foo');
    }
}