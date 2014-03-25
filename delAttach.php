<!-- The script removes the attachment from the disk and database.
Input: attachment id
Output: Removed entry from DB, removed file from disk
Revisions required: User should not be allowed to remove someone else's attachment -->

<?php

	include_once 'includes/db_connect.php';
	include_once 'includes/psl-config.php';
	include_once 'includes/functions.php';

	sec_session_start();

	if(isset($_SESSION['username'], $_GET['attach_id'])) {
		$username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_STRING);
		$attachment_id = filter_input(INPUT_GET, 'attach_id', FILTER_SANITIZE_NUMBER_INT);
		$attachment_id += 0;

		//fetch the image path for removal of the file from disk
		$stmt2 = $mysqli->prepare("SELECT path from attachments WHERE attachId = ?");
		$stmt2->bind_param("i", $attachment_id);
		$stmt2->execute();
		$stmt2->bind_result($imgpath);
		$stmt2->fetch();
		$stmt2->close();

		$stmt = $mysqli->prepare("DELETE FROM attachments WHERE attachId = ?");
		$stmt->bind_param("i", $attachment_id);
		$stmt->execute();

		unlink($imgpath);
		$stmt->close();

		header('Location: userNotes.php');
	}

?>