<?php
namespace models; 
use \PDO;

class connectionDB 
{
    public function connection () {
        require("models/settings.php");
        $connectionDB = new PDO("mysql:host={$settings['DBaddr']};dbname={$settings['DBname']}", $settings['DBuser'], $settings['DBpass']);
        return $connectionDB;
    }
} 
?>