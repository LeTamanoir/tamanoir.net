<?php

echo "<pre>";

print_r($_GET);

echo "</pre>";





switch ($_GET['controller']) {
    case "login":
        print_r($_GET);
        

        break;
    case "register":
        print_r($_GET);


        break;
}