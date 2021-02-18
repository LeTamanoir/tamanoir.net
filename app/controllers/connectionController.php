<?php
namespace controllers;

use models\connectionModel;
use controllers\emailController;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'classes/PHPMailer/src/Exception.php';
require 'classes/PHPMailer/src/PHPMailer.php';
require 'classes/PHPMailer/src/SMTP.php';

class connectionController
{
    public function login ($username, $password)
    {
        $connectionModel = new connectionModel();
        $user = $connectionModel->checkUser($username,$password);
        if ($user) {
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['trust'] = $user['trust'];
            $_SESSION['id'] = $user['id'];
            return true;
        }
        else {
            return false;
        }
    }

    public function register ($post) {
        require('models/settings.php');
        

        $connectionModel = new connectionModel();
        $emailController = new emailController();

        if (!empty($post['confirm-email']) && !empty($post['email']) && !empty($post['username']) && !empty($post['password']) && !empty($post['confirm-password'])) {
            $checkUsername = $connectionModel->checkUsername($post['username']);
            if ($checkUsername) {
                return "username already taken";
            }
            elseif ($post['email'] !== $post['confirm-email']) {
                return "make sure both email addresses are identical";
            }
            
            $checkEmail = $connectionModel->checkEmail($post['email']);
            if ($checkEmail) {
                return "email already taken";
            }
            elseif ($post['password'] !== $post['confirm-password']) {
                return "make sure both passwords are identical";
            }
            // elseif (strlen($post['username']) <= 12 && strlen($post['username']) >= 4 || strlen($post['password']) <= 12 && strlen($post['password']) >= 4) {
            //     return "username and password must be between 4 and 12 characters long";
            // }
            else {
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPSecure = "ssl";
                $mail->Port = 465;
                $mail->SMTPAuth = true;
                $mail->Username = $settings['EMuser'];
                $mail->Password = $settings['EMpass'];
                $mail->setFrom($settings['EMuser'], 'support.tamanoir.net');
                $mail->IsHTML(true);
                $mail->CharSet="utf-8";
                $mail->addAddress($_POST['email']);
                $mail->Subject = "confirm your email";
                $mail->MsgHTML($emailController->register($_POST['email'],$_POST['username'],$_POST['password']));
                
                // return $mail;
                
                if ($mail->send()) {
                    $connectionModel->addUser($_POST['username'],$_POST['email'],md5($_POST['password']),'user');
                    header('Location: ?page=Login');
                }
                
                else {
                    return "unknown error";
                }
            }
        }
        else {
            return "please complete all fields";
        }
    }
}