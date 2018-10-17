<?php declare(strict_types = 1);

namespace App\Model;

use MabeEnum\Enum;
use Nextras\Orm\Entity\ImmutableValuePropertyContainer;
use Nextras\Orm\Entity\Reflection\PropertyMetadata;


class EnumContainer extends ImmutableValuePropertyContainer
{
	/** @var string */
	private $class;


	public function __construct(PropertyMetadata $propertyMetadata)
	{
		parent::__construct($propertyMetadata);
		assert(count($propertyMetadata->types) === 1);
		$this->class = key($propertyMetadata->types);
	}


	public function convertToRawValue($value)
	{
		assert($value instanceof Enum);
		return $value->getValue();
	}


	public function convertFromRawValue($value)
	{
		$class = $this->class;
		return $class::byValue($value);
	}


	public function setRawValue($value)
	{
		$this->value = $this->convertFromRawValue($value);
	}


	public function getRawValue()
	{
		return $this->convertToRawValue($this->value);
	}
}
