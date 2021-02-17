<?php
namespace controllers; 
use models\discussionModel;

class discussionController 
{
    public function displayDiscussions ($userID) {
        $discussionModel = new discussionModel();
        $discussions = $discussionModel->getDiscussions($userID);
        return $discussions;
    }

    public function displayDiscussion ($discussionID,$userID) {
        $discussionModel = new discussionModel();
        $check = $discussionModel->checkUserInDiscussion($discussionID,$userID);
        if ($check) {
            $discussion = $discussionModel->getDiscussion($discussionID,$userID);
            return $discussion;
        }
    }

    public function createDiscussion ($discussionName,$userID) {
        $discussionModel = new discussionModel();
        $info = $discussionModel->createDiscussion($discussionName,$userID);
        return $info;
    }

    public function delDiscussion ($discussionID,$userID) {
        $discussionModel = new discussionModel();
        $creatorID = $discussionModel->getDiscussionCreator($discussionID);

        if ($creatorID['creator_id'] == $userID) {
            $discussionModel->delDiscussion($discussionID);

        }
    }
    
} 
?>