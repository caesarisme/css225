<?php

namespace application\core;

use application\core\View;

abstract class Controller {
    public $params;
    public $view;

    public function __construct($params) {
        $this->params = $params;
        $this->view = new View($params);

        $this->model = $this->loadModel($params['controller']);
    }

    public function loadModel($name) {
        $path = 'application\models\\' . ucfirst($name);
        if (class_exists($path)) {
            return new $path();
        }
        
    }
}