<!-- Author: Dhavan Vaidya
The script adds a new note to the database.
Input: two GET parameters - note & username (session var)
Output: A new db entry of the note with proper parameters. -->

<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include_once 'includes/psl-config.php';

sec_session_start();	//start a customized secure session
		
if(isset($_POST['note'], $_SESSION['username'])){


	if($_POST['note'] == "" || $_POST['note'] == null){
		header('Location: userNotes.php');
	}

	//remove unwanted input from the string
	$note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_STRING);
	
	//fetch userid for the user
	$stmt = $mysqli->prepare("SELECT id FROM members WHERE username = ? LIMIT 1");
	$stmt->bind_param('s', $_SESSION['username']);
	$stmt->execute();
	$stmt->store_result();
	
	$stmt->bind_result($userid);
	$stmt->fetch();

	//insert the new note
	$insert_stmt = $mysqli->prepare("INSERT INTO note (id, note) VALUES (?, ?)");
	$insert_stmt->bind_param('is', $userid, $note);

	if (! $insert_stmt->execute()) {
		header('Location: ../error.php?err=Registration failure: INSERT');
		exit();
	}

	//if the user has attachment to be stored - proccess it and store it on the disk. DB stores path
	//A catch: upload directory is common for all users. We cannot store two files with the same name! Will be revised.
	if ($_FILES['file']['error'] > 0) {
		header('Location: userNotes.php');
	}
	else {
		if($_FILES['file']['size'] > 100000)
			echo "file size exceeding the limit";
		else{
			if(file_exists("upload/" . $_FILES['file']['name']))
				echo "A file with the same name already exists.";
			else{
				$stmt = $mysqli->prepare("SELECT note_id FROM note ORDER BY note_id DESC LIMIT 1");
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($noteId);
				$stmt->fetch();
				$path = "upload/" . $_FILES['file']['name'];

				$insert_stmt = $mysqli->prepare("INSERT INTO attachments (noteId, path) VALUES (?, ?)");
				$insert_stmt->bind_param('is', $noteId, $path );
				$insert_stmt->execute();

				move_uploaded_file($_FILES['file']['tmp_name'] , "upload/" . $_FILES['file']['name'] );

				header('Location: userNotes.php');
			}
		}
	}

	
}
?>