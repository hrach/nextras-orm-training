<?php

namespace App;

use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Nette\Routing\SimpleRouter;


class RouterFactory
{
	public static function createRouter(): RouteList
	{
		$router = new RouteList;
		$router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');
		$router[] = new SimpleRouter(['presenter' => 'Homepage', 'action' => 'default']);
		return $router;
	}
}
