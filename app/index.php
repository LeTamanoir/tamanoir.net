<!DOCTYPE html>
<html lang="en" class="light">
<?php include("views/head.html"); ?>
<body>
<?php
require("autoloader.php");
session_start();

autoloader::register();

use controllers\connectionController;
use controllers\pageController;

$page = new pageController();
$page->navbar($_GET['page']);

if (empty($_SESSION)) {
    switch ($_GET['page']) {
        case "Login":
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $connectionControlleur = new connectionController();
                $info = $connectionControlleur->login($_POST['username'],$_POST['password']);
                if ($info === true) {
                    header('Location: ?page=Home');
                }
                else {
                    include('views/connection.php');
                }
            }
            else {
                include('views/connection.php');
            }
            break;
        case "Register":
            $connectionControlleur = new connectionController();
            if (!empty($_POST)) {
                $info = $connectionControlleur->register($_POST);
            }
            include('views/register.php');
            break;
        default;
            header('Location: ?page=Login');
    }
}
else {
    $userName = $_SESSION['username'];
    $userEmail = $_SESSION['email'];
    $userRole = $_SESSION['role'];
    $userTrust = $_SESSION['trust'];
    $userID = $_SESSION['id'];

    switch ($_GET['page']) {
        case "Home":
            $page->home($userName,$userEmail,$userTrust);
            break;
        case "Inbox":
            if (!empty($_GET['discussion'])) {
                $page->inbox($_GET['discussion'],$userID);
            }
            else {
                $page->inbox(null,$userID);
            }
            break;
        case "Streaming":
            if (empty($_GET['show']) && empty($_GET['season'])) {
                $page->streaming(null,null,$userTrust, $userID);
            }
            elseif (!empty($_GET['show']) && empty($_GET['season'])) {
                $page->streaming($_GET['show'],null,$userTrust, $userID);
            }
            elseif (!empty($_GET['show']) && !empty($_GET['season'])) {
                $page->streaming($_GET['show'],$_GET['season'],$userTrust, $userID);
            }
            break;
        case "Logout":
            session_destroy();
            header('Location: /tamanoir/index.html');
            break;
        default:
            header('Location: ?page=Home');
    }
}
?>
</body>
</html>