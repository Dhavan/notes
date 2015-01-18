  <?php
  include 'includes/db_connect.php';
  include 'includes/functions.php';
  include 'includes/register.inc.php';

  sec_session_start();
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
	<meta charset="utf-8">
	<title>Home &middot; Notes</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">

	<script type="text/JavaScript" src="js/sha512.js"></script> 
	<script type="text/JavaScript" src="js/forms.js"></script> 

	<style>
		body
		{
			margin-top: 60px;
		}

    </style>
  </head>

  <body>

      <!-- NAVBAR
      ================================================== -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Notes</a>
			</div>

			<div class="nav-collapse">
				<ul class="nav navbar-nav">
				  <li class="active"><a href="#">Home</a></li>
				  <li><a href="#about">About</a></li>
				  <li><a href="#contact">Contact</a></li>
						<?php 
							$loggedStatus = login_check($mysqli);
						if ($loggedStatus == true) { ?>
						<li><a href="userNotes.php">Notes</a></li>
				</ul>
				<div class="navbar-right navbar-collapse">
  				    <ul class="username nav navbar-nav">
                <li><a class="username">Hello, <?php echo htmlentities($_SESSION['username']);?></a></li>
					       <li><a class="nav nav-collapse " href="includes/logout.php">&middot; logout</a>
              </ul>
			</div>
				    <?php }else { ?>				
            </ul>
            <?php } ?>
            <?php if (!login_check($mysqli)) { ?>
  			
            <form class="navbar-form navbar-right" action="includes/process_login.php" method="POST" name="login_form">
				<div class="form-group">
  				    <input class="span2 form-control" autofocus type="text" name="email" placeholder="Email"/>
  				    <input class="span2 form-control" type="password" name="password" id="password" placeholder="passowrd" />
				</div>
  				    <button class="btn" type="submit" onclick="return formhash(this.form, this.form.password);">Sign in</button>
            </form>
  		      <?php } ?>
  			</div>
		</div>
	   </nav>
	
	<?php 
	if($loggedStatus == false){ ?>

	<div class="container">
    <h1>Register with us</h1>
    <?php
		if (!empty($error_msg)) {
			echo $error_msg;
		}
    ?>
	</div>

	<div class="container">
		<span id="signinButton">
			<span
			class="g-signin"
			data-callback="signinCallback"
			data-clientid="<?php echo GCLIENTID; ?>"
			data-cookiepolicy="single_host_origin"
			data-requestvisibleactions="http://schemas.google.com/AddActivity"
			data-scope="https://www.googleapis.com/auth/plus.login">
			</span>
		</span>
	    <form method="post" name="registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
			
			<div class="input-group">
				
				
				<input class="form-control" type='text' name='username' id='username' placeholder='username'/>
				
				
				
				<input class="form-control" type="text" name="email" id="email" placeholder='email'/>
				
				
				<input class="form-control" type="password"
								 name="password" 
								 id="password"
								 placeholder='password'/>
		
		
				
				<input class="form-control" type="password" 
										 name="confirmpwd" 
										 id="confirmpwd"
										 placeholder='confirm' />				
				
			</div>
			<input class="btn btn-primary" type="submit" 
				   value="Register" 
				   onclick="return regformhash(this.form,
								   this.form.username,
								   this.form.email,
								   this.form.password,
								   this.form.confirmpwd);" />
	    </form>
	</div>
	<?php
	}
	else {
		echo "<h1>Welcome!</h1>";
	}
	?>
	
	
		<hr class="featurette-divider">

      <!-- Le javascript
      ================================================== -->
  	<script src="js/bootstrap.js"></script>
  	<script src="js/bootstrap.min.js"></script>
    <script src="js/jQuery.js"></script>
    <script type="text/javascript">
		(function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/client:plusone.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		})();

		function signinCallback(authResult) {
			if (authResult['status']['signed_in']) {
			// Update the app to reflect a signed in user
			// Hide the sign-in button now that the user is authorized, for example:
			var redirectURL = "login.php"
			document.getElementById('signinButton').setAttribute('style', 'display: none');
			} else {
			// Update the app to reflect a signed out user
			// Possible error values:
			//   "user_signed_out" - User is signed-out
			//   "access_denied" - User denied access to your app
			//   "immediate_failed" - Could not automatically log in the user
			console.log('Sign-in state: ' + authResult['error']);
			}
		}
    </script>

  </body>
  </html>