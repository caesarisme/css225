<?php

namespace application\controllers;

use application\core\Controller;

class AccountController extends Controller {

    public function loginAction() {

        if(!empty($_POST)) {
            $this->view->ajax_redirect('/');
        }

        $this->view->render('Войти в аккаунт');
    }

    public function registerAction() {
        $this->view->render('Зарегистрироватся');
    }
}