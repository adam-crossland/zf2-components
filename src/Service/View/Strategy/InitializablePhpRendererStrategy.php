<?php
namespace ZF2Components\Service\View\Strategy;

use Zend\EventManager\EventManagerInterface;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Strategy\PhpRendererStrategy;
use Zend\View\ViewEvent;
use ZF2Components\Service\View\Renderer\InitializablePhpRenderer;
use ZF2Components\View\InitializableInterface;

class InitializablePhpRendererStrategy extends PhpRendererStrategy
{
	/**
	 * Constructor
	 *
	 * @param  InitializablePhpRenderer $renderer
	 */
	public function __construct(InitializablePhpRenderer $renderer)
	{
		$this->renderer = $renderer;
	}

	/**
	 * {@inheritDoc}
	 */
	public function attach(EventManagerInterface $events, $priority = 10)
	{
		$this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, [$this, 'selectRenderer'], $priority);
		$this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, [$this, 'injectResponse'], $priority);
	}

	/**
	 * Select the PhpRenderer; typically, this will be registered last or at
	 * low priority.
	 *
	 * @param  ViewEvent $e
	 * @return PhpRenderer
	 */
	public function selectRenderer(ViewEvent $e)
	{
		$model = $e->getModel();
		if(!$model instanceof InitializableInterface){
			return;
		}
		return $this->renderer;
	}
}
