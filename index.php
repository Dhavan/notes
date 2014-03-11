<?php
include 'includes/db_connect.php';
include 'includes/functions.php';

sec_session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home &middot; loci Notes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="styles/bootstrap.css" rel="stylesheet">
    <link href="styles/bootstrap-responsive.css" rel="stylesheet">
	
	<script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script> 
	
    <style>

    /* GLOBAL STYLES
    -------------------------------------------------- */
    /* Padding below the footer and lighter body text */

    body {
      padding-bottom: 40px;
      color: #5a5a5a;
    }
	
	/*CUSTOMIZE THE USERNAME DISPLAY IF LOGGED IN */
	
	.username
	{
		font-size: 20px;
		color: #7AB2FA;
	}



    /* CUSTOMIZE THE NAVBAR
    -------------------------------------------------- */

    /* Special class on .container surrounding .navbar, used for positioning it into place. */
    .navbar-wrapper {
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		z-index: 10;
		margin-top: 20px;
		margin-bottom: -90px; /* Negative margin to pull up carousel. 90px is roughly margins and height of navbar. */
    }
	
    .navbar-wrapper .navbar {

    }

    /* Remove border and change up box shadow for more contrast */
    .navbar .navbar-inner {
		border: 0;
		-webkit-box-shadow: 0 2px 10px rgba(0,0,0,.25);
		-moz-box-shadow: 0 2px 10px rgba(0,0,0,.25);
        box-shadow: 0 2px 10px rgba(0,0,0,.25);
    }

    /* Downsize the brand/project name a bit */
    .navbar .brand {
		padding: 14px 20px 16px; /* Increase vertical padding to match navbar links */
		font-size: 16px;
		font-weight: bold;
		text-shadow: 0 -1px 0 rgba(0,0,0,.5);
    }

    /* Navbar links: increase padding for taller navbar */
    .navbar .nav > li > a {
		padding: 15px 20px;
    }

    /* Offset the responsive button for proper vertical alignment */
    .navbar .btn-navbar {
		margin-top: 10px;
    }



    /* CUSTOMIZE THE CAROUSEL
    -------------------------------------------------- */

    /* Carousel base class */
    .carousel {
		margin-bottom: 60px;
    }

    .carousel .container {
		position: relative;
		z-index: 9;
    }

    .carousel-control {
		height: 80px;
		margin-top: 0;
		font-size: 120px;
		text-shadow: 0 1px 1px rgba(0,0,0,.4);
		background-color: transparent;
		border: 0;
		z-index: 10;
    }

    .carousel .item {
		height: 500px;
    }
    .carousel img {
		position: absolute;
		top: 0;
		left: 0;
		min-width: 100%;
		height: 500px;
    }

    .carousel-caption {
		background-color: transparent;
		position: static;
		max-width: 550px;
		padding: 0 20px;
		margin-top: 200px;
    }
    .carousel-caption h1,
    .carousel-caption .lead {
		margin: 0;
		line-height: 1.25;
		color: #e9d9c8;
		text-shadow: 0 1px 1px rgba(0,0,0,.4);
    }
    .carousel-caption .btn {
		margin-top: 10px;
    }



    /* MARKETING CONTENT
    -------------------------------------------------- */

    /* Center align the text within the three columns below the carousel */
    .marketing .span4 {
		text-align: center;
    }
    .marketing h2 {
		font-weight: normal;
    }
    .marketing .span4 p {
		margin-left: 10px;
		margin-right: 10px;
    }

    /* RESPONSIVE CSS
    -------------------------------------------------- */

    @media (max-width: 979px) {

		.container.navbar-wrapper {
			margin-bottom: 0;
			width: auto;
		}
		.navbar-inner {
			border-radius: 0;
			margin: -20px 0;
		}

		.carousel .item {
			height: 500px;
		}
		.carousel img {
			width: auto;
			height: 500px;
		}

		.featurette {
			height: auto;
			padding: 0;
		}
		.featurette-image.pull-left,
		.featurette-image.pull-right {
			display: block;
			float: none;
			max-width: 40%;
			margin: 0 auto 20px;
		}
    }


    @media (max-width: 767px) {

		.navbar-inner {
			margin: -20px;
		}

		.carousel {
			margin-left: -20px;
			margin-right: -20px;
		}
		.carousel .container {

		}
		.carousel .item {
			height: 300px;
		}
		.carousel img {
			height: 300px;
		}
		.carousel-caption {
			width: 65%;
			padding: 0 70px;
			margin-top: 100px;
		}
		.carousel-caption h1 {
			font-size: 30px;
		}
		.carousel-caption .lead,
		.carousel-caption .btn {
			font-size: 18px;
		}

		.marketing .span4 + .span4 {
			margin-top: 40px;
		}

		.featurette-heading {
			font-size: 30px;
		}
		.featurette .lead {
			font-size: 18px;
			line-height: 1.5;
		}

    }
    </style>
</head>

<body>

    <!-- NAVBAR
    ================================================== -->
    <div class="navbar-wrapper">

      <div class="container">

        <div class="navbar navbar-inverse">
          <div class="navbar-inner">

            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="brand" href="#">loci Notes</a>

            <div class="nav-collapse collapse">
              <ul class="nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
				<?php if (login_check($mysqli) == true) { ?>
				<li><a href="userNotes.php">Notes</a></li>
			</ul>
			<form class="nav pull-right">
				<p class="username">Hello, <?php echo htmlentities($_SESSION['username']);?>
				<a class="nav nav-collapse collapse " href="includes/logout.php">logout</a>
			</ul>
				<?php }else { ?>				
              </ul>
            
			<?php } ?>
			<?php if (!login_check($mysqli)) { ?>
			
			<form class="navbar-form pull-right" action="includes/process_login.php" method="POST" name="login_form">
				<input class="span2" type="text" name="email" placeholder="Email"/>
				<input class="span2" type="password" name="password" id="password" placeholder="passowrd" />
				<button class="btn" type="submit" onclick="return formhash(this.form, this.form.password);">Sign in</button>
            </form>
			
			<?php } ?>
			</div><!--/.nav-collapse -->
          </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->

      </div> <!-- /.container -->
	  </div><!-- /.navbar-wrapper -->
	
	<!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide">
      <div class="carousel-inner">
        <div class="item active">
          <img src="img/slide-02.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>A new way to store To-Do lists!</h1>
              <p class="lead">Know about loci method? We have tried to implement that. The awesome way to visualize your To-Do lists!</p>
			  
			  <?php if(login_check($mysqli) == false) : ?>
              <a class="btn btn-large btn-primary" href="register.php">Sign up</a>
			  <?php endif; ?>
            </div>
          </div>
        </div>
		<div class="item">
          <img src="img/slide-05.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
				<h1>Keep calm, We have got you Covered</h1>
				<p class="lead">We will make a mind palace out of your To-Do list.</p>
				<?php if(login_check($mysqli) == false) : ?>
				<a class="btn btn-large btn-primary" href="register.php">Sign up</a>
				<?php endif; ?>
            </div>
          </div>
        </div>
		<div class="item">
          <img src="img/slide-04.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
				<h1>We have methods, you have a list</h1>
				<p class="lead">We hire memory professionals who gives you these so called palaces. The fun way.</p>
				<?php if(login_check($mysqli) == false) : ?>
				<a class="btn btn-large btn-primary" href="register.php">Sign up</a>
				<?php endif; ?>
            </div>
          </div>
        </div>
        
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div><!-- /.carousel -->


    <div class="container marketing">


      <div class="row">
        <div class="span4">
          <h2>Inspiration</h2>
          <p>Technology can help you remember things! Our mind is awesome, it's just that we don't know how to get best out of it. We can use "<a href="http://en.wikipedia.org/wiki/Method_of_loci">mind palaces</a>" to remember even highly complicated random numbers. </p>
          <p><a class="btn" href="http://en.wikipedia.org/wiki/Method_of_loci" target="_blank">View details &raquo;</a></p>
        </div><!-- /.span4 -->
        <div class="span4">
          <h2>The Challenge</h2>
          <p>To create a story based on your input is a tuff task. We need something called Artificial Intelligence. And, this proves that we will keep improving.</p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
        </div><!-- /.span4 -->
        <div class="span4">
          <h2>Why use it?</h2>
          <p>We all rely too much on technology. We have now tried to use technology to improve our brain. We provide with a simple way which will dramatically make you remember your whole task list! Cool!</p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
        </div><!-- /.span4 -->
      </div><!-- /.row -->



      <hr class="featurette-divider">

      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2013 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->



    <!-- Le javascript
    ================================================== -->
	<script src="js/bootstrap.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jQuery.js"></script>
    <script src="js/transition.js"></script>
    <script src="js/alert.js"></script>
    <script src="js/modal.js"></script>
    <script src="js/dropdown.js"></script>
    <script src="js/scrollspy.js"></script>
    <script src="js/tab.js"></script>
    <script src="js/tooltip.js"></script>
    <script src="js/popover.js"></script>
    <script src="js/button.js"></script>
    <script src="js/collapse.js"></script>
    <script src="js/carousel.js"></script>
    <script src="js/typeahead.js"></script>
    <script>
      !function ($) {
        $(function(){
          // carousel demo
          $('#myCarousel').carousel()
        })
      }(window.jQuery)
    </script>
    <script src="js/holder.js"></script>
</body>
</html>