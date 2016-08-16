<?php
namespace ZF2Components\View\Component;

use Zend\Hydrator\HydratorInterface;
use ZF2Components\View\InitializableInterface;
use ZF2Components\View\ViewHelperAwareView;
use Zend\View\Helper\Url;
use ZF2Components\View\Component\Grid\Column\Standard as StandardColumn;
use Zend\ServiceManager\ServiceLocatorInterface;
use ParamsHelper\View\Helper\ParamsHelper;

class Grid extends ViewHelperAwareView implements InitializableInterface
{
	const SIZE_LARGE = 'btn btn-lg';
	const SIZE_NORMAL = 'size-normal';
	const SIZE_SMALL = 'btn btn-xs';
	const SIZE_EXTRA_SMALL = 'btn btn-sm';

	const AJAX_IDENTIFIER = 'is-ajax';
	const AJAX_POST_KEY = 'grid-data';

	protected $template = 'component/grid/page_load';

	protected $ajaxTemplate = 'component/grid/ajax';

	protected $size;

	protected $additionalClasses;

	protected $id;

	protected $columns = [];

	protected $columnPrototype;

	protected $serviceLocator;

	protected $collectionServiceAlias;

	protected $collectionService;

	protected $where;

	protected $pageLimit;

	protected $currentPage;

	protected $order;

	protected $collectionResult;

	protected $collectionResultCount;

	protected $ajaxUrl;

	/** @var HydratorInterface */
	protected $rowHydrator;

	protected $rowHydratorServiceAlias;

	protected $onClickKey;

	protected $currentRow;

	protected $isFilteringDisabled = false;

	public function __construct(
		ServiceLocatorInterface $serviceLocatorInterface,
		StandardColumn $standardColumn
	){
		$this->setSizeNormal();
		$this->setAdditionClasses('grid-container');
		$this->columnPrototype = $standardColumn;
		$this->serviceLocator = $serviceLocatorInterface;
	}

	public function init()
	{
		$this->setVariable('grid', $this);

		//set a default ajax url if none set
		if(!$this->getAjaxUrl()){
			/** @var Url $urlHelper */
			$urlHelper = $this->getViewHelperManager()->get('url');
			$this->setAjaxUrl($urlHelper('zf2-component-grid'));
		}

		/** @var ParamsHelper $paramsHelper */
		$paramsHelper = $this->getViewHelperManager()->get('params');

		if($this->terminate()){
			$this->import($paramsHelper->fromPost(self::AJAX_POST_KEY));
			$this->template = $this->ajaxTemplate;
		}
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
		}else{
			return '';
		}
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

	/**
	 * @return string
	 */
	protected function getClass()
	{
		$class = 'class="';
		$class .= trim(sprintf('%s %s', $this->size, $this->additionalClasses));
		$class .= '"';
		return $class;
	}

	/**
	 * @return string
	 */
	public function getAttributeString()
	{
		return trim(sprintf('%s %s',
			$this->getId(),
			$this->getClass()
		));
	}

	/**
	 * @param $collectionServiceAlias string
	 * @return $this
	 */
	public function setCollectionServiceAlias($collectionServiceAlias)
	{
		$this->collectionServiceAlias = $collectionServiceAlias;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCollectionServiceAlias()
	{
		return $this->collectionServiceAlias;
	}

	/**
	 * @return array|object
	 */
	public function getCollection()
	{
		if(!$this->collectionService){
			$this->collectionService = $this->serviceLocator->get($this->collectionServiceAlias);
		}
		return $this->collectionService;
	}

	/**
	 * @return int
	 */
	public function getCurrentPage()
	{
		if($this->currentPage == null){
			$this->currentPage = 1;
		}
		return $this->currentPage;
	}

	/**
	 * @param $currentPage int
	 * @return $this
	 */
	public function setCurrentPage($currentPage)
	{
		$this->currentPage = (int)$currentPage;
		return $this;
	}

	/**
	 * @param $pageLimit int
	 * @return $this
	 */
	public function setPageLimit($pageLimit)
	{
		$this->pageLimit = (int)$pageLimit;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getPageLimit()
	{
		return (int)$this->pageLimit;
	}

	/**
	 * @param $where mixed
	 * @return $this
	 */
	public function setWhere($where)
	{
		$this->where = $where;
		return $this;
	}

	/**
	 * @param $where mixed
	 * @return $this
	 */
	public function addToWhere($where)
	{
		if(!$this->where){
			$this->where = [];
		}
		$this->where[] = $where;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getWhere()
	{
		return $this->where;
	}

	/**
	 * @return int
	 */
	public function getCollectionResultCount()
	{
		if(!$this->collectionResultCount){
			$this->collectionResultCount = $this->getCollection()->getCount($this->getWhere());
		}
		return $this->collectionResultCount;
	}

	/**
	 * @return float
	 */
	public function getTotalNumberOfPages()
	{
		if($this->getPageLimit() == 0){
			return 1;
		}
		return ceil($this->getCollectionResultCount() / $this->getPageLimit());
	}

	/**
	 * @return mixed
	 */
	public function getCollectionResults()
	{
		if(!$this->collectionResult){
			$this->collectionResult = $this->getCollection()->getAll(
				$this->getWhere(),
				$this->getOrder(),
				$this->getPageLimit(),
				$this->getCurrentPage()
			);
		}
		return $this->collectionResult;
	}

	/**
	 * @return $this
	 */
	public function clearResultData()
	{
		$this->collectionResult = null;
		$this->collectionResultCount = null;
		return $this;
	}

	/**
	 * @return []StandardColumn
	 */
	public function getColumns()
	{
		return $this->columns;
	}

	/**
	 * @param $id
	 * @return StandardColumn
	 */
	public function addColumn($id)
	{
		$newColumn = clone $this->columnPrototype;
		$newColumn->setGrid($this);
		$this->columns[$id] = $newColumn;
		return $newColumn;
	}

	/**
	 * @param $id
	 * @return StandardColumn
	 */
	public function getColumn($id)
	{
		if(!isset($this->columns[$id])){
			return null;
		}
		return $this->columns[$id];
	}

	/**
	 * @param $order string
	 * @return $this
	 */
	public function setOrder($order)
	{
		$this->order = $order;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getOrder()
	{
		return $this->order;
	}

	/**
	 * @param $url string
	 * @return $this
	 */
	public function setAjaxUrl($url)
	{
		$this->ajaxUrl = $url;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getAjaxUrl()
	{
		return $this->ajaxUrl;
	}

	/**
	 * @return string
	 */
	public function export()
	{
		$columns = array();
		foreach($this->getColumns() as $id => $column){
			$columns[$id] = $column->export();
		}
		return json_encode(array(
			'order' => $this->getOrder(),
			'where' => $this->getWhere(),
			'page_limit' => $this->getPageLimit(),
			'current_page' => $this->getCurrentPage(),
			'columns' => $columns,
			'collection_service_alias' => urlencode($this->getCollectionServiceAlias()),
			'row_hydrator_service_alias' => urlencode($this->rowHydratorServiceAlias),
			'on_click_url_key' => $this->onClickKey,
			'filtering_disabled' => $this->isFilteringDisabled(),
		));
	}

	/**
	 * @param $data []
	 * @return $this
	 */
	public function import($data)
	{
		$data = json_decode($data, true);
		$this->setWhere($data['where'])
			->setOrder($data['order'])
			->setPageLimit($data['page_limit'])
			->setCurrentPage($data['current_page'])
			->setCollectionServiceAlias(urldecode($data['collection_service_alias']))
			->setRowHydratorServiceAlias(urldecode($data['row_hydrator_service_alias']))
			->setRowOnClick($data['on_click_url_key']);

		$this->isFilteringDisabled = $data['filtering_disabled'];

		foreach($data['columns'] as $id => $columnData){
			$column = $this->addColumn($id);
			$column->import($columnData);
		}
		return $this;
	}

	/**
	 * @param string $rowHydratorServiceAlias
	 * @return $this
	 */
	public function setRowHydratorServiceAlias($rowHydratorServiceAlias)
	{
		$this->rowHydratorServiceAlias = $rowHydratorServiceAlias;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function hasRowHydrator()
	{
		return ($this->rowHydratorServiceAlias != null);
	}

	/**
	 * @return HydratorInterface
	 */
	public function getRowHydrator()
	{
		if(!$this->rowHydrator && $this->hasRowHydrator()){
			$this->rowHydrator = $this->serviceLocator->get($this->rowHydratorServiceAlias);
		}
		return $this->rowHydrator;
	}

	public function setRowOnClick($dataKey)
	{
		$this->onClickKey = $dataKey;
		return $this;
	}

	public function setCurrentRow($row)
	{
		//TODO maybe look at just allowing arrays straight through?
		if(!$this->hasRowHydrator()){
			throw new \Exception('No row hydrator set, unable to extract data from row object');
		}
		$this->currentRow = $this->getRowHydrator()->extract($row);
		return $this;
	}

	public function getCurrentRow()
	{
		return $this->currentRow;
	}

	public function getRowOnClickUrl()
	{
		//die(json_encode($this->currentRow));
		if(!isset($this->currentRow[$this->onClickKey])){
			echo json_encode($this->onClickKey);
			return null;
		}
		/** @var Url $urlHelper */
		$urlHelper = $this->getViewHelperManager()->get('url');

		list($route, $params) = $this->currentRow[$this->onClickKey];
		return $urlHelper($route, $params);
	}

	public function disableFiltering()
	{
		$this->isFilteringDisabled = true;
		return $this;
	}

	public function enableFiltering()
	{
		$this->isFilteringDisabled = false;
		return $this;
	}

	public function isFilteringDisabled()
	{
		return $this->isFilteringDisabled;
	}
}