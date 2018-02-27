<?php

namespace App\Model;

use Nextras\Orm\Repository\Repository;


/**
 * @extends Repository<Author>
 */
class AuthorsRepository extends Repository
{
	public static function getEntityClassNames(): array
	{
		return [Author::class];
	}
}
