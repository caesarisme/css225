<?php

namespace application\models;

use application\core\Model;


class Admin extends Model {
    public $error;

    public function loginValidate($post) {
        $cfg = require 'application/config/admin.php';
        if ($cfg['login'] != $_POST['login'] or $cfg['password'] != $_POST['password']) {
            $this->error = 'Login or password is incorrect!';
            return false;
        }
        return true;
    }

    public function postValidate($post, $type) {
        if (strlen($post['title']) < 1 or strlen($post['title']) > 100) {
            $this->error = 'Title should contain 1 to 100 chars';
            return false;
        } else if (strlen($post['content']) < 10 or strlen($post['content']) > 5000) {
            $this->error = 'Post content should contain 10 to 5000 chars';
            return false;
        }

        if ($type == 'add' and empty($_FILES['image']['tmp_name'])) {
            $this->error = 'Image is not uploaded!';
            return false;
        }

        return true;
    }

    public function postAdd($post) {
        $context = [
            'id' => null,
            'title' => $post['title'],
            'content' => $post['content'],
            'image' => '',
            'pub_date' => date('Y-m-d H:i:s'),
        ];

        $this->db->query('INSERT INTO posts VALUES (:id, :title, :content, :image, :pub_date)', $context);
        return $this->db->lastInsertId();
    }

    public function postUploadImage($path, $id) {
        move_uploaded_file($path, 'public/media/posts/'.$id.'.jpg');
        $context = [
            'id' => $id,
            'image' => '/public/media/posts/'.$id.'.jpg',
        ];
        $this->db->query('UPDATE posts SET image=:image WHERE id=:id', $context);
    }

    public function isPostExists($id) {

    }

}


