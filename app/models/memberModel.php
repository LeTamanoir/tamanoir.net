<?php
namespace models;
use models\connectionDB;

class memberModel
{
    public function getMembers ($discussionID) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("SELECT `users`.`username`, `users`.`id` FROM `discussion_members` INNER JOIN `users` ON `discussion_members`.`member_id` = `users`.`id` WHERE `discussion_members`.`id` = ?");
        $request->execute([$discussionID]);
        $members =  $request->fetchAll();
        return $members;
    }

    public function getMemberID ($member) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("SELECT `id` FROM `users` WHERE `username` = ?");
        $request->execute([$member]);
        $users = $request->fetchAll();
        if (count($users) === 1) {
            return $users[0]['id'];
        } else {
            return false;
        }
    }

    public function addMember ($memberID,$discussionID) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("INSERT INTO `discussion_members` (`id`, `member_id`) VALUES (?,?)");
        $request->execute([$discussionID,$memberID]);
        
    }

    public function delMember ($discussionID,$memberID) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("DELETE FROM `discussion_members` WHERE `discussion_members`.`id` = ? AND `discussion_members`.`member_id` = ?");
        $request->execute([$discussionID,$memberID]);
    }
}
