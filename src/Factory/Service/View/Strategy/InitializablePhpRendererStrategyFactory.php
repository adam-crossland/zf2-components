<?php
namespace ZF2Components\Factory\Service\View\Strategy;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZF2Components\Service\View\Renderer\InitializablePhpRenderer;
use ZF2Components\Service\View\Strategy\InitializablePhpRendererStrategy;

class InitializablePhpRendererStrategyFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $name, array $options = null)
	{
		return new InitializablePhpRendererStrategy($container->get(InitializablePhpRenderer::class));
	}

	public function createService(ServiceLocatorInterface $container)
	{
		return $this($container, InitializablePhpRendererStrategy::class);
	}
}
