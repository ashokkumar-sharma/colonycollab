<?php
error_reporting(E_ALL ^ E_NOTICE);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iiit_a";
GLOBAL $conn;
// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
if (!securePage($_SERVER['PHP_SELF'])){die();}
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }

    function callButton($proj_id, $from_user, $conn){
            $id = $proj_id;
            $from = $from_user;
            echo $id;
            echo $from;
            $sql = "SELECT * FROM send_request WHERE proj_id='$id' AND from_user='$from'";
            $mysqli_result = mysqli_query($conn, $sql);
                    while($rows = mysqli_fetch_assoc($mysqli_result)){
                  $sent = $rows['sent'];
                  echo $sent;
                  if($sent == '1'){
                    echo "<center><input class='special button' type='submit' value='Already Requested' name='join_event'></center><br />";
                  }
                  else{
                    echo "<form action='view_project.php?id=".$proj_id."' method='post'><center><input class='special button' type='submit' value='JOIN GROUP +' name='join_event'></center></form><br />";
                  }
                }
      }
 ?>
