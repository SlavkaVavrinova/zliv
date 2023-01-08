<?php

declare(strict_types=1);

namespace App\Ruzenka\Presenters;

trait RequireLoggedUser
{
	public function injectRequireLoggedUser()
	{
		$this->onStartup[] = function () {
			if (!$this->getUser()->isLoggedIn()) {
				$this->redirect('Reservations:reservations');
			}
		};
	}
}
