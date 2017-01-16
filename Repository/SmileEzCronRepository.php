<?php

namespace Smile\EzUICronBundle\Repository;

use Cron\CronExpression;
use Doctrine\ORM\EntityRepository;
use eZ\Publish\Core\Base\Exceptions\InvalidArgumentException;
use Smile\EzUICronBundle\Entity\SmileEzCron;

/**
 * Class SmileEzCronRepository
 *
 * @package Smile\EzUICronBundle\Repository
 */
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

    /**
     * Edit cron definition
     *
     * @param SmileEzCron $cron cron object
     * @param string      $type cron property identifier
     * @param string      $value cron property value
     * @throws InvalidArgumentException
     */
    public function updateCron(SmileEzCron $cron, $type, $value)
    {
        switch ($type) {
            case 'expression':
                if (!CronExpression::isValidExpression($value)) {
                    throw new InvalidArgumentException(
                        'expression', 'cron.invalid.type'
                    );
                }
                $cron->setExpression($value);
                break;
            case 'arguments':
                if (preg_match_all('|[a-z0-9_\-]+:[a-z0-9_\-]+|', $value) === 0) {
                    throw new InvalidArgumentException(
                        'arguments', 'cron.invalid.type'
                    );
                }
                $cron->setArguments($value);
                break;
            case 'priority':
                if (!ctype_digit($value)) {
                    throw new InvalidArgumentException(
                        'priority', 'cron.invalid.type'
                    );
                }
                $cron->setPriority((int)$value);
                break;
            case 'enabled':
                if (!ctype_digit($value) && ((int)$value != 1 || (int)$value != 0)) {
                    throw new InvalidArgumentException(
                        'enabled', 'cron.invalid.type'
                    );
                }
                $cron->setEnabled((int)$value);
                break;
        }

        $this->getEntityManager()->persist($cron);
        $this->getEntityManager()->flush();
    }
}
