<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include_once 'includes/psl-config.php';

sec_session_start();
		
if(isset($_POST['note'], $_SESSION['username'])){
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
	
	else{
		header('Location: userNotes.php');
	}
}
?>