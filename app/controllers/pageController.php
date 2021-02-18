<?php

namespace controllers;
use models\messageModel;
use models\discussionModel;
use classes\Parsedown;

class pageController 
{
    public function navbar ($page) {
        if ($page === "Login" || $page === "Register") {
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
        include('views/inbox.php');
    }

    public function streaming ($show, $season, $userTrust) {
        $streamingController = new streamingController();
        if ($show && $season) {
            $episodes = $streamingController->displayEpisodes($show, $season);
        }
        elseif ($show) {
            $seasons = $streamingController->displaySeasons($show);
        }
        else {
            $shows = $streamingController->displayShows();
        }

        include('views/streaming.php');
    }

}


?>