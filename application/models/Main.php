<?php

namespace application\models;

use application\core\Model;


class Main extends Model {
    public function getNews() {
        $news = $this->db->row('SELECT title, description FROM news');
        return $news;
    }
}


