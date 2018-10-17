<?php

namespace App\Model;

use Nette\Utils\ArrayHash;
use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasMany;


/**
 * @property int                $id    {primary}
 * @property string             $name
 * @property ManyHasMany|Book[] $books {m:m Book::$authors}
 * @property SexEnum            $sex   {container EnumContainer}
 * @property mixed|ArrayHash    $data  {container JsonContainer}
 */
class Author extends Entity
{
}
