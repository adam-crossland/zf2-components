<?php
namespace ZF2Components\View;

use Laminas\View\Model\ViewModel;

class ViewHelperAwareView extends ViewModel implements ViewHelperManagerAwareInterface
{
	use ViewHelperManagerAwareInterfaceTrait;
}