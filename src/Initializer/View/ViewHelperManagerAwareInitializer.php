<?php
namespace ZF2Components\Initializer\View;

use ZF2Components\View\ViewHelperManagerAwareInterface;
use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ViewHelperManagerAwareInitializer implements InitializerInterface
{
    /**
     * Initialize
     *
     * @param $instance
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if($instance instanceof ViewHelperManagerAwareInterface){
            $instance->setViewHelperManager($serviceLocator->get('ViewHelperManager'));
        }
    }
}