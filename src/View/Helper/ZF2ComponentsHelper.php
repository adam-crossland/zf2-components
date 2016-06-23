<?php
namespace ZF2Components\View\Helper;
use Zend\View\Helper\AbstractHelper;
use ZF2Components\View\Component\Button;
use ZF2Components\View\Component\ButtonBar;
use ZF2Components\View\Component\Grid;

class ZF2ComponentsHelper extends AbstractHelper
{
	const COMPONENT_BUTTON = 'button';
	const COMPONENT_BUTTON_BAR = 'button_bar';
	const COMPONENT_GRID = 'grid';

	protected $componentCache = array();
	protected $prototypes = array();

	public function __construct(
		ButtonBar $buttonBar,
		Button $button,
		Grid $grid
	){
		$this->prototypes[self::COMPONENT_BUTTON] = $button;
		$this->componentCache[self::COMPONENT_BUTTON] = array();
		$this->prototypes[self::COMPONENT_BUTTON_BAR] = $buttonBar;
		$this->componentCache[self::COMPONENT_BUTTON_BAR] = array();
		$this->prototypes[self::COMPONENT_GRID] = $grid;
		$this->componentCache[self::COMPONENT_GRID] = array();
	}
	protected function has($component, $id)
	{
		return (isset($this->componentCache[$component][$id]));
	}
	protected function get($component, $id)
	{
		if(!$this->has($component, $id)){
			$this->componentCache[$component][$id] = clone $this->prototypes[$component];
		}
		return $this->componentCache[$component][$id];
	}
	/**
	 * @param $id
	 * @return bool
	 */
	public function hasButton($id)
	{
		return $this->has(self::COMPONENT_BUTTON, $id);
	}
	/**
	 * @param $id
	 * @return Button
	 */
	public function getButton($id)
	{
		return $this->get(self::COMPONENT_BUTTON, $id);
	}
	/**
	 * @param $id
	 * @return bool
	 */
	public function hasButtonBar($id)
	{
		return $this->has(self::COMPONENT_BUTTON_BAR, $id);
	}
	/**
	 * @param $id
	 * @return ButtonBar
	 */
	public function getButtonBar($id)
	{
		return $this->get(self::COMPONENT_BUTTON_BAR, $id);
	}

	/**
	 * @param $id
	 * @return bool
	 */
	public function hasGrid($id)
	{
		return $this->has(self::COMPONENT_GRID, $id);
	}

	/**
	 * @param $id
	 * @return Grid
	 */
	public function getGrid($id)
	{
		return $this->get(self::COMPONENT_GRID, $id);
	}
}