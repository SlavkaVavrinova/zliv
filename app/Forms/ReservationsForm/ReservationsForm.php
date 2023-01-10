<?php

namespace App\Forms\ReservationsForm;

use App\Forms\ReservationsForm\ReservationsFormFactory;
use App\Model\ReservationsFacade;
use App\Forms\BaseForm;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;

class ReservationsForm extends BaseForm
{
    private ReservationsFacade $reservationsFacade;
    private ReservationsFormFactory $reservationsFormFactory;

    /** @var callable[] */
    public $onSuccess = [];

    public function __construct(ReservationsFacade $reservationsFacade, ReservationsFormFactory $reservationsFormFactory)
    {
        $this->reservationsFacade = $reservationsFacade;
        $this->reservationsFormFactory = $reservationsFormFactory;

        $this->addInteger('id', 'Id:');
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
        $this->reservationsFacade->updateReservation($reservationsData);
    }

}