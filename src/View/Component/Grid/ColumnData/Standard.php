<?php
namespace ZF2Components\View\Component\Grid\ColumnData;

use ZF2Components\View\InitializableInterface;
use ZF2Components\View\ViewHelperAwareView;
use ZF2Components\View\Component\Grid\Column\Standard as Column;

class Standard extends ViewHelperAwareView implements InitializableInterface
{
	const RETRIEVAL_TYPE_METHOD = 'method';

	protected $template = 'component/grid/column_data/standard';

	protected $column;

	protected $dataKey;

	public function __construct()
	{

	}

	public function init()
	{
		$this->setVariable('column_data', $this);
	}

	/**
	 * @param $column
	 * @return $this
	 */
	public function setColumn($column)
	{
		$this->column = $column;
		return $this;
	}

	/**
	 * @return null|Column
	 */
	public function getColumn()
	{
		return $this->column;
	}

	public function setDataRetrievalKey($dataKey)
	{
		$this->dataKey = $dataKey;
		return $this;
	}

	public function getValue()
	{
		$currentRow = $this->getColumn()->getCurrentRow();
		if(!isset($currentRow[$this->dataKey])){
			return null;
		}
		return $currentRow[$this->dataKey];
	}

	public function export()
	{
		return array(
			'data_retrieval_key' => $this->dataKey,
		);
	}

	public function import($data)
	{
		$this->dataKey = $data['data_retrieval_key'];
	}
}