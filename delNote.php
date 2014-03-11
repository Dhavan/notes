<?php

include_once 'includes/db_connect.php';
include_once 'includes/psl-config.php';
include_once 'includes/functions.php';

sec_session_start();

if(isset($_SESSION['username'], $_GET['note_id'])){

	$username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_STRING);
	$noteId = filter_input(INPUT_GET, 'note_id', FILTER_SANITIZE_NUMBER_INT);
	$noteId = $noteId + 0;
	
	$stmt = $mysqli->prepare("SELECT id FROM note WHERE note_id = ?");
	$stmt->bind_param("i", $noteId);
	$stmt->execute();
	$stmt->bind_result($userId);
	$stmt->fetch();
	
	if($_SESSION['user_id'] != $userId)
	{
		
		header('Location: includes/logout.php');
		
	}
	
	$mysqli2 = new mysqli(HOST, USER, PASSWORD, DATABASE);
	
	$stmt2 = $mysqli2->prepare("DELETE FROM note WHERE note_id = $noteId");
	$stmt2->bind_param("i", $noteId);
	$stmt2->execute();
	
	$stmt3 = $mysqli2->prepare("SELECT * FROM note");
	$stmt3->execute();
	$stmt3->store_result();
	
	$mysqli2->close();
	
	header('Location: userNotes.php');
}

else {
	echo "Something is wrong. Please" . "<a href='userNotes.php'>Go back</a>";
}

?>