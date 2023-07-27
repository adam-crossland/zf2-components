<?php
namespace ZF2Components\Factory\Controller;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use ZF2Components\Controller\GridController;

class GridControllerFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return mixed
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$realServiceLocator = $serviceLocator->getServiceLocator();
		$componentHelper = $realServiceLocator->get('viewhelpermanager')->get('zf2components');
		return new GridController(
			$componentHelper
		);
	}
}