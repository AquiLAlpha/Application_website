<?php
/**
 * Filename: logout.php.
 * User: Danqing Zhao
 * Date: 2019/1/31
 * Time: 18:23
 */

session_start();
session_destroy();
header("Location: login.html");
setcookie("username","",time()-3600);
setcookie("password","",time()-3600);