<?php
namespace controllers;

use models\usersModel;

class usersController
{
    public function verifyUser ($username,$password) {
        $usersModel = new usersModel();
        $check = $usersModel->getPassFromUser($username);
        if ($check['password'] === $password) {
            return true;
        }
        else {
            return false;
        }
    }

    public function confirmUser ($username) {
        $usersModel = new usersModel();
        $usersModel->switchState($username,'active');
    }

    public function rejectUser ($username,$password) {
        $usersModel = new usersModel();
        $usersModel->deleteUser($username,$password);
    } 
    
}