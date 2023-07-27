<?php
namespace ZF2Components\Factory\View\Component;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
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