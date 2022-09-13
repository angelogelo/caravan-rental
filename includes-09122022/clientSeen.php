<?php  

	include 'connection.php';

	$receiver = $connection->real_escape_string($_POST['receiver']);

	$update = $connection->query("UPDATE chats SET status='seen' WHERE receiver='$receiver'");

?>