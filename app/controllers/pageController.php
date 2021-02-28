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

    public function home ($username,$useremail,$userTrust) {
        $notificationController = new notificationController();
        $news = $notificationController->displayNews();
        include('views/home.php');
    }

    public function inbox ($discussionID,$userID) {
        $discussionModel = new discussionModel();
        $discussionCreator = $discussionModel->getDiscussionCreator($discussionID);
        include('views/inbox.php');
    }

    public function streaming ($show, $season, $userTrust, $userID) {
        $streamingController = new streamingController();
        if ($show && $season) {
            $episodes = $streamingController->displayEpisodes($show, $season);
        }
        elseif ($show) {
            $seasons = $streamingController->displaySeasons($show);
        }
        else {
            $shows = $streamingController->displayShows();
            $displayLast = $streamingController->displayLastVideos($userID);
        }

        include('views/streaming.php');
    }

}


?>