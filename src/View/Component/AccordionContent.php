<?php
namespace ZF2Components\View\Component;

use Zend\Form\FormInterface;
use ZF2Components\View\Component\AccordionContent\Content;
use ZF2Components\View\InitializableInterface;
use ZF2Components\View\ViewHelperAwareView;

class AccordionContent extends ViewHelperAwareView implements InitializableInterface
{
	protected $template = 'component/accordion_content';

	protected $id;

	protected $additionalClasses;

	protected $contentPrototype;

	protected $contents = [];

	protected $form;

	public function __construct(
		Content $content,
		FormInterface $formInterface
	){
		$this->contentPrototype = $content;
		$this->form = $formInterface;
	}

	public function init()
	{
		$this->setVariable('accordion_content', $this);

		$this->form->setName($this->id);
		$this->setVariable('form', $this->form);
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

	/**
	 * @return string
	 */
	protected function getClass()
	{
		$class = 'class="';
		$class .= trim(sprintf('%s', $this->additionalClasses));
		$class .= '"';
		return $class;
	}

	/**
	 * @return string
	 */
	public function getAttributeString()
	{
		return sprintf('%s %s',
			$this->getId(),
			$this->getClass()
		);
	}

	/**
	 * @param $contentId string
	 * @return Content
	 */
	public function addContent($contentId)
	{
		$newContent = clone $this->contentPrototype;
		$newContent->setId($contentId);
		$this->contents[$contentId] = $newContent;
		return $newContent;
	}

	/**
	 * @param $contentId string
	 * @return null|Content
	 */
	public function getContent($contentId)
	{
		if(!isset($this->contents[$contentId])){
			return null;
		}
		return $this->contents[$contentId];
	}

	public function getContents()
	{
		return $this->contents;
	}
}