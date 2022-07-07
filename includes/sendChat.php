<?php  

	include'connection.php';

	$sender = mysqli_real_escape_string($connection, $_POST['sender']);
	$message = mysqli_real_escape_string($connection, $_POST['message']);
	$receiver = mysqli_real_escape_string($connection, $_POST['receiver']);

	$timeLimit = date("Y-m-d ")."17:00:00";

	if ($sender !== "admin") {
		$check = $connection->query("SELECT * FROM chat_reference WHERE customer_id='$sender'");
		if ($check->num_rows < 1) {
			$insertChatReference = $connection->query("INSERT INTO chat_reference (customer_id) VALUES('$sender')");
		}
	}
		
	$insert = $connection->query("INSERT INTO chats (sender, receiver, message, created_at) VALUES('$sender', '$receiver', '$message', '$timeNow')");
	
	if ($insert === TRUE) {
		echo "Saved";
	}else {
		echo "Error";
	}

?>