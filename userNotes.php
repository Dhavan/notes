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
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.css" rel="stylesheet">
		<script type="text/JavaScript" src="js/sha512.js"></script>
		
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
						<li class="active"><a href="index.php">Home</a></li>
						<li><a href="about.html">About</a></li>
						<li><a href="Contact.html">Contact</a></li>
					</ul>
				</div>
				<div class="nav-collapse">
					<ul class="nav navbar-nav pull-right">
						<li><a class="nav nav-collapse" href="includes/logout.php">logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
		
		
		
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
			
				<div class="well">
					<form method="post" action="addNote.php" >
						<div class="input-group">
							<span class="input-group-addon"></span>
							<input class="form-control" type="text" id="note" name="note" placeholder="Note" />
						</div>
						<button class="btn btn-primary btn-sm btn-block" type="submit" onclick="formnote(this.form, this.note);">add</button>
					</form>
					
					<!-- making the list of all added notes -->
					
					<?php
						
						$stmt = $mysqli->prepare("SELECT id, note_id, note FROM note WHERE id = ? LIMIT 0, 30");
						$stmt->bind_param("i",$_SESSION['user_id']);
						$stmt->execute();
						$stmt->store_result();
						$stmt->bind_result($id, $note_id, $note);
						
						echo "<ul class='list-group'>";						
						
						while($result = $stmt->fetch()) {
							printf("<li class='list-group-item'>%d %s    ", $id, $note);
							printf("<a href='delNote.php?note_id=%d' >Remove</a></li>",$note_id);
							
						}
						echo "</ul>";
						
						echo "userid:" . $_SESSION['user_id'];
					?>
					
					<!-- end -->
				</div>
			</div>
		   </div>
		</div>
			
			<div class="container">
			<hr>
			<footer>
				<p>&copy; 2013 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
			</footer>
		</div>

		<script src="js/bootstrap.js"></script>
  		<script src="js/bootstrap.min.js"></script>
      	<script src="js/jQuery.js"></script>
		
	</body>
</html>
	
		
		