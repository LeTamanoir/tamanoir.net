<?php
namespace controllers;
use models\connectionModel;

class connectionController
{
    public function login ($username, $password)
    {
        $connectionModel = new connectionModel();
        $user = $connectionModel->checkUser($username,$password);
        if ($user) {
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['trust'] = $user['trust'];
            $_SESSION['id'] = $user['id'];
            return true;
        }
        else {
            return false;
        }
    }

    public function register ($post) {
        if (!empty($post['confirm-email']) && !empty($post['email']) && !empty($post['username']) && !empty($post['password']) && !empty($post['confirm-password'])) {
            $info = "en cours de dvlp";
            return $info;
        }
        else {
            return false;
        }
    }
}