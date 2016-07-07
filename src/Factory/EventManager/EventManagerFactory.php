<?php
namespace ZF2Components\Factory\EventManager;

use Zend\EventManager\EventManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

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
        /** @var \Zend\EventManager\SharedEventManager $sharedEventManager */
        $sharedEventManager = $serviceLocator->get('sharedeventmanager');

        /** @var \Zend\EventManager\EventManager $eventManager */
        $eventManager = new EventManager('ZF2Components');
        $eventManager->setSharedManager($sharedEventManager);

        return $eventManager;
    }
}