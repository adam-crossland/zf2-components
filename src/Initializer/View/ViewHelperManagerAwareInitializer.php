<?php
namespace ZF2Components\Initializer\View;

use ZF2Components\View\ViewHelperManagerAwareInterface;
use Laminas\ServiceManager\Initializer\InitializerInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Interop\Container\ContainerInterface;

class ViewHelperManagerAwareInitializer implements InitializerInterface
{
    /**
     * Initialize the given instance
     *
     * @param  ContainerInterface $container
     * @param  object             $instance
     * @return void
     */
    public function __invoke(ContainerInterface $container, $instance)
    {
        if($instance instanceof ViewHelperManagerAwareInterface){
            $instance->setViewHelperManager($container->get('ViewHelperManager'));
        }
    }
}