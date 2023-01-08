<?php

namespace App\Ruzenka\Presenters;

use App\Model\ReservationsFacade;
use App\Model\UserFacade;
use App\Ruzenka\Presenters\RequireLoggedUser;
use Nette\Security\SimpleIdentity;

class ReservationsPresenter extends \Nette\Application\UI\Presenter
{
    use RequireLoggedUser;

    private ReservationsFacade $reservationsFacade;

    public function __construct(ReservationsFacade $reservationsFacade)
    {
        $this->reservationsFacade = $reservationsFacade;
    }

    public function renderReservations(): void
    {
        $reservations = $this->reservationsFacade->getAllReservations();
        $this->template->reservations = $reservations;

       $this->template->loginUser = $this->getUser()->getId();
    }


}