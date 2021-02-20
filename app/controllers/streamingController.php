<?php 

namespace controllers;
use models\streamingModel;

class streamingController
{
    public function displayShows () {
        $streamingModel = new streamingModel();
        $shows = $streamingModel->getShows();
        return $shows;
    }
    
    public function displaySeasons ($show) {
        $streamingModel = new streamingModel();
        $seasons = $streamingModel->getSeasons($show);
        return $seasons;
    }
    
    public function displayEpisodes ($show, $season) {
        $streamingModel = new streamingModel();
        $episodes = $streamingModel->getEpisodes($show, $season);
        return $episodes;
    }

    public function saveLastVideo ($show, $season, $episode, $time, $userID) {
        $streamingModel = new streamingModel();
        $streamingModel->saveLastVideo($show, $season, $episode, $time, $userID);
    }

    public function displayLastVideos ($userID) {
        $streamingModel = new streamingModel();
        $last = $streamingModel->getLastVideos($userID);
        return $last;
    }

    public function delLastVideo ($show, $season, $episode, $userID) {
        $streamingModel = new streamingModel();
        $streamingModel->delLastVideo($show, $season, $episode, $userID);
    }
}