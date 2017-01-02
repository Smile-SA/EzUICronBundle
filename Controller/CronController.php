<?php

namespace Smile\EzUICronBundle\Controller;

use EzSystems\PlatformUIBundle\Controller\Controller;

class CronController extends Controller
{
    protected $tabItems;

    public function __construct($tabItems)
    {
        $this->tabItems = $tabItems;
    }

    public function cronAction($tabItem)
    {
        return $this->render('SmileEzUICronBundle:cron:index.html.twig', [
            'tab_items' => $this->tabItems,
            'tab_item_selected' => $tabItem,
            'params' => array(),
            'hasErrors' => false
        ]);
    }

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

    protected function tabItemStatus($paramsTwig)
    {
        return array();
    }

    protected function tabItemCrons($paramsTwig)
    {
        return array();
    }
}
