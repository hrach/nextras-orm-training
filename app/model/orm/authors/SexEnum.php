<?php declare(strict_types = 1);

namespace App\Model;

use MabeEnum\Enum;


class SexEnum extends Enum
{
	const MAN = 'male';
	const WOMAN = 'female';
	const NOT_SET = null;
}
