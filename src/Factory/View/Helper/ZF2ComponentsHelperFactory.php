<?php
namespace ZF2Components\Factory\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Mvc\Router\Http\RouteMatch;
use \ParamsHelper\View\Helper\ParamsHelper;
use ZF2Components\View\Helper\ZF2ComponentsHelper;

class ZF2ComponentsHelperFactory implements FactoryInterface
{
	/**
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return ParamsHelper
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		if(get_class($serviceLocator) instanceof \Zend\ServiceManager\ServiceManager){
			$realServiceLocator = $serviceLocator;
		}else{
			$realServiceLocator = $serviceLocator->getServiceLocator();
		}

		$buttonBar = $realServiceLocator->get('ZF2Components\View\Component\ButtonBar');
		$button = $realServiceLocator->get('ZF2Components\View\Component\Button');
		$grid = $realServiceLocator->get('ZF2Components\View\Component\Grid');
		$accordionContent = $realServiceLocator->get('ZF2Components\View\Component\AccordionContent');

		return new ZF2ComponentsHelper(
			$buttonBar,
			$button,
			$grid,
			$accordionContent
		);
	}
}