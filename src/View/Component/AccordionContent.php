<?php
namespace ZF2Components\View\Component;

use ZF2Components\View\InitializableInterface;
use ZF2Components\View\ViewHelperAwareView;

class AccordionContent extends ViewHelperAwareView implements InitializableInterface
{
	protected $id;

	protected $additionalClasses;

	public function __construct()
	{
	}

	public function init()
	{
		$this->setVariable('accordion_content', $this);
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

	/**
	 * @param $additionClasses
	 * @return $this
	 */
	public function setAdditionClasses($additionClasses)
	{
		$this->additionalClasses = $additionClasses;
		return $this;
	}

	protected function getClass()
	{
		$class = 'class="';
		$class .= trim(sprintf('%s', $this->additionalClasses));
		$class .= '"';
		return $class;
	}

	public function getAttributeString()
	{
		return sprintf('%s %s %s',
			$this->getId(),
			$this->getClass(),
			$this->getOnclick()
		);
	}
}