<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }
$sql="SELECT * FROM project";
$mysqli_result = mysqli_query($mysqli, $sql);


 ?>
 <!DOCTYPE html>
 <head>
     <title><?php echo $loggedInUser->username." - ColonyCollab"; ?></title>
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
           margin-left: 12px;
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
       a{
         text-decoration: none;
       }
         .row1{

           overflow: hidden;
           margin-left: 49px;
           border-radius: 8px;
           display: block;
           margin-top: 10px;
           width: 92%;
           height: auto;
           background-color: #dadcf4;
         }
     </style>
 </head>
 <body>
     <body class="subpage">

 		<!-- Header -->
 			<header id="header">
 				<div class="inner">
 					<a href="index.php" class="logo">ColonyCollab</a>
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

      	<section id="banner1">
        <?php
            while($rows = mysqli_fetch_assoc($mysqli_result)){
              $event_type = $rows['event_type'];
              $proj_id = $rows['proj_id'];
              $title = $rows['title'];
              $description = $rows['description'];
              $team_limit   = $rows['team_limit'];
              $author = $rows['author'];

              if (strlen($description) > 80)
                $description = substr($description, 0, 68) . '...';

      echo "<a href='view_project.php?id=".$proj_id."'><div class='row1'>";
              $_SESSION["proj_id"] = $proj_id;
         echo "<font class='title'>".$title."</font><br />";
              echo "<font class='des'>".$description."</font><br />";
              echo "<font class='tm'>Max number of team members: ".$team_limit."</font><br />";
              echo "<font class='author'>Created by : ".$author."</font><br />";

      echo '</div></a>';
    }
      ?>
    </sectionx>
 		<!-- Scripts -->
 			<script src="assets/js/jquery.min.js"></script>
 			<script src="assets/js/skel.min.js"></script>
 			<script src="assets/js/util.js"></script>
 			<script src="assets/js/main.js"></script>
       <script src="assets/js/reg.js"></script>
 </body>
 </html>
