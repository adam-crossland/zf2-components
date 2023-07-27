<?php
namespace ZF2Components\View\Component;

use Laminas\EventManager\EventManagerInterface;
use Laminas\Form\FormInterface;
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

	protected $eventManager;

	public function __construct(
		Content $content,
		FormInterface $formInterface,
		EventManagerInterface $eventManagerInterface
	){
		$this->contentPrototype = $content;
		$this->form = $formInterface;
		$this->eventManager = $eventManagerInterface;
	}

	public function init()
	{
		$this->setVariable('accordion_content', $this);

		$this->form->setName($this->getId(false).'-form');
		$this->setVariable('form', $this->form);

		$this->eventManager->trigger(
			'accordion_content.'.$this->getId(false).':init',
			$this,
			array()
		);
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
	 * @param bool $asAttributeString
	 * @return string
	 */
	public function getId($asAttributeString = true)
	{
		if($this->id){
			if($asAttributeString){
				return 'id="'.$this->id.'"';
			}
			return $this->id;
		}
		return '';
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