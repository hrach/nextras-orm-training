<?php

namespace App\Model;

use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasMany;


/**
 * @property int $id   {primary}
 * @property string $name
 * @property ManyHasMany|Book[] $books {m:m Book::$authors}
 */
class Author extends Entity
{
}
