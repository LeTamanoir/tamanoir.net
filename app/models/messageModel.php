<?php
namespace models;
use models\connectionDB;

class messageModel
{
    public function getDiscussions ($userID) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("SELECT `discussions`.`id`,`discussions`.`discussion` FROM `discussions` INNER JOIN `discussion_members` ON `discussions`.`id` = `discussion_members`.`id` AND `discussion_members`.`member_id` = ?");
        $request->execute([$userID]);
        $discussions = $request->fetchAll();
        return $discussions;
    }
    public function getDiscussion ($discussionID) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("SELECT `messages`.`content`,`messages`.`discussion_id`,`messages`.`id`,`messages`.`date`,`messages`.`author_id`,`users`.`username` FROM `messages` INNER JOIN `users` ON `messages`.`author_id` =  `users`.`id` AND `discussion_id` = ?");
        $request->execute([$discussionID]);
        $discussion = $request->fetchAll();
        return $discussion;
    }

    public function getkMessageUserID ($messageID) {
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