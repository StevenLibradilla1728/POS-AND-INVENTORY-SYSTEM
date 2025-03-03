<?php

require 'config/function.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POS AND INVENTORY SYSTEM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <style>
    /* Change the border color of the input fields */
    input.form-control {
        border: 2px solid #ccc;  /* Default border color */
        transition: border-color 0.3s ease, box-shadow 0.3s ease;  /* Smooth transition */
    }

    /* Change the border and box-shadow when the input field is focused */
    input.form-control:focus {
        /* Border color on focus */
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);  /* Blue shadow on focus */
        outline: none;  /* Remove the default outline */
    }
</style>

  <body>

      <?php include('navbar.php'); ?>