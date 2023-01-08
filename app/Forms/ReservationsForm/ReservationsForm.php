<?php

namespace App\Forms\ReservationsForm;

use App\Forms\FormFactory;
use App\Model\ReservationsFacade;
use Nette\Application\UI\Form;

class ReservationsForm
{
    private ReservationsFacade $reservationsFacade;
    private ReservationsFormFactory $reservationsFormFactory;

    public function __construct(ReservationsFacade $reservationsFacade, ReservationsFormFactory $reservationsFormFactory)
    {
        $this->reservationsFacade = $reservationsFacade;
        $this->reservationsFormFactory = $reservationsFormFactory;

        $this->addText('Termin', 'Termin:')
            ->setRequired()
            ->addRule(Form::MAX_LENGTH, null, 255);
        $this->addText('Stav', 'Stav:')
            ->addRule(Form::MAX_LENGTH, null, 255);
        $this->addText('Agentura', 'Agentura:')
            ->addRule(Form::MAX_LENGTH, null, 255);
        $this->addText('Jmeno', 'Jmeno:')
            ->addRule(Form::MAX_LENGTH, null, 255);
        $this->addTextArea('Info', 'Info:');
        $this->addTextArea('Cena', 'Cena:');
        $this->addTextArea('Zaplaceno', 'Zaplaceno:');
        $this->addTextArea('orderID', 'OrderID:');
        $this->addTextArea('Email', 'Email:');
        $this->addTextArea('emailDate', 'EmailDate:');
        $this->addTextArea('Telefon', 'Telefon:');
        $this->addTextArea('arrivalTime', 'ArrivalTime:');
        $this->addSubmit('send', 'Uložit');
        $this->addProtection();
        $this->onSuccess[] = $this->ReservationsFormSucceeded(...);
    }

    public function ReservationsFormSucceeded($form, RezervationsDbFormData $reservationsData)
    {
        // $reservationsData->idMojeProUlozeni = $this->getUser()->getId();
        $this->reservationsFacade->addReservation($reservationsData);
        $this->flashMessage('Rezervace uložena');
        $this->redirect('Reservations:Reservations');
    }

}