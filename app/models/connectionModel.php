<?php
namespace models;
use models\connectionDB;

class connectionModel
{
    public function checkUser (string $username, string $password) {
        $connection = new connectionDB(); 
        $conn = $connection->connection();
        
        $check = $conn->prepare("SELECT * FROM `users` WHERE `username` = ?");
        $check->execute([$username]);
        $user = $check->fetch();
        
        if ($user) {
            if (md5($password) === $user['password']) {
                return $user;
            }
        } else {
            return false;
        }
    }
}
