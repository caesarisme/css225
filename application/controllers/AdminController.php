<?php

namespace application\controllers;

use application\core\Controller;

class AdminController extends Controller {

    public function __construct($params){
//        $_SESSION['admin'] = 1;
        parent::__construct($params);
        $this->view->layout = 'admin';
    }

    public function loginAction() {
        if (isset($_SESSION['admin'])) {
            $this->view->redirect('admin/add');
        }
        if (!empty($_POST)) {
            if (!$this->model->loginValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }
            $_SESSION['admin'] = true;
            $this->view->ajax_redirect('admin/add');
        }

        $this->view->render('Sign-in');
    }

    public function addAction() {
        if (!empty($_POST)) {
            if (!$this->model->postValidate($_POST, 'add')) {
                $this->view->message('error', $this->model->error);
            }
            $id = $this->model->postAdd($_POST);
            if (!$id) {
                $this->view->message('success', 'Something went wrong! Try again');
            }
            $this->model->postUploadImage($_FILES['image']['tmp_name'], $id);

            $this->view->message('success', 'Post added');
        }

        $this->view->render('New post');
    }

    public function editAction() {
        if (!empty($_POST)) {
            if (!$this->model->postValidate($_POST, 'edit')) {
                $this->view->message('error', $this->model->error);
            }
            $this->view->message('success', 'ok');
        }

        $this->view->render('Edit post');
    }

    public function deleteAction() {
        debug($this->params);
        exit('Удалить пост');
    }

    public function logoutAction() {
        unset($_SESSION['admin']);
        $this->view->redirect('admin/login');
    }

    public function postsAction() {
        $this->view->render('Posts list');
    }

}