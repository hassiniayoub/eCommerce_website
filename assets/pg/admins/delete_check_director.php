<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WoneyMaroc | لوحة التحكم</title>
    <link rel="stylesheet" href="style">
</head>
<body>

<?php

require_once("inc/conn.inc.php");

session_start();

if (!$_SESSION["admin_user"]) {
    header("Location: admin");
}


$delete_check_director = $_GET["del_id"];


if($delete_check_director) {

    $sql = "SELECT * FROM admin_login WHERE admin_id='$delete_check_director'";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    if ($row["admin_user"] === $_SESSION["admin_user"]) {
        ?>

        <h1 style="text-align: center; margin-top: 100px;">هل انت احمق أتريد ان تمسح نفسك!؟</h1>
        <h2 style="text-align: center; margin-top: 50px;">
            <a style="margin: 0 10px; color: white; background-color: #18BC9C; padding: 10px 15px; text-decoration: none;" href="director">العودة</a>
        </h2>


        <?php
    }
    else {
        header("Location: del_director?del_id=" . $delete_check_director);
    }

}
else {
    header("Location: admin");
}