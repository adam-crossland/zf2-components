<?php
namespace ZF2Components\View;

use Zend\View\HelperPluginManager;

interface ViewHelperManagerAwareInterface
{
    /**
     * @param HelperPluginManager $helperPluginManager
     * @return ViewHelperManagerAwareInterface
     */
    public function setViewHelperManager($helperPluginManager);

    /**
     * @return HelperPluginManager
     */
    public function getViewHelperManager();
}