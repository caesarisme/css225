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

        $vars = [
            'categories' => $this->model->categoriesGet(),
        ];

        $this->view->render('New post', $vars);
    }

    public function editAction() {
        if (!$this->model->isPostExists($this->params['id'])){
            $this->view->errorCode(404);
        }

        if (!empty($_POST)) {
            if (!$this->model->postValidate($_POST, 'edit')) {
                $this->view->message('error', $this->model->error);
            }
            $this->model->postEdit($_POST, $this->params['id']);
            if (!empty($_FILES['image']['tmp_name'])) {
                $this->model->postUploadImage($_FILES['image']['tmp_name'], $this->params['id']);
            }

            $this->view->message('success', 'Saved!');
        }

        $vars = [
            'post' => $this->model->postGet($this->params['id']),
            'categories' => $this->model->categoriesGet(),
        ];

        $this->view->render('Edit post', $vars);
    }

    public function deleteAction() {
        if (!$this->model->isPostExists($this->params['id'])) {
            $this->view->errorCode(404);
        }
        $this->model->postDelete($this->params['id']);
        $this->view->redirect('admin/posts');
    }

    public function logoutAction() {
        unset($_SESSION['admin']);
        $this->view->redirect('admin/login');
    }

    public function postsAction() {
        $vars = [
            'posts' => $this->model->postsGet(),
        ];

        $this->view->render('Posts list', $vars);
    }

}