<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
if(!isUserLoggedIn){ header("Location: login.php"); die();}
$from = $_SESSION["from"];
$prid = $_SESSION["prid"];

$sql = "DELETE FROM send_request WHERE from_user='$from'";

        if ($mysqli->query($sql) === TRUE) {
            echo "Rejected";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        header("Location: account.php");
?>
