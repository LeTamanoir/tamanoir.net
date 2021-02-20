<?php
require("autoloader.php");
session_start();

autoloader::register();

use controllers\messageController;
use controllers\memberController;
use controllers\discussionController;
use controllers\usersController;
use controllers\streamingController;
use classes\videoStream;

if (!empty($_SESSION)) {
    $userName = $_SESSION['username'];
    $userEmail = $_SESSION['email'];
    $userRole = $_SESSION['role'];
    $userTrust = $_SESSION['trust'];
    $userID = $_SESSION['id'];

    $messageController = new messageController();
    $memberController = new memberController();
    $discussionController = new discussionController();

    if (!empty($_GET['discussion'])) {
        switch ($_GET['discussion']) {
            case "all":
                $discussions = $discussionController->displayDiscussions($userID);
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
                elseif (!empty($_GET['createDiscussion'])) {
                    $info = $discussionController->createDiscussion($_GET['createDiscussion'],$userID);
                    echo json_encode($info);
                }
                elseif (!empty($_GET['delDiscussion'])) {
                   $discussionController->delDiscussion($_GET['delDiscussion'],$userID);
                }
                else {
                    $discussion = $discussionController->displayDiscussion($_GET['discussion'],$userID);
                    echo json_encode($discussion);
                }
        }
    }

    if ($userTrust === "trusted") {
        if (!empty($_GET['show']) && !empty($_GET['season']) && !empty($_GET['episode']) && !empty($_GET['action'])) {
            if ($_GET['action'] === 'watch') {
                $videoStream = new videoStream("/var/www/Videos/{$_GET['show']}/{$_GET['season']}/{$_GET['episode']}.mp4");
                $videoStream->start();
            }
            elseif ($_GET['action'] === 'save') {
                $streamingController = new streamingController();
                $streamingController->saveLastVideo($_GET['show'], $_GET['season'], $_GET['episode'], $_GET['time'], $userID);
            }
            elseif ($_GET['action'] === 'delete') {
                $streamingController = new streamingController();
                $streamingController->delLastVideo($_GET['show'], $_GET['season'], $_GET['episode'], $userID);
            }
        }
    }
}
else {
    if (!empty($_GET['username']) && !empty($_GET['password']) && !empty($_GET['action'])) {
        $usersController = new usersController();

        switch ($_GET['action']) {
            case "confirm":
                $check = $usersController->verifyUser($_GET['username'],$_GET['password']);
                if ($check) {
                    $usersController->confirmUser($_GET['username']);
                    header('Location: /tamanoir/app/index.php?page=Login');
                }
                break;
            case "reject":
                $usersController->rejectUser($_GET['username'],$_GET['password']);
                header('Location: /tamanoir/index.html');
                break;
        }
    }
}
?>