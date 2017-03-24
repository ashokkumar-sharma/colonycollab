<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
if(!isUserLoggedIn){ header("Location: login.php"); die();}
$from = $_SESSION["from"];
$prid = $_SESSION["prid"];


$sql = "UPDATE send_request
        SET accepted='1' WHERE from_user='$from'";

        if ($mysqli->query($sql) === TRUE) {
            echo "";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

$sql1 = "INSERT INTO team_mem (proj_id, mem1, mem2, mem3, mem4, mem5)
        VALUES('$prid', NULL , NULL, NULL, NULL, NULL)";
        if ($mysqli->query($sql1) === TRUE) {
            echo "";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $counter = 1;
        $mem = "mem".$counter;
      $sql2 = "UPDATE team_mem
              SET $mem='$from' WHERE proj_id='$prid' AND mem1='NULL'";
              if ($mysqli->query($sql2) === TRUE) {
                  echo "Added to group.";
              } else {
                  echo "Error: " . $sql . "<br>" . $conn->error;
              }
              $counter++;
              header("Location: account.php");
?>
