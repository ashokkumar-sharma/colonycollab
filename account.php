<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

$target_dir = "documents/".$loggedInUser->username."/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
if($_POST['submit']){

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {

        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

}
$dirname = $target_dir;
$images = glob($dirname."*.jpg");

foreach($images as $image) {
    echo '<center><img id="acc_p" src="'.$image.'" /></center><br />';
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
        #ip{
          width: 400px;
          margin-top: 20px;
          margin-bottom: 20px;
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

        <div>

          <center><form action="account.php" method="post" enctype="multipart/form-data">
    Upload your image:
    <input type="file" name="fileToUpload" id="fileToUpload">

    <input type="submit" value="Upload Image" name="submit">
</form>
<h2>Username: <?php echo " ".$loggedInUser->username; ?></h2>
<h2>Email: <?php echo " ".$loggedInUser->email; ?></h2>
</center>
 </div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
      <script src="assets/js/reg.js"></script>
</body>
</html>
