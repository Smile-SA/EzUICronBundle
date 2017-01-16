<?php

namespace Smile\EzUICronBundle\Controller;

use eZ\Publish\Core\MVC\Symfony\Security\Authorization\Attribute;
use EzSystems\PlatformUIBundle\Controller\Controller;

/**
 * Class CronController
 *
 * @package Smile\EzUICronBundle\Controller
 */
class CronController extends Controller
{
    /** @var string[] tab item names */
    protected $tabItems;

    /**
     * CronController constructor.
     *
     * @param string[] $tabItems tab item names
     */
    public function __construct($tabItems)
    {
        $this->tabItems = $tabItems;
    }

    /**
     * Perform access check for cron policy
     */
    public function performAccessChecks()
    {
        parent::performAccessChecks();
        $this->denyAccessUnlessGranted(new Attribute('uicron', 'cron'));
    }

    /**
     * Render tab item content
     *
     * @param string $tabItem tab item name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function cronAction($tabItem)
    {
        return $this->render('SmileEzUICronBundle:cron:index.html.twig', [
            'tab_items' => $this->tabItems,
            'tab_item_selected' => $tabItem,
            'params' => array(),
            'hasErrors' => false
        ]);
    }

    /**
     * @param string $tabItem
     * @param array $paramsTwig
     * @param bool  $hasErrors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tabAction($tabItem, $paramsTwig = array(), $hasErrors = false)
    {
        $tabItemMethod = 'tabItem' . ucfirst($tabItem);
        $params = $this->{$tabItemMethod}($paramsTwig);

        return $this->render('SmileEzUICronBundle:cron:tab/' . $tabItem . '.html.twig', [
            'tab_items' => $this->tabItems,
            'tab_item' => $tabItem,
            'params' => $params
        ]);
    }

    /**
     * @param $paramsTwig
     * @return array
     */
    protected function tabItemStatus($paramsTwig)
    {
        return array();
    }

    /**
     * @param $paramsTwig
     * @return array
     */
    protected function tabItemCrons($paramsTwig)
    {
        return array();
    }
}
