<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller {

    public function indexAction() {
        $news = $this->model->getNews();

        $vars = [
            'news' => $news,
        ];
        $this->view->render('Главная страница', $vars);
    }
}