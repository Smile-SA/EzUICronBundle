<?php

namespace Smile\EzUICronBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SmileezCron
 *
 * @ORM\Table(name="smileez_cron")
 * @ORM\Entity
 */
class SmileezCron
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="minute", type="string", length=255, nullable=true)
     */
    private $minute = '*';

    /**
     * @var string
     *
     * @ORM\Column(name="hour", type="string", length=255, nullable=true)
     */
    private $hour = '*';

    /**
     * @var string
     *
     * @ORM\Column(name="day_of_month", type="string", length=255, nullable=true)
     */
    private $dayOfMonth = '*';

    /**
     * @var string
     *
     * @ORM\Column(name="month", type="string", length=255, nullable=true)
     */
    private $month = '*';

    /**
     * @var string
     *
     * @ORM\Column(name="day_of_week", type="string", length=255, nullable=true)
     */
    private $dayOfWeek = '*';

    /**
     * @var string
     *
     * @ORM\Column(name="command", type="string", length=255, nullable=false)
     */
    private $command;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set minute
     *
     * @param string $minute
     *
     * @return SmileezCron
     */
    public function setMinute($minute)
    {
        $this->minute = $minute;

        return $this;
    }

    /**
     * Get minute
     *
     * @return string
     */
    public function getMinute()
    {
        return $this->minute;
    }

    /**
     * Set hour
     *
     * @param string $hour
     *
     * @return SmileezCron
     */
    public function setHour($hour)
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * Get hour
     *
     * @return string
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * Set dayOfMonth
     *
     * @param string $dayOfMonth
     *
     * @return SmileezCron
     */
    public function setDayOfMonth($dayOfMonth)
    {
        $this->dayOfMonth = $dayOfMonth;

        return $this;
    }

    /**
     * Get dayOfMonth
     *
     * @return string
     */
    public function getDayOfMonth()
    {
        return $this->dayOfMonth;
    }

    /**
     * Set month
     *
     * @param string $month
     *
     * @return SmileezCron
     */
    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * Get month
     *
     * @return string
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Set dayOfWeek
     *
     * @param string $dayOfWeek
     *
     * @return SmileezCron
     */
    public function setDayOfWeek($dayOfWeek)
    {
        $this->dayOfWeek = $dayOfWeek;

        return $this;
    }

    /**
     * Get dayOfWeek
     *
     * @return string
     */
    public function getDayOfWeek()
    {
        return $this->dayOfWeek;
    }

    /**
     * Set command
     *
     * @param string $command
     *
     * @return SmileezCron
     */
    public function setCommand($command)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * Get command
     *
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }
}
