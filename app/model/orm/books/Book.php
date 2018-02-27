<?php

namespace App\Model;

use DateTimeImmutable;
use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasMany;


/**
 * @property int                 $id      {primary}
 * @property string              $title
 * @property DateTimeImmutable   $publishedOn
 * @property ManyHasMany<Author> $authors {m:m Author::$books, isMain=true}
 * @property-read int            $year    {virtual}
 */
class Book extends Entity
{
	protected function getterYear(): int
	{
		return (int) $this->publishedOn->format('Y');
	}
}
