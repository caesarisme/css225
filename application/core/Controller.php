<?php

namespace application\core;

use application\core\View;

abstract class Controller {
    public $params;
    public $view;
    public $model;
    public $acl;

    public function __construct($params) {
        $this->params = $params;
        if (!$this->checkAcl()) {
            View::errorCode(403);
        }
        $this->view = new View($params);
        $this->model = $this->loadModel($params['controller']);
    }

    public function loadModel($name) {
        $path = 'application\models\\' . ucfirst($name);
        if (class_exists($path)) {
            return new $path();
        }
    }

    public function checkAcl() {
        $this->acl = require 'application/acl/' . $this->params['controller'] . '.php';
        if ($this->isAcl('all')) {
            return true;
        }
        elseif (isset($_SESSION['authorized']['id']) and $this->isAcl('authorized')) {
            return true;
        }
        elseif (!isset($_SESSION['authorized']['id']) and $this->isAcl('guest')) {
            return true;
        }
        elseif (isset($_SESSION['admin']) and $this->isAcl('admin')) {
            return true;
        }
        return false;
    }

    public function isAcl($group) {
        return in_array($this->params['action'], $this->acl[$group]);
    }
}