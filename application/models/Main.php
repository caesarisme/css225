<?php

namespace application\models;

use application\core\Model;


class Main extends Model {
    public $error;

    public function contactValidate ($post) {
        if (strlen($post['name']) < 1 or strlen($post['name']) > 20) {
            $this->error = 'Name should contain 1 to 20 chars';
            return false;
        } else if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = 'Email is incorrect';
            return false;
        } else if (strlen($post['message']) < 10 or strlen($post['message']) > 500) {
            $this->error = 'Message should contain 10 to 500 chars';
            return false;
        }
        return true;
    }
}


