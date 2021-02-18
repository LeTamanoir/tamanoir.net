<?php
namespace controllers;

class emailController
{
    public function register ($email,$username,$password) {
        return <<<HTML
<h1 style="text-align: center;">Welcome $username</h1>
<p style="font-size: 1.4em;text-align: center;">Please make sure that the <span style="color:#3d5270">email</span> and <span style="color:#048aff">username</span> are correct.</p>
<table style="border-radius: 4px;background-color: #bbcfcf;margin: auto;">
  <tr>
    <td style="background-color: #3d5270;border-radius: 4px;font-size: 1.1em;padding: 15px;word-break: break-all;"><b><span style="color:white">email :</span></b></td>
    <td style="border-radius: 4px;font-size: 1.1em;padding: 15px;word-break: break-all;background-color: white;">$email</td>
  </tr>
  <tr>
    <td style="background-color: #048aff;border-radius: 4px;font-size: 1.1em;padding: 15px;word-break: break-all;"><b><span style="color:white">username :</span></b></td>
    <td style="border-radius: 4px;font-size: 1.1em;padding: 15px;word-break: break-all;background-color: white;">$username</td>
  </tr>
</table>
<div class="confirm" style="display: block;margin: 40px 0;text-align: center;box-sizing: border-box;">
    <a style="background-color: #3b8bd1;text-decoration: none;margin: 0 5px;padding: 5px;color: white;font-size: 1.5em;border-radius: 4px;" href="https://www.tamanoir.net/tamanoir.net/app/api.php?">Confirm</a>
    <a style="background-color: #DC493A;text-decoration: none;margin: 0 5px;padding: 5px;color: white;font-size: 1.5em;border-radius: 4px;" href="https://www.tamanoir.net/tamanoir.net/app/api.php?">Reject</a>
</div>
HTML;

    }

}