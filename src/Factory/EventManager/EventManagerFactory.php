<?php
namespace ZF2Components\Factory\EventManager;

use Laminas\EventManager\EventManager;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class EventManagerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Laminas\EventManager\SharedEventManager $sharedEventManager */
        $sharedEventManager = $serviceLocator->get('sharedeventmanager');

        /** @var \Laminas\EventManager\EventManager $eventManager */
        $eventManager = new EventManager('ZF2Components');
        $eventManager->setSharedManager($sharedEventManager);

        return $eventManager;
    }
}