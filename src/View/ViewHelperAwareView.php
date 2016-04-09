<?php
namespace ZF2Components\View;

use Zend\View\Model\ViewModel;

class ViewHelperAwareView extends ViewModel implements ViewHelperManagerAwareInterface
{
	use ViewHelperManagerAwareInterfaceTrait;
}