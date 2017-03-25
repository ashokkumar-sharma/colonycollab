<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
	if(isUserLoggedIn()){ header("Location: account.php"); die();}
 ?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Colony collab</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="index.php" class="logo"><strong>ColonyCollab</strong></a>
					<nav id="nav">
						<a href="index.php">Home</a>
						<a href="login.php">Login</a>
						<a href="register.php">Register</a>
                    </nav>
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
				</div>
			</header>

		<!-- Banner -->
			<section id="banner">
				<div class="inner">
					<header>
						<h1>Welcome to ColonyCollab</h1>
					</header>
COLLABORATE AND COLONOLISE:Create an Event And get the Best Inividuals From Us.<br>
					<div class="flex ">

						<div>
							<span class="icon fa-car"></span>
							<h3>Groups to same destination</h3>

						</div>

						<div>
							<span class="icon fa-camera"></span>
							<h3>Cast for Shows</h3>

						</div>

						<div>
							<span class="icon fa-bug"></span>
							<h3>Team For any Project</h3>

						</div>

					</div>

					<footer>
						<a href="login.php" class="button">Get Started Log in Now!!</a>
					</footer>
				</div>
			</section>


		<!-- Three -->
			<section id="three" class="wrapper align-center">
				<div class="inner">
					<div class="flex flex-2">
						<article>
							<div class="image round">
								<img src="images/team.jpg" alt="Pic 01" height="150"width="150"/>
							</div>
							<header>
								<h3>Want some participation ?</h3>
							</header>
							<p>Upload your Project details and make it availabe to the most Efficient ones.</p>

						</article>
						<article>
							<div class="image round">
								<img src="images/pic02.jpg" alt="Pic 02" />
							</div>
							<header>
								<h3>Want to participate ?</h3>
							</header>
							<p>Surf over the avilable projects and select the best one based on your interests.</p>
						</article>
					</div>
				</div>
			</section>

							<div class="inner">
								<div class="flex">
									<div class="copyright">
										&copy; ASAP.
									</div>
									<ul class="icons">
										<li><a href="https://www.facebook.com/ashokkumar.sharma/92372" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
										<li><a href="https://twitter.com/SinghAgrim" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="https://www.linkedin.com/in/shivam-shukla-b83b3468/" class="icon fa-linkedin"><span class="label">linkedIn</span></a></li>

									</ul>
								</div>
							</div>


		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
