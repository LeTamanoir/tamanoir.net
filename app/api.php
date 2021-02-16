<?php
require("autoloader.php");
session_start();

autoloader::register();

use controllers\messageController;
use controllers\memberController;

if (!empty($_SESSION)) {
    $userName = $_SESSION['username'];
    $userEmail = $_SESSION['email'];
    $userRole = $_SESSION['role'];
    $userTrust = $_SESSION['trust'];
    $userID = $_SESSION['id'];

    $messageController = new messageController();
    $memberController = new memberController();

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
                    $messageController->sendMessage($_GET['discussion'],strip_tags($_GET['send']),$userID);
                }
                elseif (!empty($_GET['members'])) {
                    $members = $memberController->displayMembers($_GET['discussion'],$userID);
                    echo json_encode($members);
                }
                elseif (!empty($_GET['addMember'])) {
                    $info = $memberController->addMember($_GET['discussion'],$_GET['addMember'],$userID);
                    echo json_encode($info);
                }
                elseif (!empty($_GET['delMember'])) {
                    $memberController->delMember($_GET['discussion'],$_GET['delMember'],$userID);
                }
                else {
                    $discussion = $messageController->displayDiscussion($_GET['discussion'],$userID);
                    echo json_encode($discussion);
                }
        }
    }
}
?>