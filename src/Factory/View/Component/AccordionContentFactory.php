<?php
namespace ZF2Components\Factory\View\Component;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
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

		/** @var \Zend\Form\FormElementManager\FormElementManagerV2Polyfill $formElementManager */
		$formElementManager = $serviceLocator->get('formelementmanager');
		$form = $formElementManager->get('ZF2Components\Form\AccordionContentForm');

		return new AccordionContent(
			$content,
			$form
		);
	}
}