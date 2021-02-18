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
}