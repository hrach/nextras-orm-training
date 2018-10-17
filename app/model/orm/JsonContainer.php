<?php declare(strict_types = 1);

namespace App\Model;

use Nette\Utils\Json;
use Nextras\Orm\Entity\ImmutableValuePropertyContainer;


class JsonContainer extends ImmutableValuePropertyContainer
{
	public function convertToRawValue($value)
	{
		return Json::encode($value);
	}


	public function convertFromRawValue($value)
	{
		return Json::decode($value);
	}
}
