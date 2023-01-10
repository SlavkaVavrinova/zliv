<?php

namespace App\Ruzenka\Presenters;

use App\Forms\ReservationsForm\ReservationsForm;
use App\Forms\ReservationsForm\ReservationsFormFactory;
use App\Forms\ReservationsForm\RezervationsDbFormData;
use App\Model\ReservationsFacade;
use Nette\Application\UI\Form;

class DetailPresenter extends \Nette\Application\UI\Presenter
{
    use RequireLoggedUser;

    private ReservationsFacade $reservationsFacade;
    private ReservationsFormFactory $reservationsFormFactory;

    public function __construct(ReservationsFormFactory $reservationsFormFactory, ReservationsFacade $reservationsFacade)
    {
        $this->reservationsFormFactory = $reservationsFormFactory;
        $this->reservationsFacade = $reservationsFacade;
    }


    protected function createComponentReservationsForm(): ReservationsForm
    {
        $form = $this->reservationsFormFactory->create();
        $form->onSuccess[] = function () {
            $this->flashMessage('Rezervace uložena');
            $this->redirect('Reservations:Reservations');
        };
        return $form;
    }

    


    public function renderDetail($id): void
    {
        $selectedReservation = $this->reservationsFacade->getReservation($id);

        if (!$selectedReservation) {
            $this->error();
        }

        $this->template->selectedReservation = $selectedReservation;
        $this->template->id = $id;
    }


    public function renderEdit(int $id):void
    {

        $form = $this->getComponent('reservationsForm');
        $editedReservation = $this->reservationsFacade->getReservation($id);

        if ($editedReservation) {
            foreach ($editedReservation as $reservationKey => $reservationValue){
                $form->setDefaults([
                    $reservationKey => $reservationValue,
                ]);
            }
        }

    }

    public function handleDelete(int $id):void
    {

        $this->reservationsFacade->delete($id);
        $this->redirect('Reservations:Reservations');
    }


}