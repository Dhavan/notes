<?php

/*#
#	Removes the note based on the ID of the note.
#	Takes GET variable value of note id
#	Checks for GET arguements
#	Checks weather the user is allowed to delete the note.
#	If note, the user is forced-logged out.
#
#*/

	include_once 'includes/db_connect.php';
	include_once 'includes/psl-config.php';
	include_once 'includes/functions.php';

	sec_session_start();

	if(isset($_SESSION['username'], $_GET['note_id'], $_GET['status'])){		//check GET arguments


		//Senitize all the GET values
		$username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_STRING);
		$noteId = filter_input(INPUT_GET, 'note_id', FILTER_SANITIZE_NUMBER_INT);
		$noteId = $noteId + 0;

		//Prepare mysql statements to select the matching note and user id
		$stmt = $mysqli->prepare("SELECT id, status FROM note WHERE id = ? AND note_id=? LIMIT 1");
		$stmt->bind_param("ii",  $_SESSION['user_id'], $noteId);
		$stmt->execute();
		$stmt->bind_result($userId, $status);
		$stmt->fetch();

		
		if($_SESSION['user_id'] != $userId || (!$userId))		//if there's no value from db or, the userids don't match, logout!
		{

			header('Location: includes/logout.php');
			
		}

		//if mysql selection goes smoothly, proceed to remove the note
		else{
		
			$mysqli2 = new mysqli(HOST, USER, PASSWORD, DATABASE);
			
			if($status == 0) {
				$stmt2 = $mysqli2->prepare("UPDATE note SET status = 1 WHERE note_id = ?");
				$stmt2->bind_param("i", $noteId);
				$stmt2->execute();
				
				$mysqli2->close();
			}

			else if ($status == 1) {
				$stmt2 = $mysqli2->prepare("UPDATE note SET status = 0 WHERE note_id = ?");
				$stmt2->bind_param("i", $noteId);
				$stmt2->execute();
				
				$mysqli2->close();
			}
			
			header('Location: userNotes.php');
		}

	}

	//there has been something wrong with the GET values. redirect back.
	else {
		echo "Something is wrong. Please" . "<a href='userNotes.php'>Go back</a>";
	}

?>