<?php

namespace application\controllers;

use application\core\Controller;

class AdminController extends Controller {

    public function loginAction() {
        $this->view->render('Главная страница');
    }

    public function addAction() {
        $this->view->render('Добавить пост');
    }

    public function editAction() {
        $this->view->render('Редактировать пост');
    }

    public function deleteAction() {
        exit('Редактировать пост');
    }

    public function logoutAction() {
        exit('Выход');
    }

}