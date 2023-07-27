<?php
namespace ZF2Components\Factory\View\Helper;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\Mvc\Router\Http\RouteMatch;
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
		if(get_class($serviceLocator) instanceof \Laminas\ServiceManager\ServiceManager){
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