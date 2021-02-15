<?php
namespace controllers; 
use models\messageModel;

class messageController 
{
    public function displayDiscussions ($userID) {
        $messageModel = new messageModel();
        $discussions = $messageModel->getDiscussions($userID);
        return $discussions;
    }

    public function displayDiscussion ($discussionID) {
        $messageModel = new messageModel();
        $discussion = $messageModel->getDiscussion($discussionID);
        return $discussion;
    }

    public function deleteMessage ($messageID,$userID) {
        $messageModel = new messageModel();
        $check = $messageModel->getkMessageUserID($messageID);
        if ($check['author_id'] === $userID) {
            $messageModel->deleteMessage($messageID);
        }
    }

    public function sendMessage ($discussionID, $content, $userID) {
        $messageModel = new messageModel();
        $discussions = $messageModel->getDiscussions($userID);
        foreach ($discussions as $discussion) {
            if ($discussion['id'] === $discussionID) {
                $messageModel->sendMessage($content,$discussionID,$userID);
            };
        }
    }

} 
?>