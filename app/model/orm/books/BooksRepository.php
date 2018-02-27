<?php

namespace App\Model;

use Nextras\Orm\Repository\Repository;


/**
 * @extends Repository<Book>
 */
class BooksRepository extends Repository
{
	public static function getEntityClassNames(): array
	{
		return [Book::class];
	}
}
