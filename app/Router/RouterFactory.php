<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
        $router->addRoute('', 'Ruzenka:Homepage:default');
        $router->addRoute('ruzenka/login', 'Ruzenka:Login:login');
        $router->addRoute('ruzenka/reservations', 'Ruzenka:Reservations:reservations');
        $router->addRoute('ruzenka/detail', 'Ruzenka:Detail:detail');
        $router->addRoute('ruzenka/upravit', 'Ruzenka:Detail:add');

       // $router->addRoute('admin/add', 'Admin:PostEdit:add');

		$router->addRoute('<presenter>/<action>[/<id>]', 'Ruzenka:Homepage:default');
		return $router;
	}
}
