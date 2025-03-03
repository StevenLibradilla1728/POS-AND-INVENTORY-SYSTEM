<?php
require '../config/function.php';
require 'authentication.php';
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>POS SYSTEM</title>
        <link rel="icon" type="image/png" href="https://posbargains.com/wp-content/uploads/2023/06/cropped-pos_favicon.png" sizes="40x35">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="assets/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>
        <link rel="stylesheet" href="assets/css/custom.css">
    </head>
<style>
    .hover-text-white:hover {
        color: black;
    }

    .hover-shadow-none:hover { 
        box-shadow: none;
        background: #E9F5EE;
     /*   transform: scale(1.05);
        transition: all 0.4s ease; */
    }

    .container-fluid {
        background: #fff;
    }

    .card {
        border-radius: 18px;
        border: 0px;
        background: #fff;
    }

    table {
        background: #fff;
    }
    /*
    .btn-primary {
        background: #fff;
        color: black;
        border: 1px solid black;
    }

    .btn-primary:hover {
        background: #0d6efd;
        color: white;
        border-style: none; 
    }

    .btn-success {
        background: #198754;
        color: white;
        border: 1px solid #00BD79;
    }*/

    .btn-success {
        background: #00BD79;
        color: white;
        border: 1px solid #00BD79;
    }
    
    .btn-success:hover {
        background: #00A96A;
        color: white; 
    }

    .bg-success {
        background: #00BD79;
        color: white;
    }

    .bg-success:hover {
        background: #00A96A;
        color: white;
    }

    .btn-outline-success {
        background: white;
    }

    .btn-outline-success:hover {
        background: #00BD79;
        color: white;
    }
    /*
    .btn-danger {
        background: #fff;
        color: black;
        border: 1px solid black;
    }

    .btn-danger:hover {
        background: #dc3545;
        color: white;
        border-style: none; 
    }*/
    /* 
    #layoutSidenav_nav {
        width: 5rem !important;
        height: 100% !important;
        background: blueviolet;
    }*/

</style>
    <body class="sb-nav-fixed">

    <?php include('navbar.php'); ?>

    <div id="layoutSidenav">
    
    <?php include('sidebar.php'); ?>

    <div id="layoutSidenav_content">
    <main>