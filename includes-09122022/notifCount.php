<?php  

	include'connection.php';

	$sender = $connection->real_escape_string($_POST['sender']);

	$select = $connection->query("SELECT * FROM chats WHERE receiver='$sender' AND status='unseen'");
	echo $select->num_rows;

?>