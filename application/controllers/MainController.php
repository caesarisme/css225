<?php

namespace application\controllers;

use application\core\Controller;
use application\models\Admin;

class MainController extends Controller {

    public function indexAction() {
        $this->view->render('Home');
    }

    public function aboutAction() {
        $this->view->render('About');
    }

    public function contactAction() {
        $cfg = require 'application/config/admin.php';
        if (!empty($_POST)) {
            if (!$this->model->contactValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }
            mail($cfg['email'], 'Message from site.com by ' . $_POST['name'], $_POST['message']);
            $this->view->message('success', 'Message sent to admin!');
        }

        $this->view->render('Contact us');
    }

    public function postAction() {
        $admin_model = new Admin;
        if (!$admin_model->isPostExists($this->params['id'])) {
            $this->view->errorCode(404);
        }

        $vars = [
            'post' => $admin_model->postGet($this->params['id']),
        ];

        $this->view->render('Article', $vars);
    }
}