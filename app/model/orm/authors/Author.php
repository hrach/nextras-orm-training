<?php

namespace App\Model;

use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasMany;


/**
 * @property int               $id     {primary}
 * @property string            $name
 * @property ManyHasMany<Book> $books  {m:m Book::$authors}
 * @property Sex|null          $sex
 * @property Color|null        $color  {wrapper ColorContainer}
 */
class Author extends Entity
{
}
