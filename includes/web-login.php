<?php  

	include'connection.php';

	$username = mysqli_real_escape_string($connection, $_POST['username']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);

	$select = $connection->query("SELECT * FROM user WHERE username='$username'");
	if ($select->num_rows < 1) {
		echo "No Account";
	}else {
		$selectRow = $select->fetch_array();
		$passwordCheck = $selectRow['password'];

		$type = $selectRow['type'];

		if (password_verify($password, $passwordCheck)) {
			if ($type == "customer") {

				$_SESSION['customer'] = $username;

				$customer = $connection->query("SELECT * FROM user WHERE username='$username'");
				$customerRow = $customer->fetch_array();

			}else {
				$_SESSION['admin'] = $username;
			}

			echo $type;

		}else {
			echo "No Account";
		}
	}

?>