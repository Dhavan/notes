<?php

include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Register &middot; Notes</title>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
        <link rel="stylesheet" href="styles/bootstrap.css" />
		<style type="text/css">
		body {
			padding-top: 60px;
		}
	</style>
    </head>
    <body>
	
	<!-- NAVBAR
    ================================================== -->
    
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-inner">
        <div class="container-fluid">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="brand" href="index.php">Notes</a>
			<div class="nav-collapse collapse">
            <ul class="nav">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="#about">About</a></li>
				<li><a href="#contact">Contact</a></li>
            </ul>
			</div><!--/.nav-collapse -->
        </div>
    </div>
    </nav>
	
	<div class="container">
        <h1>Register with us</h1>
        <?php
			if (!empty($error_msg)) {
				echo $error_msg;
			}
        ?>
        <ul>
            <li>Usernames may contain only digits, upper and lower case letters and underscores</li>
            <li>Emails must have a valid email format</li>
            <li>Passwords must be at least 6 characters long</li>
            <li>Passwords must contain
                <ul>
                    <li>At least one upper case letter (A..Z)</li>
                    <li>At least one lower case letter (a..z)</li>
                    <li>At least one number (0..9)</li>
                </ul>
            </li>
            <li>Your password and confirmation must match exactly</li>
        </ul>
		</div>
		
		<div class="container">
        <form method="post" name="registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
			<table>
				<tr>
				<td>Username:</td>
				<td><input type='text' name='username' id='username' /></td>
				</tr>
				<tr>
				<td>Email:</td>
				<td><input type="text" name="email" id="email" /></td>
				</tr>
				<td>Password:</td>
				<td><input type="password"
								 name="password" 
								 id="password"/></td>
				</tr>
				<tr>
				<td>Confirm password:
				<td><input type="password" 
										 name="confirmpwd" 
										 id="confirmpwd" /></td>
				</tr>
				<tr>
				<td colspan="2" align="center">
				<input type="button" 
					   value="Register" 
					   onclick="return regformhash(this.form,
									   this.form.username,
									   this.form.email,
									   this.form.password,
									   this.form.confirmpwd);" /> </td>
				</tr>
			</table>
        </form>
        <p>Return to the <a href="index.php">login page</a>.</p>
		
		</div>
		
		<div class="container">
			<hr>
			<footer>
				<p>&copy; 2013 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
			</footer>
		</div>
    </body>
</html>
