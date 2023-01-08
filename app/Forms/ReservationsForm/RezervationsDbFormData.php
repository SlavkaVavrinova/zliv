<?php

namespace App\Forms\ReservationsForm;



class RezervationsDbFormData
{
    //    use Nette\SmartObject; todo zeptat se co to je, proč to tam je a není

    public int $id;
    public string $Termin;
    public ?string $Stav;
    public ?string $Agentura;
    public ?string $Jmeno;
    public ?string $Info;
    public ?string $Cena;
    public ?string $Zaplaceno;
    public ?string $orderID;
    public ?string $Email;
    public ?string $emailDate;
    public ?string $Telefon;
    public ?string $arrivalTime;
}


