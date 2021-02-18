<?php

namespace models;
use models\connectionDB;

class streamingModel
{
    public function getShows () {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->query("SELECT DISTINCT `show` FROM `videos`");
        $shows = $request->fetchAll();
        return $shows;
    }
    
    public function getSeasons ($show) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("SELECT DISTINCT season FROM videos WHERE `show` = ?");
        $request->execute([$show]);
        $seasons = $request->fetchAll();
        return $seasons;
    }
    
    public function getEpisodes ($show, $season) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("SELECT * FROM videos WHERE `show` = ? AND `season` = ?");
        $request->execute([$show,$season]);
        $episodes = $request->fetchAll();
        return $episodes;
    }
}
