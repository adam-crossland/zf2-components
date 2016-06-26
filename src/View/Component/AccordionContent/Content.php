<?php
namespace ZF2Components\View\Component\AccordionContent;

use ZF2Components\View\InitializableInterface;
use ZF2Components\View\ViewHelperAwareView;
use Zend\View\Helper\Url;

class Content extends ViewHelperAwareView implements InitializableInterface
{
	/** @var  string */
	protected $id;

	/** @var string */
	protected $tabLabel = 'Tab Label Not Set';

	/** @var string */
	protected $tabContentUrl;

	/** @var bool */
	protected $alwaysRefreshOnSelect = false;

	/** @var string */
	protected $contentHeading = 'No Content Heading Set';


	public function init()
	{

	}

	/**
	 * @param $id string
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
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param $tabLabel string
	 * @return $this
	 */
	public function setTabLabel($tabLabel)
	{
		$this->tabLabel = $tabLabel;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getTabLabel()
	{
		return $this->tabLabel;
	}

	/**
	 * @param $alwaysRefresh string
	 * @return $this
	 */
	public function setAlwaysRefreshTabContentOnSelect($alwaysRefresh)
	{
		$this->alwaysRefreshOnSelect = (bool)$alwaysRefresh;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isAlwaysRefreshTabContentOnSelect()
	{
		return $this->alwaysRefreshOnSelect;
	}

	/**
	 * @param $tabContentUrl string
	 * @return $this
	 */
	public function setTabContentUrl($tabContentUrl)
	{
		$this->tabContentUrl = $tabContentUrl;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getTabContentUrl()
	{
		return $this->tabContentUrl;
	}

	/**
	 * @param $contentHeading string
	 * @return $this
	 */
	public function setContentHeading($contentHeading)
	{
		$this->contentHeading = $contentHeading;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getContentHeading()
	{
		return $this->contentHeading;
	}
}