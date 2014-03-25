<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>Sign in &middot; Notes</title>

    <!-- Le styles -->
    <link href="styles/bootstrap.css" rel="stylesheet">
    <style type="text/css">
		body {
			padding-top: 60px;
			padding-bottom: 40px;
			background-color: #f5f5f5;
		}

		.form-signin {
			max-width: 300px;
			padding: 19px 29px 29px;
			margin: 0 auto 20px;
			background-color: #fff;
			border: 1px solid #e5e5e5;
			-webkit-border-radius: 5px;
			   -moz-border-radius: 5px;
					border-radius: 5px;
			-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
			   -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
					box-shadow: 0 1px 2px rgba(0,0,0,.05);
		}
		
		.form-signin input[type="text"],
		.form-signin input[type="password"] {
			font-size: 16px;
			height: auto;
			margin-bottom: 15px;
			padding: 7px 9px;
		}

    </style>
    <link href="styles/bootstrap-responsive.css" rel="stylesheet">
	
	<script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script> 

</head>

<body>
  
	<!-- NAVBAR
    ================================================== -->
    
    <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="brand" href="index.php">Notes</a>
			<div class="nav-collapse collapse">
				<ul class="nav">
					<li><a href="index.php">Home</a></li>
					<li><a href="#about">About</a></li>
					<li><a href="#contact">Contact</a></li>
				</ul>
			</div><!--/.nav-collapse -->
        </div>
      </div>
    </div>


    <div class="container">

        <form class="form-signin" action="includes/process_login.php" method="POST" name="login_form"> 
			<h2 class="form-signin-heading">Please sign in</h2>
            <input type="text" name="email" class="input-block-level" placeholder="Email"/>
            <input type="password" name="password" id="password" class="input-block-level" placeholder="passowrd" />
            <button class="btn btn-large btn-primary" type="submit" onclick="formhash(this.form, this.form.password);">Sign in</button>
			<br /><a href="register.php">register</a>
			<a href="includes/logout.php">log out</a>
        </form>

    </div> <!-- /container -->
	
	<div class="container">
			<hr>
			<footer>
				<p>&copy; 2013 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
			</footer>
	</div>

    <!-- Le javascript
    ================================================== -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>

  </body>
</html>
