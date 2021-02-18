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

    public function checkUsername ($username) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("SELECT `id` FROM `users` WHERE `username` = ?");
        $request->execute([$username]);
        $check = $request->fetch();
        return $check; 
    }

    public function checkEmail ($email) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("SELECT `id` FROM `users` WHERE `email` = ?");
        $request->execute([$email]);
        $check = $request->fetch();
        return $check; 
    }

    public function addUser ($user, $email, $password, $role) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("INSERT INTO users (username, password, email, role, state, trust) VALUES (?,?,?,?,'confirm','')");
        $request->execute(array($username,$password,$email,$role));
    }
}
