<?php
    session_start();
    error_reporting(E_ALL & ~E_NOTICE);
    date_default_timezone_set("Africa/Lagos"); 

    $url = $_GET['url'];
    $url = rtrim($url, '/');
    $url = explode('/', $url);

    if($url[0] == ""){
        include('login.php');
    }

    $filePath = $url[0];

    if(file_exists("views/$filePath/" . $url[1] . '.php')){
        $page = "views/$filePath/" . $url[1] . '.php';
        include('main.php');
    }
    elseif(!file_exists("views/$filePath/" . $url[1] . '.php') && $url[0] != "") {
        include("login.php");
    }
?>
    