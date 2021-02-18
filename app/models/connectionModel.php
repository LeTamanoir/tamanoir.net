<?php
namespace models;
use models\connectionDB;

class connectionModel
{
    public function checkUser ($username,$password) {
        $connection = new connectionDB(); 
        $conn = $connection->connection();
        $check = $conn->prepare("SELECT * FROM `users` WHERE `username` = ?");
        $check->execute([$username]);
        $user = $check->fetch();
        
        if (md5($password) === $user['password']) {
            if ($user['state'] === "active") {
                return $user;
            }
            elseif ($user['state'] === "confirm") {
                return "make sure that your confirmed your email";
            }
            elseif ($user['state'] === "blocked") {
                return "your account as been blocked";
            }
        }
        else {
            return "username or password incorrect";
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

    public function addUser ($username, $email, $password, $role) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("INSERT INTO `users` (`username`, `password`, `email`, `role`, `state`, `trust`) VALUES (?,?,?,?,'confirm','')");
        $request->execute([$username,$password,$email,$role]);
    }
}
