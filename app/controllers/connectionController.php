<?php
namespace controllers;
use models\connectionModel;

class connectionController 
{
    public function login (string $username, string $password)
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
}