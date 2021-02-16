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

    public function displayDiscussion ($discussionID,$userID) {
        $messageModel = new messageModel();
        $discussions = $messageModel->getDiscussions($userID);

        foreach ($discussions as $discussion) {
            if ($discussion['id'] === $discussionID) {
                $discussion = $messageModel->getDiscussion($discussionID,$userID);
                return $discussion;
            }
        }
    }

    public function deleteMessage ($messageID,$userID) {
        $messageModel = new messageModel();
        $check = $messageModel->getMessageUserID($messageID);
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