<?php
namespace ZF2Components\View\Component;

use ZF2Components\View\InitializableInterface;
use ZF2Components\View\ViewHelperAwareView;

class ButtonBar extends ViewHelperAwareView implements InitializableInterface
{
	const ALIGN_RIGHT = 'text-right';
	const ALIGN_LEFT = 'text-left';

	protected $template = 'component/button_bar';

	protected $alignment;

	protected $additionalClasses;

	protected $id;

	protected $buttons = [];

	public function __construct()
	{
		$this->setAlignRight();
	}

	public function init()
	{
		$this->setVariable('button_bar', $this);
	}

	/**
	 * @return $this
	 */
	public function setAlignRight()
	{
		$this->alignment = self::ALIGN_RIGHT;
		return $this;
	}

	/**
	 * @return $this
	 */
	public function setAlignLeft()
	{
		$this->alignment = self::ALIGN_LEFT;
		return $this;
	}

	/**
	 * @param $additionClasses
	 * @return $this
	 */
	public function setAdditionClasses($additionClasses)
	{
		$this->additionalClasses = $additionClasses;
		return $this;
	}

	/**
	 * @param $id
	 * @return $this
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	protected function getId()
	{
		if($this->id){
			return 'id="'.$this->id.'"';
		}else{
			return '';
		}
	}

	protected function getClass()
	{
		$class = 'class="';
		$class .= trim(sprintf('%s %s',$this->alignment, $this->additionalClasses));
		$class .= '"';
		return $class;
	}

	public function getAttributeString()
	{
		return trim(sprintf('%s %s',
			$this->getId(),
			$this->getClass()
		));
	}

	/**
	 * @param $button
	 * @return $this
	 * TODO this needs changing to accept any renderable object
	 * TODO this needs to have some sort of ordering property
	 */
	public function addButton($button)
	{
		$this->buttons[] = $button;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getButtons()
	{
		return $this->buttons;
	}
}