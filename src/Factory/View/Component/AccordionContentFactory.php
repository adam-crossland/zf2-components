<?php
namespace ZF2Components\Factory\View\Component;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use \ParamsHelper\View\Helper\ParamsHelper;
use ZF2Components\View\Component\AccordionContent;

class AccordionContentFactory implements FactoryInterface
{
	/**
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return ParamsHelper
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$content = $serviceLocator->get('ZF2Components\View\Component\AccordionContent\Content');

		/** @var \Laminas\Form\FormElementManager\FormElementManagerV2Polyfill $formElementManager */
		$formElementManager = $serviceLocator->get('formelementmanager');
		$form = $formElementManager->get('ZF2Components\Form\AccordionContentForm');

		/** @var \Laminas\EventManager\SharedEventManager $sharedEventManager */
		$eventManager = $serviceLocator->get('ZF2Components\EventManager');

		return new AccordionContent(
			$content,
			$form,
			$eventManager
		);
	}
}