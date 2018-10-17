<?php declare(strict_types = 1);

namespace App\Model;

use Nette\Utils\Json;
use Nextras\Orm\Entity\ImmutableValuePropertyWrapper;


class ColorContainer extends ImmutableValuePropertyWrapper
{
	public function convertToRawValue($value): ?string
	{
		if ($value == null) return "{}";
		return Json::encode([
			'red' => $value->red,
			'green' => $value->green,
			'blue' => $value->blue,
		]);
	}


	public function convertFromRawValue($value): ?Color
	{
		if ($value == null) return null;
		$rgb = Json::decode($value);
		if (!isset($rgb->red)) return null;
		return new Color(
			red: $rgb->red ?? 0,
			green: $rgb->green ?? 0,
			blue: $rgb->blue ?? 0,
		);
	}
}
