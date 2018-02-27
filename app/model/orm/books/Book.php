<?php

namespace App\Model;

use DateTimeImmutable;
use Nextras\Orm\Entity\Entity;


/**
 * @property int               $id   {primary}
 * @property string            $title
 * @property DateTimeImmutable $publishedOn
 * @property-read int          $year {virtual}
 */
class Book extends Entity
{
	protected function getterYear()
	{
		return $this->publishedOn->format('Y');
	}
}
