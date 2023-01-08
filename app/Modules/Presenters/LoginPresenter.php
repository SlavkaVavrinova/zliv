<?php

declare(strict_types=1);

namespace App\Ruzenka\Presenters;

use App\Forms\LoginForm\UsersFormFactory;
use Nette;
use Nette\Security\AuthenticationException;


final class LoginPresenter extends Nette\Application\UI\Presenter
{

    private UsersFormFactory $usersFormFactory;

    public function __construct(UsersFormFactory $usersFormFactory)
    {
        $this->usersFormFactory = $usersFormFactory;
    }

    protected function createComponentLoginForm(): Nette\Application\UI\Form
    {
        $form = $this->usersFormFactory->create();

        $form->addText('username', 'Uživatelské jméno (email):')
            ->setRequired()
            ->addRule($form::MAX_LENGTH, null, 255);
        $form->addPassword('password', 'Password:')
            ->setRequired()
            ->addRule($form::MAX_LENGTH, null, 255);
        $form->addSubmit('send', 'Přihlásit');
        $form->addProtection();
        $form->onSuccess[] = $this->loginFormSucceeded(...);


        return $form;
    }

    private function loginFormSucceeded($form, $data)
    {
        try {
            $this->getUser()->login($data->username, $data->password);
        } catch (AuthenticationException $e) {
            $form->addError('The username or password you entered is incorrect.');
            return;
        }
        $this->redirect('Reservations:reservations');
    }

    public function actionOut(): void
    {
        $this->getUser()->logout();
        $this->flashMessage('Byl jste odhlášen');
        $this->redirect(':Login:login');
    }
}
