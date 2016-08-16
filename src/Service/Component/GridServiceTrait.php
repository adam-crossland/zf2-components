<?php
namespace ZF2Components\Service\Component;

trait GridServiceTrait
{
	protected $mapper;

	/**
	 * @param null $where
	 * @param null $order
	 * @param null $limit
	 * @param null $offset
	 * @return []
	 */
	public function getAll($where = null, $order = null, $limit = null, $offset = null)
	{
		return $this->mapper->getAll($where, $order, $limit, $offset);
	}

	/**
	 * @param null $where
	 * @return int
	 */
	public function getCount($where = null)
	{
		return $this->mapper->getCount($where);
	}
}