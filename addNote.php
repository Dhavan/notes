<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include_once 'includes/psl-config.php';

sec_session_start();
		
if(isset($_POST['note'], $_SESSION['username'])){


	if($_POST['note'] == "" || $_POST['note'] == null){
		header('Location: userNotes.php');
	}
	$note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_STRING);
	
	$stmt = $mysqli->prepare("SELECT id FROM members WHERE username = ? LIMIT 1");
	$stmt->bind_param('s', $_SESSION['username']);
	$stmt->execute();
	$stmt->store_result();
	
	$stmt->bind_result($userid);
	$stmt->fetch();

	$insert_stmt = $mysqli->prepare("INSERT INTO note (id, note) VALUES (?, ?)");
	$insert_stmt->bind_param('is', $userid, $note);

	if (! $insert_stmt->execute()) {
		header('Location: ../error.php?err=Registration failure: INSERT');
		exit();
	}

	if ($_FILES['file']['error'] > 0) {
		header('Location: userNotes.php');
	}
	else {
		if($_FILES['file']['size'] > 100000)
			echo "error2";
		else{
			if(file_exists("upload/" . $_FILES['file']['name']))
				echo "error3";
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