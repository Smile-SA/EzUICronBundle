<?php

namespace Smile\EzUICronBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SmileEzCron
 *
 * @ORM\Entity(repositoryClass="Smile\EzUICronBundle\Repository\SmileEzCronRepository")
 * @ORM\Table(name="smile_ez_cron")
 */
class SmileEzCron
{
    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255, nullable=false)
     * @ORM\Id
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="expression", type="string", length=255, nullable=false)
     */
    private $expression;

    /**
     * @var string
     *
     * @ORM\Column(name="arguments", type="string", length=255, nullable=true)
     */
    private $arguments;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=false)
     */
    private $priority = 100;

    /**
     * @var integer
     *
     * @ORM\Column(name="enabled", type="integer", nullable=false)
     */
    private $enabled = 1;


    /**
     * Get alias
     *
     * @return string 
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set alias
     *
     * @param string $alias
     * @return string
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Set expression
     *
     * @param string $expression
     * @return SmileEzCron
     */
    public function setExpression($expression)
    {
        $this->expression = $expression;

        return $this;
    }

    /**
     * Get expression
     *
     * @return string 
     */
    public function getExpression()
    {
        return $this->expression;
    }

    /**
     * Set arguments
     *
     * @param string $arguments
     * @return SmileEzCron
     */
    public function setArguments($arguments)
    {
        $this->arguments = $arguments;

        return $this;
    }

    /**
     * Get arguments
     *
     * @return string 
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     * @return SmileEzCron
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set enabled
     *
     * @param integer $enabled
     * @return SmileEzCron
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return integer 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}
