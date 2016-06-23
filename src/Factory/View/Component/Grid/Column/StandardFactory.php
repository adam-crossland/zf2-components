<?php
namespace ZF2Components\Factory\View\Component\Grid\Column;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use \ParamsHelper\View\Helper\ParamsHelper;
use ZF2Components\View\Component\Grid\Column\Standard;

class StandardFactory implements FactoryInterface
{
	/**
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return ParamsHelper
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$header = $serviceLocator->get('ZF2Components\View\Component\Grid\ColumnHeader\Standard');
		$data = $serviceLocator->get('ZF2Components\View\Component\Grid\ColumnData\Standard');

		return new Standard(
			$header,
			$data
		);
	}
}