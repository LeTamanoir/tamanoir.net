<?php

namespace controllers;
use models\notificationModel;

class notificationController
{
    public function displayNews () {
        $notificationModel = new notificationModel();
        $news = $notificationModel->getNews();
        return $news;
    }
} 