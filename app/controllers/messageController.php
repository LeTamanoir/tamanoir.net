<?php
namespace controllers; 
use models\messageModel;
use models\discussionModel;

class messageController 
{

    public function deleteMessage ($messageID,$userID) {
        $messageModel = new messageModel();
        $check = $messageModel->getMessageUserID($messageID);
        if ($check['author_id'] === $userID) {
            $messageModel->deleteMessage($messageID);
        }
    }

    public function sendMessage ($discussionID, $content, $userID) {
        $messageModel = new messageModel();
        $discussionModel = new discussionModel();
        $check = $discussionModel->checkUserInDiscussion($discussionID,$userID);
        if ($check) {
            $messageModel->sendMessage($content,$discussionID,$userID);
        }
    }

    
} 
?>