<?php

namespace Smile\EzUICronBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Smile\EzUICronBundle\Entity\SmileEzCron;

class SmileEzCronRepository extends EntityRepository
{
    /**
     * List ez cron entries
     *
     * @return SmileEzCron[]
     */
    public function listCrons()
    {
        $query = $this->createQueryBuilder('c')
            ->getQuery();

        /** @var SmileEzCron[] */
        return $query->getResult();
    }

    public function updateCron(SmileEzCron $cron, $type, $value)
    {
        switch ($type) {
            case 'expression':
                $cron->setExpression($value);
                break;
            case 'arguments':
                $cron->setArguments($value);
                break;
            case 'priority':
                $cron->setPriority((int)$value);
                break;
        }

        $this->getEntityManager()->persist($cron);
        $this->getEntityManager()->flush();
    }
}
