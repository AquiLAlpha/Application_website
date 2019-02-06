<?php
//Filename: upload.php
//Author: Danqing Zhao

try {
    session_start();

    $username = $_SESSION["username"];
    $type = $_FILES["file"]["type"];
    $success = 0;
    if ($type == "application/pdf"
        || $type == "application/doc"
        || $type == "application/msword"
        || $type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
        if ($_FILES["file"]["error"] > 0) {
            $output = "Error: " . $_FILES["file"]["error"] . "<br />";
        }

        if (file_exists("upload/" . $_FILES["file"]["name"])) {
            $output = $_FILES["file"]["name"] . " File already exists. ";
        } else {
            if (!is_dir(realpath('.')."/files/$username/" )) {
                mkdir(realpath('.')."/files/$username/" );
            }
            move_uploaded_file($_FILES["file"]["tmp_name"], realpath('.')."/files/$username/" . $_FILES["file"]["name"]);
            $output .= "File stored in: " . realpath('.').'/files/'. $username . "/" . $_FILES["file"]["name"];
            $success = 1;
        }
    } else {
        $output = "Error: Please Enter a pdf or doc file.<br />";

    }

    if ($success == 1) {
        $dsn = "mysql:host=localhost;dbname=dzhao";
        $pdo = new PDO($dsn, "root", "root");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $update_sql = "UPDATE application_users SET upload_file = '" . $_FILES["file"]["name"] . "' WHERE username = '" . $username . "'";
        $pdo->exec($update_sql);
    }
}catch(Exception $e){
    $output = $e;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#avatsel1").click(function(){
                $("input[type='file']").trigger('click');
            });
            $("#avatval").click(function(){
                $("input[type='file']").trigger('click');
            });
            $("input[type='file']").change(function(){
                $("#avatval").val($(this).val());
            });
        });
    </script>
    <LINK REL=StyleSheet HREF="style.css" TYPE="text/css" MEDIA=screen>
    <title>Upload File</title>
</head>
<body>
<p>
    <a href="http://www.gcomtechnology.com/en/index.php">
        <img alt="home" src="logo.png" class="logo">
    </a>
</p>
<div class="container">
    <div class="login">
        <h1>Upload your Resume</h1>
        <form id="upload_form" action="upload.php" method="post"
              enctype="multipart/form-data">
            <div class="input-file">
                <input type="text" id="avatval" placeholder="Please select file" readonly="readonly" />
                <input type="file" name="file" id="file" />
                           
            </div>

            <br />
            <input type="submit" name="submit" value="Submit" />
        </form>
    </div>
    <span class = "msg">
        <?= $output ?>
    </span>
</div>

</body>
</html>