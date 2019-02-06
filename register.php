<?php
/*Filename: register.php
 *Author: Danqing Zhao
 */

    try{

        $username = $_GET['username'];
        $email = $_GET['email'];
        $password = $_GET['password'];
        $date = date("y-m-d");

        $dsn = "mysql:host=localhost;dbname=dzhao";
        $pdo = new PDO($dsn, "root", "root");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $username_query = "SELECT * FROM application_users WHERE username = '$username';";
        $email_query = "SELECT * FROM application_users WHERE email = '$email';";
        $check1 = $pdo->query($username_query);
        $check2 = $pdo->query($email_query);
        if(sizeof($check1->fetchAll())>0){
            die("Failed: Username Occupied") ;
        }
        if(sizeof($check2->fetchAll())>0){
            die("Failed: Email Address Used");
        }
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;
        $insert = "INSERT INTO application_users (register_time, username, email, user_password, user_type, upload_file) VALUE 
                ('$date', '$username', '$email', '$password', 'user', null);";
        $pdo->exec($insert);
        echo "Success";
    }catch(PDOException $e){
        echo $e;
    }
