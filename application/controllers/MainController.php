<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller {

    public function indexAction() {
        $this->view->render('Home');
    }

    public function aboutAction() {
        $this->view->render('About');
    }

    public function contactAction() {
        if (!empty($_POST)) {
            if (!$this->model->contactValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }
            mail('kakopo@wmail2.com', 'Message from site.com by ' . $_POST['name'], $_POST['message']);
            $this->view->message('success', 'Message sent to admin!');
        }
        $this->view->render('Contact us');
    }

    public function postAction() {
        $this->view->render('Article');
    }
}