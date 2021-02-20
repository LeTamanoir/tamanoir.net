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

    public function saveLastVideo ($show, $season, $episode, $time, $userID) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("INSERT INTO `videos_last` (`user_id`, `show`, `season`, `episode`, `time`) VALUES (?,?,?,?,?)");
        $request->execute([$userID, "$show", "$season", $episode, $time]);
    }

    public function getLastVideos ($userID) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("SELECT DISTINCT `season`,`show`,`episode`,`time` FROM `videos_last` WHERE `user_id` = ?");
        $request->execute([$userID]);
        $last = $request->fetchAll();
        return $last;
    }

    public function delLastVideo ($show, $season, $episode, $userID) {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->prepare("DELETE FROM `videos_last` WHERE `user_id` = ? AND `show` = ? AND `season` = ? AND `episode` = ?");
        $request->execute([$userID, $show, $season, $episode]);
    }
}
