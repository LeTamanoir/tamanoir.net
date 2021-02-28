<?php

namespace models;
use models\connectionDB;

class notificationModel
{

    public function getNews () {
        $connection = new connectionDB();
        $conn = $connection->connection();
        $request = $conn->query("SELECT * FROM `videos` ORDER BY `id` DESC LIMIT 6");
        $news = $request->fetchAll();
        return $news;
    }
}