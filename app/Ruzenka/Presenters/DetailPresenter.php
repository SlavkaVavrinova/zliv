<?php

namespace App\Ruzenka\Presenters;

use App\Forms\FormFactory;
use App\Forms\ReservationsForm\ReservationsForm;
use App\Forms\ReservationsForm\ReservationsFormFactory;
use App\Forms\ReservationsForm\RezervationsDbFormData;
use App\Model\ReservationsFacade;
use Nette\Application\UI\Form;

class DetailPresenter extends \Nette\Application\UI\Presenter
{
    use RequireLoggedUser;

    private ReservationsFacade $reservationsFacade;
    private FormFactory $formFactory;

    public function __construct(FormFactory $formFactory, ReservationsFacade $reservationsFacade)
    {
        $this->formFactory = $formFactory;
        $this->reservationsFacade = $reservationsFacade;
    }


    protected function createComponentReservationsForm(): Form
    {
        //$form = $this->reservationsFormFactory->create();

        $form = $this->formFactory->create();

        $form->addInteger('id', 'Id:');
        $form->addText('Termin', 'Termin:');
        $form->addText('Stav', 'Stav:')
        ->addRule(Form::MAX_LENGTH, null, 255);
        $form->addText('Agentura', 'Agentura:')
            ->addRule(Form::MAX_LENGTH, null, 255);
        $form->addText('Jmeno', 'Jmeno:')
            ->addRule(Form::MAX_LENGTH, null, 255);
        $form->addTextArea('Info', 'Info:');
        $form->addTextArea('Cena', 'Cena:');
        $form->addTextArea('Zaplaceno', 'Zaplaceno:');
        $form->addTextArea('orderID', 'OrderID:');
        $form->addTextArea('Email', 'Email:');
        $form->addTextArea('emailDate', 'EmailDate:');
        $form->addTextArea('Telefon', 'Telefon:');
        $form->addTextArea('arrivalTime', 'ArrivalTime:');
        $form->addSubmit('send', 'Uložit');
        $form->addProtection();

        $form->onSuccess[] = $this->ReservationsFormSucceeded(...);

        return $form;
    }

    public function ReservationsFormSucceeded($form, RezervationsDbFormData $reservationsData)
    {
        $this->reservationsFacade->updateReservation($reservationsData);
        $this->flashMessage('Rezervace uložena');
        $this->redirect('Reservations:Reservations');
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