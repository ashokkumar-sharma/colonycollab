<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }

if($_POST['submit']){

    $title = $_POST['title'];
    $des = $_POST['description'];
    $team = $_POST['team_limit'];

        $sql = "INSERT INTO project (proj_id, title, description, team_limit, author)
        VALUES (NULL, '$title', '$des', '$team', '$user')";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    header("Location: home.php");
}
 ?>
<!DOCTYPE html>
<head>
    <title><?php echo $loggedInUser->username." - Rendezvous"; ?></title>
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

    </style>
</head>
<body>
    <body class="subpage">

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="index.html" class="logo">Rendezvous</a>
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

      <center><h2>Fill out the following details: </h2><form method="post" action="index.php">
        <div class="6u$ 12u$(xsmall)">
          <input type="text" name="title" placeholder="Enter your title" /><hr />
          <textarea type="text" name="description" placeholder="des here"></textarea><br /><br />
          <select name="team_limit">
              <option value="">- Choose no of team m -</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
          </select><br/>
          <input type="submit" value="submit" name="submit"/>
        </div>
      </form></center>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
      <script src="assets/js/reg.js"></script>
</body>
</html>
