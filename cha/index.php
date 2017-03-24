<?php
session_start();
 $projid = $_SESSION["proj_id"];
$member = $_SESSION["mem"];
$author = $_SESSION["username"];
//echo $member;
//require_once("../models/config.php");
require_once dirname(__FILE__)."/src/phpfreechat.class.php";
$params = array();
$params["title"] = "Colony Collab";

$params["nick"] = $author;   // setup the intitial nickname
$params['firstisadmin'] = true;
//$params["isadmin"] = true; // makes everybody admin: do not use it on production servers ;)
$params["serverid"] = md5(__FILE__).$projid;; // calculate a unique id for this chat
$params["debug"] = false;
$chat = new phpFreeChat( $params );

?>
<!DOCTYPE html">
<html>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>$proj_title</title>

 </head>
 <body>

<div class="content">
  <?php $chat->printChat(); ?>
  <?php if (isset($params["isadmin"]) && $params["isadmin"]) { ?>
    <p style="color:red;font-weight:bold;">Warning: because of "isadmin" parameter, everybody is admin. Please modify this script before using it on production servers !</p>
  <?php } ?>
</div>

</body></html>
