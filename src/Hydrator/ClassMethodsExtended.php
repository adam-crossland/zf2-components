<?php
namespace ZF2Components\Hydrator;

use Zend\Hydrator\ClassMethods;

/**
 * Class ClassMethodsExtended
 * @package ZF2Components\Hydrator
 *
 * This class is intended for use with grids it allows the ability
 * to extract data from an object (e.g each row of the gird) that may not
 * exist as a class method, whilst retaining the functionality of ClassMethods
 */
class ClassMethodsExtended extends ClassMethods
{
	protected $additionalExtractionKeys;

	public function __construct(
		$underscoreSeparatedKeys = true,
		$additionalExtractionKeys = array()
	){
		$this->additionalExtractionKeys = $additionalExtractionKeys;
		parent::__construct($underscoreSeparatedKeys);
	}

	public function extract($object)
	{
		$values = parent::extract($object);
		foreach($this->additionalExtractionKeys as $key){
			$convertedName = $this->extractName($key, $object);
			$values[$convertedName] = $this->extractValue($convertedName, null, $object);
		}
		return $values;
	}
}