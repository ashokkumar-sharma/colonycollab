<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he/she is already logged in
if(isUserLoggedIn()) { header("Location: account.php"); die(); }

//Forms posted
if(!empty($_POST))
{
	$errors = array();
	$username = sanitize(trim($_POST["username"]));
	$password = trim($_POST["password"]);

	//Perform some validation
	//Feel free to edit / change as required
	if($username == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_USERNAME");
	}
	if($password == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
	}

	if(count($errors) == 0)
	{
		//A security note here, never tell the user which credential was incorrect
		if(!usernameExists($username))
		{
			$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
		}
		else
		{
			$userdetails = fetchUserDetails($username);
			//See if the user's account is activated
			if($userdetails["active"]==0)
			{
				$errors[] = lang("ACCOUNT_INACTIVE");
			}
			else
			{
				//Hash the password and use the salt from the database to compare the password.
				$entered_pass = generateHash($password,$userdetails["password"]);

				if($entered_pass != $userdetails["password"])
				{
					//Again, we know the password is at fault here, but lets not give away the combination incase of someone bruteforcing
					$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
				}
				else
				{
					//Passwords match! we're good to go'

					//Construct a new logged in user object
					//Transfer some db data to the session object
					$loggedInUser = new loggedInUser();
					$loggedInUser->email = $userdetails["email"];
					$loggedInUser->user_id = $userdetails["id"];
					$loggedInUser->hash_pw = $userdetails["password"];
					$loggedInUser->title = $userdetails["title"];
					$loggedInUser->displayname = $userdetails["display_name"];
					$loggedInUser->username = $userdetails["user_name"];

					//Update last sign in
					$loggedInUser->updateLastSignIn();
					$_SESSION["userCakeUser"] = $loggedInUser;

					//Redirect to user account page
					header("Location: account.php");
					die();
				}
			}
		}
	}
}

//require_once("models/header.php");


//include("left-nav.php");

echo "";

echo resultBlock($errors,$successes);

echo "
<div id='regbox'>
            <center><form name='login' action='".$_SERVER['PHP_SELF']."' method='post'>
            <h2>Login</h2>
            <p>
            <label>Username:</label>
            <div class='6u 12u$(xsmall) new1'>
            <input type='text' name='username' />
            </div>
            </p>
            <p>
            <label>Password:</label>
            <div class='6u 12u$(xsmall) new1'>
            <input type='password' name='password' />
            </div>
            </p>
            <h4><a href='forgot-password.php'>Forgot Password?</a></h4>
            <h4><a href='resend-activation.php'>Send email activation</a></h4>
            <p>
            <label>&nbsp;</label>
            <input type='submit' value='Login' class='submit button special' />

            </p>
            </form></center>
</div>
<div id='bottom'></div>";

?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Elements - Projection by TEMPLATED</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<style>
		#regbox{
				margin-top: 100px;
		}
		#error{
				padding-top: 25px;
				text-align: center;
				color: red;
				overflow: auto;

		}
		#error li{
				list-style: none;
				overflow: hidden;
		}
		body{
				color: #000;
				overflow: auto;
		}
		#success {
		 padding-top: 25px;
				text-align: center;
				color: green;
				overflow: hidden;
				list-style: none;
		}
		#success li{
		 list-style: none;
		}
		</style>
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="index.html" class="logo"><strong>Projection</strong> by TEMPLATED</a>
					<nav id="nav">
						<a href="index.html">Home</a>
						<a href="login.php">Login</a>
						<a href="register.php">Register</a>
					</nav>
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
				</div>
			</header>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="inner">


		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
