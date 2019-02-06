<?php
//Filename: query.php
//Author: Danqing Zhao

    try{
        $dsn = "mysql:host=localhost;dbname=dzhao";
        $name = 'root';
        $password = 'root';
        $start = $_GET['start'];
        $num = $_GET['num'];
        $pdo = new PDO($dsn, $name, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT username, register_time, upload_file FROM application_users 
                  WHERE user_type = 'user' AND upload_file IS NOT NULL ORDER BY register_time DESC LIMIT $start, $num;";

        $stmt = $pdo->query($query);
        $rows = $stmt->fetchAll();
        ?><table>
        <tr><th>Username</th><th>Date</th><th>File</th></tr><?php
        foreach ($rows as $key => $value) {
            ?><tr>
                <td><?=$value['username']?></td>
                <td><?=$value['register_time']?></td>
                <td><a href="/dzhao/final_project/files/<?=$value['username'].'/'.$value['upload_file']?>"
                       download="<?=$value['upload_file']?>"><?=$value['upload_file']?></td>
            </tr><?php
        }
        ?></table><?php

    }catch(PDOException $e){
        echo "error: ".$e;
    }