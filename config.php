<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $db_name = "db_jhacosmetics";

    $conn= mysqli_connect($server, $user, $password, $db_name);

    if (!$conn){
        die("Gagal tersambung ke database : " .mysqli_connect_error());
    }

?>