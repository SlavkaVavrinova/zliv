<?php

declare(strict_types=1);

namespace App\Forms\LoginForm;

use App\Forms\FormFactory;
use Nette\Application\UI\Form;

class UsersFormFactory
{
    public function __construct(
        private FormFactory $formFactory)
    {
    }

    public function create(): Form
    {
        $form = $this->formFactory->create();
        return $form;
    }
}