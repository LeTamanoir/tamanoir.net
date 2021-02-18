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
                $check = $connectionControlleur->login($_POST['username'],$_POST['password']);
                if ($check) {
                    header('Location: ?page=Home');
                }
                else {
                    $error = "password or username incorrect";
                    include('views/connection.php');
                }
            }
            else {
                include('views/connection.php');
            }
            break;
        case "Register":
            $connectionControlleur = new connectionController();
            $info = $connectionControlleur->register($_POST);
            if ($info) {
                var_dump($info);
            }
            else {
                include('views/register.php');
            }
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
            $page->home($userName,$userEmail);
    
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
                $page->streaming(null,null,$userTrust);
            }
            elseif (!empty($_GET['show']) && empty($_GET['season'])) {
                $page->streaming($_GET['show'],null,$userTrust);
            }
            elseif (!empty($_GET['show']) && !empty($_GET['season'])) {
                $page->streaming($_GET['show'],$_GET['season'],$userTrust);
            }
            break;
        case "Settings":
            break;
        case "Logout":
            session_destroy();
            header('Location: /tamanoir.net/index.html');
            break;
        default:
            header('Location: ?page=Home');
    }
}
?>
</body>
</html>