<?php
session_start();
include "../db.php";
include "header.php";


if ($_SESSION['logged_in_user']) {
    if (!isset($_SESSION['id_user']) && isset($_SESSION['name']) != "") {

        header('location:../index.php');
        exit;
    }
} else {
    // User is already logged in, redirect to dashboard
    header('location:../index.php');
    exit;
}
