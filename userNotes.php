<?php

/*Displays a webpage showing a list of notes and option for new task
Shows striked text if the task has been marked as done, normal otherwise.*/

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include_once 'includes/psl-config.php';

sec_session_start();

if(login_check($mysqli) == false)
	header('Location: index.php');

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?php echo htmlentities($_SESSION['username']); ?>'s Notes</title>
		<link href="css/main.css" rel="stylesheet">
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.css" rel="stylesheet">
		<style type="text/css">
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
					<a class="navbar-brand" href="index.php">Notes</a>
				</div>
				<div class="nav-collapse">
					<ul class="nav navbar-nav">
						<li><a href="index.php">Home</a></li>
						<li><a href="about.html">About</a></li>
						<li><a href="Contact.html">Contact</a></li>
						<?php if (login_check($mysqli) == true) { ?>
						<li class="active"><a href="userNotes.php">Notes</a></li>
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
					<form method="post" action="addNote.php" name="addNote"  enctype="multipart/form-data" onsubmit="return formnote(this.form, this.note);">
						<div class="input-group">
							<input class="form-control" type="text" id="note" name="note" placeholder="Note" autofocus />
							<input class="form-control" type="file" name="file" id="file" /	>
							<input class="form-control btn-primary" type="submit" />
						</div>
						<!--<button class="btn btn-primary btn-sm btn-block" type="submit">add</button>-->
					</form>
					
					<!-- making the list of all added notes -->
					

					<div class="note-spacer">
						<?php
							
							$stmt = $mysqli->prepare("SELECT id, note_id, note, status FROM note WHERE id = ? LIMIT 0, 30");
							$stmt->bind_param("i",$_SESSION['user_id']);
							$stmt->execute();
							$stmt->store_result();
							$stmt->bind_result($id, $note_id, $note, $status);
							
							echo "<ul class='list-group'>";						
							
							while($result = $stmt->fetch()) {

								$image_stmt = $mysqli->prepare("SELECT attachId, path from attachments WHERE noteId = ? LIMIT 1");
								$image_stmt->bind_param("i", $note_id);
								$image_stmt->execute();
								$image_stmt->store_result();
								$image_stmt->bind_result($attchment, $img);
								$image_stmt->fetch();

								if($status == 0){
									printf("<li class='list-group-item'><input type='checkbox' data-target='http://localhost/notes/doneNote.php?note_id=%d&status=0' name='note' value='%d'>  %s", $note_id, $note_id,$note);
									printf("<a class='pull-right' href='delNote.php?note_id=%d' >Remove</a></li>",$note_id);
								}
								else if($status == 1){
									printf("<li class='list-group-item'><input type='checkbox' data-target='http://localhost/notes/doneNote.php?note_id=%d&status=1' name='note' value='%d' checked><strike> %s </strike>", $note_id, $note_id, $note);
									printf("<a class='pull-right' href='delNote.php?note_id=%d' >Remove</a></li>",$note_id);
								}
								if($img){
									echo '<li><img src="' . $img . '" />';
									printf("<a class='' href='delAttach.php?attach_id=%d' >Remove</a></li>",$attchment);
								}
								
							}
							echo "</ul>";
						?>
					</div>
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
      	<script src="js/forms.js"></script>
      	<script type="text/JavaScript" src="js/sha512.js"></script>
      	<script type="text/javascript">
      		
      		$(function () {
      			$("input[type='checkbox']").change(function (){
      				var item = $(this);
      				if(item.is(":checked"))
      				{
      					window.location.href=item.data("target");
      				}
      				else
      				{
      					window.location.href=item.data("target");
      				}
      			});
      		});


      	</script>		
	</body>
</html>