<?php 
    include("config/dblink.php");
    $connect = new DB();
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <base href="http://localhost/charity-donation-php/"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="School Management Application">
    <meta name="author" content="">

    <!-- <title>I Hope In Christ</title> -->

    <script src="https://js.paystack.co/v1/inline.js"></script> 

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="assets/logo.ico">
    <script src="vendor/sweetalert/sweetalert.min.js"></script>
                <style>
                    .backBtn{
                        border:1px solid #d87f00;
                        color:#101820ff;
                        border-radius:50px;
                        padding: 10px 15px;
                        transition: all ease-in-out 0.3s;
                    }
                    .backBtn:hover{
                        background:#101820ff;
                        border:none;
                        color:#fff;
                    }
                    .table-bordered > tbody > tr > td,
                    .table-bordered > thead > tr > td,
                    .table-bordered {
                        border-left: 0;
                        border-right: 0;
}
                </style>
</head>
<body id="page-top">

    

        

