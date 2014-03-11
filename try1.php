<?php

include_once 'includes/functions.php';
sec_session_start();

$mysqli = new mysqli("localhost", "user", "pass", "secure_login");

if($mysqli->connect_error){
	header('Location: ../error.php?err=Unable to fetch DB');
}

if(isset($_SESSION['username']))
{	
	$stmt_notes = $mysqli->prepare("SELECT note FROM note WHERE id = ?");
	$stmt_notes->bind_param("i",$_SESSION['user_id']);
	$stmt_notes->execute();
	$stmt_notes->bind_result($notes);
	
	$index = 0;
	while($stmt_notes->fetch()){
		$notes_array[$index] = $notes;
		$string[$index] = explode(" ", $notes_array[$index]);
		$index++;
	}
	
	$story = "";
	
	foreach($string as $value){
		foreach($value as $key){
			$stmt_word = $mysqli->prepare("SELECT id from webdev_dictionary WHERE word LIKE ? limit 1");
			$stmt_word->bind_param("s",$key);
			$stmt_word->execute();
			$stmt_word->bind_result($wordid);
			while($stmt_word->fetch()){
				$mysqli2 = new mysqli("localhost", "user", "pass", "secure_login");
				$stmt_sent = $mysqli2->prepare("SELECT sentence FROM sentence WHERE word_id = ? limit 1");
				$stmt_sent->bind_param("i", $wordid);
				$stmt_sent->execute();
				$stmt_sent->bind_result($sentence);
				while($stmt_sent->fetch())
					$story .= $sentence;
			}
				
		}
	}
	
	echo $story;
	
}

else
{
	echo "lol, we couldn't do that. We are still in beta you know!";
}

?>