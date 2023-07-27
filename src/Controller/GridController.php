<?php
namespace ZF2Components\Controller;

use Sites\Model\Authenticator;
use Laminas\Mvc\Controller\AbstractActionController;
use ZF2Components\View\Helper\ZF2ComponentsHelper;

class GridController extends AbstractActionController
{
	public $componentHelper;

	public function __construct(
		ZF2ComponentsHelper $componentsHelper
	){
		$this->componentHelper = $componentsHelper;
	}

	public function indexAction()
	{
		return $this->componentHelper->getGrid('sites_grid')->setTerminal(true);
	}
}

