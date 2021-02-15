<?php
require("autoloader.php");
session_start();

autoloader::register();

use controllers\messageController;

if (!empty($_SESSION)) {
    $userName = $_SESSION['username'];
    $userEmail = $_SESSION['email'];
    $userRole = $_SESSION['role'];
    $userTrust = $_SESSION['trust'];
    $userID = $_SESSION['id'];


    $messageController = new messageController();
   
    if (!empty($_GET['discussion'])) {
        switch ($_GET['discussion']) {
            case "all":
                $discussions = $messageController->displayDiscussions($userID);
                echo json_encode($discussions);
                break;
            default:
                if (!empty($_GET['delete'])) {
                    $messageController->deleteMessage($_GET['delete'],$userID);
                }
                elseif (!empty($_GET['send'])) {
                    $messageController->sendMessage($_GET['discussion'],$_GET['send'],$userID);
                }
                else {
                    $discussion = $messageController->displayDiscussion($_GET['discussion']);
                    echo json_encode($discussion);
                }
        }
    }
}
?>