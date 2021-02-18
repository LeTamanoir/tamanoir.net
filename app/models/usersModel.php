<?php
namespace models;
use models\connectionDB;

class usersModel
{
    public function getPassFromUser ($username) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("SELECT `password` FROM `users` WHERE `username` = ?");
        $request->execute([$username]);
        $password = $request->fetch();
        return $password;
    }

    public function switchState ($username, $state) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("UPDATE `users` SET state = ? WHERE `username` = ?");
        $request->execute([$state,$username]);
    }

    public function deleteUser ($username,$password) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("DELETE FROM `users` WHERE `username` = ? AND `password` = ?");
        $request->execute([$username,$password]);
    }

}
