<?php

namespace application\models;

use application\core\Model;


class Admin extends Model {
    public $error;

    public function loginValidate($post) {
        $cfg = require 'application/config/admin.php';
        if ($cfg['login'] != $post['login'] or $cfg['password'] != $post['password']) {
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
        } else if (empty($post['category_id'])) {
            $this->error = 'Select a category!';
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
            'category_id' => $post['category_id'],
        ];

        $this->db->query('INSERT INTO posts VALUES (:id, :title, :content, :image, :pub_date, :category_id)', $context);
        return $this->db->lastInsertId();
    }

    public function postEdit($post, $id) {
        $context = [
            'id' => $id,
            'title' => $post['title'],
            'content' => $post['content'],
            'pub_date' => date('Y-m-d H:i:s'),
            'category_id' => $post['category_id'],
        ];

        $this->db->query('UPDATE posts SET title=:title, content=:content, pub_date=:pub_date, category_id=:category_id WHERE id=:id', $context);
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

    public function postDelete($id) {
        $context = [
            'id' => $id,
        ];
        $this->db->query('DELETE FROM posts WHERE id=:id', $context);
        unlink('public/media/posts/'.$id.'.jpg');
    }

    public function postGet($id) {
        $context = [
            'id' => $id,
        ];
        return $this->db->row('SELECT * FROM posts WHERE id=:id', $context)[0];
    }

    public function postsGet() {
        return $this->db->row('SELECT * FROM posts');
    }

    public function postsFilter($data) {
        $query = ' WHERE ';
        $context = [];

        if (!empty($data['title'])) {
            $query .= 'title=:title AND ';
            $context['title'] = $data['title'];
        }
        if (!empty($data['date_from'])) {
            $query .= 'pub_date>=:date_from AND ';
            $context['date_from'] = $data['date_from'];
        }
        if (!empty($data['date_to'])) {
            $query .= 'pub_date<=:date_to AND';
            $context['date_to'] = $data['date_to'];
        }
        if (!empty($data['category_id'])) {
            $query .= 'category_id=:category_id AND';
            $context['category_id'] = $data['category_id'];
        }

        $query = substr($query, 0, strlen($query)-4);
        return $this->db->row('SELECT * FROM posts'.$query, $context);
    }

    public function isPostExists($id) {
        $context = [
            'id' => $id
        ];
        return $this->db->column('SELECT id FROM posts WHERE id=:id', $context);
    }

    public function categoriesGet() {
        return $this->db->row('SELECT * FROM categories');
    }

    public function categoryGet($id) {
        $context = [
            'id' => $id
        ];
        return $this->db->row('SELECT * FROM categories WHERE id=:id', $context)[0];
    }

    public function starPost($id) {
        $context = [
            'id' => null,
            'post_id' => $id,
        ];
        $this->db->query('INSERT INTO stars VALUES (:id, :post_id)', $context);
        return 'ok';
    }

    public function starsGet() {
        return $this->db->row('SELECT * FROM stars');
    }

}


