<?php
namespace ZF2Components\Factory\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
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