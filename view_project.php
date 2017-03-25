<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }
$id = $_GET['id'];

$proj_id = $id;
$sql="SELECT * FROM project WHERE proj_id='$proj_id'";
$mysqli_result = mysqli_query($mysqli, $sql);
//retrieve to_id


 ?>
<!DOCTYPE html>
<head>
    <title><?php echo $loggedInUser->username." - Colony"; ?></title>
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <style>
      #acc_p{
        align-items: center;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background-color: grey;
        margin-left: 85px;
        margin-top: 20px;

      }
        #regbox{
            margin-top: 100px;
        }
        #error{
            padding-top: 25px;
            text-align: center;
            color: red;
            overflow: hidden;
        }
         body{
            color: #000;
        }
        #error li{
            list-style: none;
        }
        h2{
            padding-left: 20px;
        }
        form{
          margin-top: 20px;
        }
        .title{
          text-align: center;
          color:#031d74;
          font-size: 35px;
          font-weight: 800;
      }
            .des{
              color:#315b9a;
              margin-left: 15px;

              font-size:18px
          }
            .tm{
              margin-left: 15px;
              color:#3c4869;
              font-size:15px
          }
          .author{
           color: #290587;
            margin-left: 22px;

            font-size:15px
        }

        .row1{

          text-align: center;
          margin-left: 49px;
          border-radius: 8px;
          display: block;
          margin-top: 10px;
          width: 92%;
          height: auto;

        }
        .title input{
          font-size: 10px;
          padding-bottom: -10px;
          margin-top: 30px;
        }

    </style>
</head>
<body>
    <body class="subpage">

   <!-- Header -->
     <header id="header">
       <div class="inner">
         <a href="index.php" class="logo">Colony</a>
         <nav id="nav">
            <a href="home.php">Home</a>
            <a href="add_event.php">Add a event</a>
           <a href="account.php"><?php echo $loggedInUser->username; ?></a>
           <a href="user_settings.php">Update Profile</a>

           <a href="logout.php">Logout</a>
         </nav>
         <a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
       </div>
     </header>

       <?php


          while($rows = mysqli_fetch_assoc($mysqli_result)){
            $event_type = $rows['event_type'];
            $proj_id = $rows['proj_id'];
            $title = $rows['title'];
            $description = $rows['description'];
            $team_limit   = $rows['team_limit'];
            $author = $rows['author'];

            echo "<div class='row1'>";
              echo "<font class='title'>".$title."<br />";

              echo "<font class='des'>"."Description: ".$description."<br />";
              echo "<font class='even'>"."Event type : ".$event_type."<br />";
              //$proj = explode("0",$proj_id);
              $sql2="SELECT * FROM team_mem WHERE proj_id='$proj_id'";
              $mysqli_result = mysqli_query($mysqli, $sql2);
              echo "<font class='tm'>"."Team Members: </font>";
              while($rows = mysqli_fetch_assoc($mysqli_result)){
                $mem = $rows['mem1'];
              echo "<a href='view_user.php?id=".$loggedInUser->user_id."'>".$mem.",</a>";
            }
              echo "<br /><font class='author'>"."Event created by : ".$author."<br />";

              echo "<form action='view_project.php?id=".$proj_id."' method='post'><center><input onclick='this.disabled=TRUE' class='special button' type='submit' value='JOIN GROUP +' name='join_event'></center></form><br />";

              echo "</div>";
        }
        $sql12 = "SELECT * FROM group_users WHERE user_name='$author'";
        $result = mysqli_query($mysqli, $sql12);

            while($rows = mysqli_fetch_assoc($result)){
              $to_id = $rows["id"];
            }
        if($_POST['join_event']){
            $sql = "INSERT INTO send_request (proj_id, from_id, from_user, to_id, to_user, sent, accepted, not_accepted)
            VALUES('$id', '$loggedInUser->user_id', '$loggedInUser->username', '$to_id', '$author', '1', '0', '0')";

                if ($mysqli->query($sql) === TRUE) {
                  // $sql123 = "SELECT * FROM send_request WHERE from_id='$loggedInUser->user_id'";
                  // $result123 = mysqli_query($mysqli, $sql123);
                  //
                  // // output data of each row
                  //     while($row = mysqli_fetch_assoc($result123)) {
                  //         $sent = $row['sent'];
                  //         echo $sent;
                  //     }

                  // if($sent == 1){
                  //   echo "Request sent to ".$author;
                  // }


                }
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
              //   $sql123 = "SELECT * FROM send_request WHERE from_id='$loggedInUser->user_id'";
              //   $result123 = mysqli_query($mysqli, $sql123);
              //   while($rows = mysqli_fetch_assoc($result123)){
              //     $sent = $rows["sent"];
              //     echo $sent;
              //   if($sent == '1'){
              //     echo "Request sent to ".$author;
              //   }
              //   else{
              //   echo "<form action='view_project.php?id=".$proj_id."' method='post'><center><input class='special button' type='submit' value='JOIN GROUP +' name='join_event'></center></form><br />";
              // }
              //
              // }

        }
        $new = "SELECT * FROM team_mem where proj_id='$id'";
        $result = mysqli_query($mysqli, $new);
        while($rows = mysqli_fetch_assoc($result)){
          $projid = $rows['proj_id'];
          $member = $rows['mem1'];

        }
        $new12 = "SELECT * FROM project where proj_id='$id'";
        $result = mysqli_query($mysqli, $new12);
        while($rows = mysqli_fetch_assoc($result)){
          $author2 = $rows['author'];

        }
        $_SESSION["proj_id"] = $projid;
        $_SESSION["mem"] = $member;
        $_SESSION["username"] = $loggedInUser->username;
        if($member == $loggedInUser->username || $author2 == $loggedInUser->username){
        echo '<center><iframe src="cha/index.php" width=80% height="700px"></iframe></center>';
      }
      else{
        echo "No access";
      }
     ?>



   <!-- Scripts -->
     <script src="assets/js/jquery.min.js"></script>
     <script src="assets/js/skel.min.js"></script>
     <script src="assets/js/util.js"></script>
     <script src="assets/js/main.js"></script>
      <script src="assets/js/reg.js"></script>

</body>
</html>
