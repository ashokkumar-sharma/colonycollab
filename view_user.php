<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }
$id = $_GET['id'];

$user_id = $id;
$sql="SELECT * FROM group_users WHERE proj_id='$proj_id'";
$mysqli_result = mysqli_query($mysqli, $sql);
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


     ?>

   <!-- Scripts -->
     <script src="assets/js/jquery.min.js"></script>
     <script src="assets/js/skel.min.js"></script>
     <script src="assets/js/util.js"></script>
     <script src="assets/js/main.js"></script>
      <script src="assets/js/reg.js"></script>
</body>
</html>
