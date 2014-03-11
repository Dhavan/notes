<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include_once 'includes/psl-config.php';

sec_session_start();

if(login_check($mysqli) == false)
	header('Location: login.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?php echo htmlentities($_SESSION['username']); ?>'s Notes</title>
		<link rel="stylesheet" href="styles/bootstrap.css">
		
		<style type="text/css">
			body {
				padding-top: 60px;
				padding-bottom: 40px;
				background-color: #f5f5f5;
			}
			
			.sidebar-nav {
				padding: 9px 0;
			}
			
			@media (max-width: 980px) {
			/* Enable use of floated navbar text */
				.navbar-text.pull-right {
					float: none;
					padding-left: 5px;
					padding-right: 5px;
				}
			}
		</style>
		
		<link rel="text/javascript" href="styles/bootstrap-responsive">
		<script type="text/JavaScript" src="js/sha512.js"></script>
		
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
					<a class="brand" href="index.php">loci Notes</a>
					<div class="nav-collapse collapse">
						<ul class="nav">
						<li class="active"><a href="index.php">Home</a></li>
						<li><a href="about.html">About</a></li>
						<li><a href="Contact.html">Contact</a></li>
						</ul>
						<ul><li><a class="nav nav-collapse pull-right" href="includes/logout.php">logout</a></li>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>
		
		<div class="container-fluid">
		  <div class="row-fluid">
			<div class="span3">
				<div class="well sidebar-nav">
				<ul class="nav nav-list">
				  <li class="nav-header">Notebooks</li>
				  <li class="active"><a href="#">Notebook 0</a></li>
				  
				  <!-- make the following list dynamic -->
				  
				  <li><a href="#">Notebook 1</a></li>
				  <li><a href="#">Notebook 2</a></li>
				  <li><a href="#">Notebook 3</a></li>				  
				</ul>
				</div>
			</div><!--/span-->
			
			<div class="span9">
				<div class="hero-unit">
					<h2>Hello, <?php echo htmlentities($_SESSION['username']); ?>!</h1>
					
					<!-- making the list of all added notes -->
					
					<?php
						
						$stmt = $mysqli->prepare("SELECT id, note_id, note FROM note WHERE id = ? LIMIT 0, 30");
						$stmt->bind_param("i",$_SESSION['user_id']);
						$stmt->execute();
						$stmt->store_result();
						$stmt->bind_result($id, $note_id, $note);
						
						echo "<ul>";						
						
						while($result = $stmt->fetch()) {
							printf("<li> %s    ", $note);
							printf("<a href='delNote.php?note_id=%d' >Remove</a></li>",$note_id);
							
						}
						echo "</ul>";
						
					?>
					
					<!-- end -->
					
					<form method="post" action="addNote.php" >
						<input class="input-block-level" type="text" id="note" name="note" placeholder="note" />
						<button class="btn" type="submit" onclick="formnote(this.form, this.note);">add</button>
					</form>
					
					<form method="POST" action="try1.php" >
					<button class="btn btn-primary" type="submit" onclick="try1.php">Create!</button>This is will create a "mind palace" for you(beta)
					</form>
					
				</div>
			</div>
			
			<div class="container">
			<hr>
			<footer>
				<p>&copy; 2013 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
			</footer>
		</div>
		
	</body>
</html>
	
		
		