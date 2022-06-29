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
			if ($type == "parent") {
				$_SESSION['parent'] = $username;
				$_SESSION['last_time'] = time();

				$parent = $connection->query("SELECT * FROM parents WHERE parent_id='$username'");
				$parentRow = $parent->fetch_array();

				$time=time()+10;

				if ($parentRow['status'] == "pending" OR $parentRow['status'] == "deactivated") {
					echo "Pending";
					exit();
				}

			}else if ($type == "teacher") {
				$_SESSION['teacher'] = $username;

				$teacher = $connection->query("SELECT * FROM teacher WHERE teacher_id='$username'");
				$teacherRow = $teacher->fetch_array();

				if ($teacherRow['status'] == "deactivated") {
					echo "Deactivated";
					exit();
				}

			}else {
				$_SESSION['admin'] = $username;
			}

			echo $type;

		}else {
			echo "No Account";
		}
	}

?>