<?php
session_start();

$url = explode("/", $_SERVER["REQUEST_URI"]);
require_once("php/db.php");
require_once("php/classes/Users.php");
// echo $url;

if ($url[1] == "login") {
    $content = file_get_contents("pages/login.php");
} else if ($url[1] == "register") {
    $content = file_get_contents("pages/register.html");
} else if ($url[1] == "contact") {
    $content = file_get_contents("pages/contact.html");
} else if ($url[1] == "users") {
    require_once("pages/users/index.html");
} else if ($url[1] == "addUser") {
    echo User::addUser($_POST["name"], $_POST["lastname"], $_POST["email"], $_POST["pass"]);
} else if ($url[1] == "authUser") {
    echo User::authUser($_POST["email"], $_POST["pass"]);
} else if ($url[1] == "getUser") {
    echo User::getUser($_SESSION["id"]);
} else if ($url[1] == "getUsers") {
    echo User::getUsers();
} else {
    $content = file_get_contents("pages/index.php");
}

if (!empty($content)) require_once("template.php");










// $content = file_get_contents("pages/index.php");

// require_once("template.php");








// if ($url[1] =="login") {
//     require_once("login.php");
// }

// for ($i = 0; $i < count($url); $i++) {
// echo $url[$i] . "<hr>";
// }

// var_dump($url);
