<?php
namespace models;
use models\connectionDB;

class discussionModel
{
    public function getDiscussions ($userID) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("SELECT `discussions`.`id`,`discussions`.`discussion`,`discussions`.`creator_id` FROM `discussions` INNER JOIN `discussion_members` ON `discussions`.`id` = `discussion_members`.`id` AND `discussion_members`.`member_id` = ?");
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

    public function checkUserInDiscussion ($discussionID,$userID) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("SELECT `discussions`.`id` FROM `discussions` INNER JOIN `discussion_members` ON `discussions`.`id` = `discussion_members`.`id` AND `discussion_members`.`member_id` = ? AND `discussions`.`id` = ?");
        $request->execute([$userID,$discussionID]);
        $check = $request->fetch();
        return $check;

    }

    public function getDiscussionCreator ($discussionID) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("SELECT `creator_id` FROM `discussions` WHERE `id` = ?");
        $request->execute([$discussionID]);
        $creator = $request->fetch();
        return $creator;
    }

    public function createDiscussion ($discussionName,$userID) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $check = $conn->prepare("SELECT * FROM `discussions` WHERE `discussion` = ?");
        $check->execute([$discussionName]);
        $check = $check->fetchAll();
        if (count($check) > 0) {
            return ["info" => "discussion name already used"];
        }

        else {
            $request = $conn->prepare("INSERT INTO `discussions` (`discussion`, `creator_id`) VALUES (?,?)");
            $request->execute([$discussionName,$userID]);

            $requestDiscussion = $conn->prepare("SELECT `id` FROM `discussions` WHERE `discussion` = ?");
            $requestDiscussion->execute([$discussionName]);
            $discussionID = $requestDiscussion->fetch();

            $request = $conn->prepare("INSERT INTO `discussion_members` (`id`, `member_id`) VALUES (?,?)");
            $request->execute([$discussionID['id'],$userID]);
            
            return ["info" => "success"];
        }
    }

    public function delDiscussion ($discussionID) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $discussion = $conn->prepare("DELETE FROM `discussions` WHERE `id` = ?");
        $discussion->execute([$discussionID]);

        $members = $conn->prepare("DELETE FROM `discussion_members` WHERE `id` = ?");
        $members->execute([$discussionID]);

        $messages = $conn->prepare("DELETE FROM `messages` WHERE `discussion_id` = ?");
        $messages->execute([$discussionID]);
    }
}
?>