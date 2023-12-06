<?php

namespace App\Model;

use Nextras\Orm\Collection\Functions\CollectionFunction;
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


	protected function createCollectionFunction(string $name): CollectionFunction
	{
		if ($name === FetchJsonFieldFunction::class) return new FetchJsonFieldFunction();
		return parent::createCollectionFunction($name);
	}
}
