<?php

namespace application\core;

class View {
    public $params;
    public $path;
    public $layout = 'default';

    public function __construct($params) {
        $this->params = $params;
        $this->path = $params['controller'] . '/' . $params['action'];
    }

    public function render($title, $vars = []) {
        extract($vars);

        $path = 'application/views/' . $this->path . '.php';

        if (file_exists($path)) { // Если файл вида существует
            ob_start(); // Буфферизация вывода 
            require $path;
            $content = ob_get_clean();
            require 'application/views/layouts/' . $this->layout . '.php';
        } else {
            echo 'Вид не найден: ' . $this->path;
        }
    }

    public function redirect($url) {
        header('location: ' . $url);
        exit;
    }

    public static function errorCode($code) {
        http_response_code($code);

        $path = 'application/views/errors/' . $code . '.php';
        
        if (file_exists($path)) {
            require $path;
        }
        exit;
    }
}