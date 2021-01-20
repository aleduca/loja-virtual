<?php

namespace App\Classes;

use App\Models\Model;

class User {

    public function user(Model $model) {
        return $model->find('id', $_SESSION['id']);
    }
}