<?php
namespace ZF2Components\Factory\View\Component;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use \ParamsHelper\View\Helper\ParamsHelper;
use ZF2Components\View\Component\Grid;

class GridFactory implements FactoryInterface
{
	/**
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return ParamsHelper
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$column = $serviceLocator->get('ZF2Components\View\Component\Grid\Column\Standard');

		return new Grid(
			$serviceLocator,
			$column
		);
	}
}