<?php

namespace controllers;
use models\messageModel;

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
        $messageModel = new messageModel();
        if (!empty($discussionID)) {
            $messages = $messageModel->getDiscussion($discussionID);
        }
        $discussions = $messageModel->getDiscussions($userID);
        include('views/inbox.php');
    }
}


?>