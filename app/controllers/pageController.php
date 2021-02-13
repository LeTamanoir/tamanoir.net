<?php

namespace controllers;

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
   
}