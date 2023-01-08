<?php

namespace App\Forms\ReservationsForm;

interface ReservationsFormFactory
{
    public function create(): ReservationsForm;

}