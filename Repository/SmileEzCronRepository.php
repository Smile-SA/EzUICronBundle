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
}
