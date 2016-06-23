<?php
namespace ZF2Components\View\Component;

use ZF2Components\View\InitializableInterface;
use ZF2Components\View\ViewHelperAwareView;

class Button extends ViewHelperAwareView implements InitializableInterface
{
	const TYPE_BACK = 'btn-default';
	const TYPE_SAVE = 'btn-primary';
	const TYPE_CREATE = 'btn-success';
	const TYPE_EDIT = 'btn-info';
	const TYPE_CONFIGURATION = 'btn-warning';
	const TYPE_DELETE = 'btn-danger';

	const SIZE_LARGE = 'btn btn-lg';
	const SIZE_NORMAL = 'btn';
	const SIZE_SMALL = 'btn btn-xs';
	const SIZE_EXTRA_SMALL = 'btn btn-sm';

	protected $template = 'component/button';

	protected $onClick;

	protected $type;

	protected $size;

	protected $label;

	protected $additionalClasses;

	protected $id;

	protected $isConfirm = false;

	protected $confirmText = 'Are you sure?';

	public function __construct()
	{
		$this->type = self::TYPE_BACK;
		$this->size = self::SIZE_NORMAL;
	}

	public function init()
	{
		$this->setVariable('button', $this);
	}

	/**
	 * @param $location
	 * @param bool $confirm
	 * @return $this
	 */
	public function setOnclickLocation($location, $confirm = false)
	{
		$this->onClick = 'window.location = \''.$location.'\';';
		$this->isConfirm = $confirm;
		return $this;
	}

	/**
	 * @param $id
	 * @param bool $confirm
	 * @param string $submitLocation
	 * @return $this
	 */
	public function setOnclickSubmitForm($id, $confirm = false, $submitLocation = '')
	{
		$this->onClick = '';
		if($submitLocation){
			$this->onClick = '$(\'#'.$id.'\').attr(\'action\', \''.$submitLocation.'\'); ';
		}
		$this->onClick .= '$(\'#'.$id.'\').submit();';
		$this->isConfirm = $confirm;
		return $this;
	}

	/**
	 * @param $function
	 * @return $this
	 */
	public function setOnclickFunction($function)
	{
		$this->onClick = $function;
		$this->isConfirm = false;
		return $this;
	}

	/**
	 * @param $confirmText
	 * @return $this
	 */
	public function setConfirmText($confirmText)
	{
		$this->confirmText = $confirmText;
		return $this;
	}

	/**
	 * @return string
	 */
	protected function getOnclick()
	{
		if(!$this->onClick){
			return '';
		}
		$onclick = 'onclick="';
		if($this->isConfirm){
			$onclick .= 'if(confirm(\''.$this->confirmText.'\')){'
				. $this->onClick
				. '}';
		}else{
			$onclick .= $this->onClick;
		}
		$onclick .= '"';
		return $onclick;
	}

	/**
	 * @param $label
	 * @return $this
	 */
	public function setLabel($label)
	{
		$this->label = $label;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLabel()
	{
		return $this->label;
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
	 * @return $this
	 */
	public function setTypeBack()
	{
		$this->type = self::TYPE_BACK;
		return $this;
	}

	/**
	 * @return $this
	 */
	public function setTypeSave()
	{
		$this->type = self::TYPE_SAVE;
		return $this;
	}

	/**
	 * @return $this
	 */
	public function setTypeCreate()
	{
		$this->type = self::TYPE_CREATE;
		return $this;
	}

	/**
	 * @return $this
	 */
	public function setTypeEdit()
	{
		$this->type = self::TYPE_EDIT;
		return $this;
	}

	/**
	 * @return $this
	 */
	public function setTypeConfiguration()
	{
		$this->type = self::TYPE_CONFIGURATION;
		return $this;
	}

	/**
	 * @return $this
	 */
	public function setTypeDelete()
	{
		$this->type = self::TYPE_DELETE;
		return $this;
	}

	/**
	 * @return $this
	 */
	public function setSizeLarge()
	{
		$this->size = self::SIZE_LARGE;
		return $this;
	}

	/**
	 * @return $this
	 */
	public function setSizeNormal()
	{
		$this->size = self::SIZE_NORMAL;
		return $this;
	}

	/**
	 * @return $this
	 */
	public function setSizeSmall()
	{
		$this->size = self::SIZE_SMALL;
		return $this;
	}

	/**
	 * @return $this
	 */
	public function setSizeExtraSmall()
	{
		$this->size = self::SIZE_EXTRA_SMALL;
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

	protected function getClass()
	{
		$class = 'class="';
		$class .= trim(sprintf('%s %s %s', $this->type, $this->size, $this->additionalClasses));
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