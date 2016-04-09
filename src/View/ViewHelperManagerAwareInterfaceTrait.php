<?php
namespace ZF2Components\View;

use Zend\View\HelperPluginManager;

trait ViewHelperManagerAwareInterfaceTrait
{
    /** @var  HelperPluginManager */
    protected $viewHelperManager;

    /**
     * @param HelperPluginManager $viewHelperManager
     * @return ViewHelperManagerAwareInterface
     */
    public function setViewHelperManager($viewHelperManager)
    {
        $this->viewHelperManager = $viewHelperManager;
        return $this;
    }

    /**
     * @return HelperPluginManager
     */
    public function getViewHelperManager()
    {
        return $this->viewHelperManager;
    }
}