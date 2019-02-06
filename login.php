<?php

//Filename: login.php
//Author: Danqing Zhao


try {
    $username = $_GET['username'];
    $password = $_GET['password'];
    $dsn = "mysql:host=localhost;dbname=dzhao";

    $pdo = new PDO($dsn, "root", "root");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "select * from application_users where username = '" . $username . "'";
    $stmt = $pdo->query($query);
    $row = $stmt->fetch();
    if ($row['user_password'] == $password) {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        echo $row['user_type'];

    } else {
        echo "Failed: Wrong Username and Password Combination";
    }

}catch(Exception $e){
    echo $e;
}

