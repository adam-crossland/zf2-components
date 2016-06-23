<?php
namespace ZF2Components\View\Component\Grid\ColumnHeader;

use ZF2Components\View\Component\Grid\AbstractColumn;
use ZF2Components\View\InitializableInterface;
use ZF2Components\View\ViewHelperAwareView;

class Standard extends ViewHelperAwareView implements InitializableInterface
{
	protected $template = 'component/grid/column_header/standard';

	protected $label;

	protected $column;

	public function __construct()
	{

	}

	public function init()
	{
		$this->setVariable('header', $this);
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
	 * @return $this
	 */
	public function getLabel()
	{
		return $this->label;
	}

	/**
	 * @param  $column
	 * @return $this
	 */
	public function setColumn($column)
	{
		$this->column = $column;
		return $this;
	}

	/**
	 * @return null|
	 */
	public function getColumn()
	{
		return $this->column;
	}

	public function export()
	{
		return array(
			'label' => $this->getLabel(),
		);
	}

	public function import($data)
	{
		$this->setLabel($data['label']);
	}
}