<?php
namespace ZF2Components\Service\View\Renderer;

use Zend\View\Renderer\PhpRenderer;
use ZF2Components\View\InitializableInterface;

class InitializablePhpRenderer extends PhpRenderer
{
	/**
	 * @param InitializableInterface $nameOrModel
	 * @param null $values
	 * @return string
	 */
	public function render($nameOrModel, $values = null)
	{
		if(is_object($nameOrModel) && $nameOrModel instanceof InitializableInterface){
			$nameOrModel->init();
		}

		return parent::render($nameOrModel, $values);
	}
}