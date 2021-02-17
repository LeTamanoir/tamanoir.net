<?php
namespace models;
use models\connectionDB;

class messageModel
{
    public function getMessageUserID ($messageID) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("SELECT `author_id` FROM `messages` WHERE `id` = ?");
        $request->execute([$messageID]);
        $user = $request->fetch();
        return $user;
    }

    public function deleteMessage ($messageID) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("DELETE FROM `messages` WHERE `id` = ?");
        $request->execute([$messageID]);
    }


    public function sendMessage ($content, $discussionID, $userID) {
        date_default_timezone_set('Europe/Paris');
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("INSERT INTO `messages` (`content`, `date`, `discussion_id`, `author_id`) VALUES (?,?,?,?)");
        $request->execute([$content, date("Y:m:d H:i:s"), $discussionID, $userID]);
    }




}

?>