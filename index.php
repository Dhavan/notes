  <?php
  include 'includes/db_connect.php';
  include 'includes/functions.php';

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
  	
		/*CUSTOMIZE THE USERNAME DISPLAY IF LOGGED IN */
		
		.username
		{
			font-size: 20px;
			color: #7AB2FA;
		}

    </style>
  </head>

  <body>

      <!-- NAVBAR
      ================================================== -->
      <nav class="navbar navbar-inverse" role="navigation">
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
      				<?php if (login_check($mysqli) == true) { ?>
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
  				    <input class="span2 form-control" type="text" name="email" placeholder="Email"/>
  				    <input class="span2 form-control" type="password" name="password" id="password" placeholder="passowrd" />
				</div>
  				    <button class="btn" type="submit" onclick="return formhash(this.form, this.form.password);">Sign in</button>
            </form>
  		      <?php } ?>
  			</div>
		</div>
	   </nav>

	<div class="container-fluid" >
        <div class="jumbotron">
			<div class="container">
				<h1 class="title">Note taking App</h1>
			</div>
		</div>
	</div>
	
	
		<hr class="featurette-divider">

      <!-- Le javascript
      ================================================== -->
  	<script src="js/bootstrap.js"></script>
  	<script src="js/bootstrap.min.js"></script>
      <script src="js/jQuery.js"></script>

  </body>
  </html>