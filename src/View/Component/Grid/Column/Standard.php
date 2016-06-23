<?php
namespace ZF2Components\View\Component\Grid\Column;

use ZF2Components\View\InitializableInterface;
use ZF2Components\View\ViewHelperAwareView;
use Zend\View\Helper\Url;
use ZF2Components\View\Component\Grid\ColumnHeader\Standard as ColumnHeader;
use ZF2Components\View\Component\Grid\ColumnData\Standard as ColumnData;
use ZF2Components\View\Component\Grid;

class Standard extends ViewHelperAwareView implements InitializableInterface
{
	protected $template = 'component/grid/column';

	protected $width = 1;

	protected $additionalClasses;

	protected $header;

	protected $data;

	protected $grid;

	public function __construct(
		ColumnHeader $columnHeader,
		ColumnData $columnData
	){
		$this->header = $columnHeader;
		$this->header->setColumn($this);
		$this->data = $columnData;
		$this->data->setColumn($this);
	}

	public function __clone()
	{
		$this->header = clone $this->header;
		$this->header->setColumn($this);
		$this->data = clone $this->data;
		$this->data->setColumn($this);
	}

	public function init()
	{
	}

	public function getCurrentRow()
	{
		return $this->getGrid()->getCurrentRow();
	}

	public function setGrid($grid)
	{
		$this->grid = $grid;
		return $this;
	}

	/**
	 * @return Grid
	 */
	public function getGrid()
	{
		return $this->grid;
	}

	public function getHeader()
	{
		return $this->header;
	}

	public function getData()
	{
		return $this->data;
	}

	public function export()
	{
		return array(
			'header' => $this->getHeader()->export(),
			'data' => $this->getData()->export(),
		);
	}

	public function import($data)
	{
		$this->getHeader()->import($data['header']);
		$this->getData()->import($data['data']);
	}
}