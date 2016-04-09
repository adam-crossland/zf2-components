<?php
namespace ZF2Components\Factory\Service\View\Renderer;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZF2Components\Service\View\Renderer\InitializablePhpRenderer;

class InitializablePhpRendererFactory implements FactoryInterface
{
	/**
	 * @param  ContainerInterface $container
	 * @param  string $name
	 * @param  null|array $options
	 * @return InitializablePhpRenderer
	 */
	public function __invoke(ContainerInterface $container, $name, array $options = null)
	{
		$renderer = new InitializablePhpRenderer();
		$renderer->setHelperPluginManager($container->get('ViewHelperManager'));
		$renderer->setResolver($container->get('ViewResolver'));

		return $renderer;
	}

	/**
	 * Create and return PhpRenderer instance
	 *
	 * For use with zend-servicemanager v2; proxies to __invoke().
	 *
	 * @param ServiceLocatorInterface $container
	 * @return InitializablePhpRenderer
	 */
	public function createService(ServiceLocatorInterface $container)
	{
		return $this($container, InitializablePhpRenderer::class);
	}
}
