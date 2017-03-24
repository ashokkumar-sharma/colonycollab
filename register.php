<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he/she is already logged in
if(isUserLoggedIn()) { header("Location: account.php"); die(); }

//Forms posted
if(!empty($_POST))
{
	$errors = array();
	$email = trim($_POST["email"]);
	$username = trim($_POST["username"]);
	$displayname = "User".rand(1, 10000);
	$password = trim($_POST["password"]);
	$confirm_pass = trim($_POST["passwordc"]);
	$captcha = md5($_POST["captcha"]);


	if ($captcha != $_SESSION['captcha'])
	{
		$errors[] = lang("CAPTCHA_FAIL");
	}
	if(minMaxRange(5,25,$username))
	{
		$errors[] = lang("ACCOUNT_USER_CHAR_LIMIT",array(5,25));
	}
	if(!ctype_alnum($username)){
		$errors[] = lang("ACCOUNT_USER_INVALID_CHARACTERS");
	}
//	if(minMaxRange(5,25,$displayname))
//	{
//		$errors[] = lang("ACCOUNT_DISPLAY_CHAR_LIMIT",array(5,25));
//	}
//	if(!ctype_alnum($displayname)){
//		$errors[] = lang("ACCOUNT_DISPLAY_INVALID_CHARACTERS");
//	}
	if(minMaxRange(8,50,$password) && minMaxRange(8,50,$confirm_pass))
	{
		$errors[] = lang("ACCOUNT_PASS_CHAR_LIMIT",array(8,50));
	}
	else if($password != $confirm_pass)
	{
		$errors[] = lang("ACCOUNT_PASS_MISMATCH");
	}
	if(!isValidEmail($email))
	{
		$errors[] = lang("ACCOUNT_INVALID_EMAIL");
	}
	//End data validation
	if(count($errors) == 0)
	{
		//Construct a user object
		$user = new User($username,$displayname,$password,$email);

		//Checking this flag tells us whether there were any errors such as possible data duplication occured
		if(!$user->status)
		{
			if($user->username_taken) $errors[] = lang("ACCOUNT_USERNAME_IN_USE",array($username));
			if($user->displayname_taken) $errors[] = lang("ACCOUNT_DISPLAYNAME_IN_USE",array($displayname));
			if($user->email_taken) 	  $errors[] = lang("ACCOUNT_EMAIL_IN_USE",array($email));
		}
		else
		{
			//Attempt to add the user to the database, carry out finishing  tasks like emailing the user (if required)
			if(!$user->userCakeAddUser())
			{
				if($user->mail_failure) $errors[] = lang("MAIL_ERROR");
				if($user->sql_failure)  $errors[] = lang("SQL_ERROR");
			}
		}
	}
	if(count($errors) == 0) {
		$successes[] = $user->success;
	}
}

//require_once("models/header.php");
//include("left-nav.php");
echo "<div id='main'></div>";

echo resultBlock($errors,$successes);

echo "
<div id='regbox'>
<center><form name='newUser' action='".$_SERVER['PHP_SELF']."' method='post'>

<p>
<div class='6u 12u$(xsmall) new1'>
<label>User Name:</label>
<input type='text' name='username' />
</p>
<p>
<label>Password:</label>
<input type='password' name='password' />
</p>
<p>
<label>Confirm:</label>
<input type='password' name='passwordc' />
</p>
<p>
<label>Email:</label>
<input type='text' name='email' />
</p>
<p>
<label>Security Code:</label>
<img src='models/captcha.php'>
</p>
<label>Enter Security Code:</label>
<input name='captcha' type='text'>
</p>
<label>&nbsp;<br>
<input class='button special' type='submit' value='Register'/>
</div>
</p>

</form></center>
</div>

</div>
<div id='bottom'></div>
</div>
</body>
</html>";
?>
<!doctype html>
<head>
    <title>Login - Rendezvous</title>
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <style>
        #regbox{
            margin-top: 100px;
        }
        #error{
            padding-top: 25px;
            text-align: center;
            color: red;
            overflow: hidden;

        }
        #error li{
            list-style: none;
        }
        body{
            color: #000;
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
<body>
    <body class="subpage">

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="index.html" class="logo">Rendezvous</a>
					<nav id="nav">
						<a href="index.php">Home</a>
						<a href="login.php">Login</a>
						<a href="register.php">Register</a>
					</nav>
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
				</div>
			</header>
            <div id='main'></div>
        

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
            <script src="assets/js/reg.js"></script>
</body>
</html>
