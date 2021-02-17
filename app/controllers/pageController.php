<?php

namespace controllers;
use models\messageModel;
use models\discussionModel;
use classes\Parsedown;

class pageController 
{
    public function navbar ($page) {
        if ($page === "Login") {
            $logged=false;

        }
        else {
            $logged=true;
            
        }
        include("views/navbar.php");
    }

    public function home ($username,$useremail) {
        include('views/home.php');
    }

    public function inbox ($discussionID,$userID) {
        $discussionModel = new discussionModel();
        $discussionCreator = $discussionModel->getDiscussionCreator($discussionID);
        // $discussions = $messageModel->getDiscussions($userID);

        // $check = $messageModel->checkUserInDiscussion($discussionID,$userID);

        // if ($check) {
        //     $messages = $messageModel->getDiscussion($discussionID);
        // }

        // if (!empty($discussionID)) {
        //     foreach ($discussions as $discussion) {
        //         if ($discussion['id'] === $discussionID) {
        //             $messages = $messageModel->getDiscussion($discussionID);
        //         }
        //     }
        // }

        include('views/inbox.php');
    }
}


?>