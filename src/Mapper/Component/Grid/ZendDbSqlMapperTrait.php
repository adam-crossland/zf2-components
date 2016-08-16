<?php
namespace ZF2Components\Mapper\Component\Grid;

use Sites\Model\Site;
use Sites\Model\SiteInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;

trait ZendDbSqlMapperTrait
{
	/**
	 * @var \Zend\Db\Adapter\AdapterInterface
	 */
	protected $dbAdapter;

	/**
	 * @var \Zend\Stdlib\Hydrator\HydratorInterface
	 */
	protected $hydrator;

	/**
	 * @var \Sites\Model\SiteInterface
	 */
	protected $prototype;

    /**
     * @var string
     */
    protected $tableName;

	/**
	 * @param null $where
	 * @param null $order
	 * @param null $limit
	 * @param null $offset
	 * @return array|SiteInterface[]
	 */
	public function getAll($where = null, $order = null, $limit = null, $offset = null)
	{
		$sql = new Sql($this->dbAdapter);
		$select = $sql->select($this->tableName);
		if($where !== null){
			$this->applyWhere($select, $where);
		}
		if($order !== null){
			$select->order($order);
		}
		if($limit !== null && !($limit <= 0)){
			$select->limit($limit);
			if($offset !== null){
				$select->offset($offset);
			}
		}
		$stmt = $sql->prepareStatementForSqlObject($select);

		/** @var \Zend\Db\Adapter\Driver\Pdo\Result  $result */
		$result = $stmt->execute();

		if($result instanceof ResultInterface && $result->isQueryResult()){
			$resultSet = new HydratingResultSet(
				$this->hydrator,  $this->getPrototype()
			);

			return $resultSet->initialize($result);
		}

		return array();
	}

	/**
	 * @param null $where
	 * @return int
	 */
	public function getCount($where = null)
	{
		$sql = new Sql($this->dbAdapter);
		$select = $sql->select($this->tableName);
		if($where !== null){
			$this->applyWhere($select, $where);
		}

		$select->columns(array('count' => new \Zend\Db\Sql\Expression('COUNT(*)')));

		$stmt = $sql->prepareStatementForSqlObject($select);
		/** @var \Zend\Db\Adapter\Driver\Pdo\Result $result */
		$result = $stmt->execute();
		$result = $result->current();
		return $result['count'];
	}

    public function getPrototype()
    {
        return clone $this->prototype;
    }

	/**
	 * @param $select Select
	 * @param $where
	 */
	protected function applyWhere(&$select, $where)
	{
		if(is_array($where)){
			foreach($where as $w){
				$select->where($w);
			}
		}else{
			die('$where that is not and array not implemented');
		}
	}
}