<?php

	include 'connection.php';
	//for picture
    $picture_tmp 	= $_FILES['picture']['tmp_name'];
	$picture_count = count($_FILES['picture']['name']);
	//for pds
	$file_tmp 	= $_FILES['file_pds']['tmp_name'];
	$file_count = count($_FILES['file_pds']['name']);

	$employee_number = $_POST['employee_number'];
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$extensionname = $_POST['extensionname'];
	$contact_no = $_POST['contact_no'];
	$birth_date = $_POST['birth_date'];
	$address = $_POST['address'];
	$gender = $_POST['gender'];
	$user_type = $_POST['user_type'];
	// $password = password_hash(strtolower($contact_no), PASSWORD_DEFAULT);

	$email = $_POST['email'];
	$password = randomPassword();
	$new_pass = password_hash(strtolower($password), PASSWORD_DEFAULT);

	$select = $connection->query("SELECT * FROM tbl_employee WHERE employee_number = '".$employee_number."'");
	$hired_date = $_POST['hired_date'];
	$section = $_POST['section'];
	$position = $_POST['position'];
	//$hired_date  = date("Y-m-d", strtotime("+6 month", strtotime($timeNow)));
	
	if($select->num_rows < 1){

		//code for pictures
		$directory = '../labeled_images/'.ucwords($firstname) . ' ' . ucwords($lastname) . '_' . $employee_number;
		$dir = mkdir($directory);
		$a = 1;

		for($i = 0; $i < $picture_count; $i++){
			$a += $i;
			$filename = $_FILES['picture']['name'][$i];
			//get extension
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			//get file_name
			$file_ext = substr($filename, strripos($filename, '.'));
			$new_file = $a .$file_ext;
			move_uploaded_file($picture_tmp[$i], $directory.'/'.$new_file);
		}

		//code for file_pds
		$directory = '../files/'.ucwords($firstname) . ' ' . ucwords($lastname) . '_' . $employee_number;
		$dir = mkdir($directory);
		$a = 1;

		for($i = 0; $i < $file_count; $i++){
			$a += $i;
			$filename = $_FILES['file_pds']['name'][$i];
			move_uploaded_file($file_tmp[$i], $directory.'/'.$filename);
		}

		$select = $connection->query("SELECT * FROM tbl_fptemp WHERE fpid = '2'");
		$selectRow = $select->fetch_array();
		$finger_print = $selectRow['fptemplate'];

		$otp = rand();

		$accumulated_balance = "15";

		$insert = $connection->query("INSERT INTO tbl_employee (
			employee_number,
			firstname,
			middlename,
			lastname, 
			extensionname, 
			contact_no,
			address, 
			gender, 
			birth_date, 
			profile, 
			file_pds, 
			fingerprint,
			type,
			hired_date,
			section,
			position,
			accumulated_balance, 
			created_at
			) VALUES (
			'$employee_number', 
			'$firstname', 
			'$middlename', 
			'$lastname', 
			'$extensionname', 
			'$contact_no', 
			'$address', 
			'$gender', 
			'$birth_date', 
			'$new_file', 
			'$filename', 
			'$finger_print', 
			'$user_type',
			'$hired_date', 
			'$section', 
			'$position',
			'$accumulated_balance', 
			'$timeNow'
		)");

		$insert1 = $connection->query("INSERT INTO tbl_users (
			username,
			password,
			picture,
			type,
			contact_no,
			email,
			otp,
			created_at
			) VALUES (
			'$employee_number',
			'$new_pass', 
			'$new_file',
			'$user_type',
			'$contact_no',
			'$email',
			'$otp',   
			'$timeNow' 
		)");

		$directory = $firstname . '_' . $lastname . '_' . $employee_number;

		$insert_user = $connection->query("INSERT INTO tbl_user (
			id,
			f_1,
			f_2,
			faceID,
			fptemplate,
			status,
			points,
			sl,
			vl,
			password,
			type,
			update_date
		) VALUES (
			'$employee_number',
			'null',
			'null',
			'$directory',
			'$finger_print',
			'active',
			'0',
			'5',
			'5',
			'$new_pass',
			'$user_type',
			''
		)");

		echo "Added";
		
		$user = ucfirst(mysqli_real_escape_string($connection, $_POST['user']));
		$activity = "Employee has been added. Employee Number [".$employee_number."]";
		$logs = $connection->query("INSERT INTO audit_trail (user, activity) VALUES ('$user','$activity')");

		include '../functions/send-email.php';

		$to = $email;

		$name = $firstname.' '.$lastname;
		$subject = '[NFA]Welcome to NFA Binalonan!';
		$body = 'Hi '.$name.' and welcome to NFA Binalonan!!<br><br>
		Below are your account credentials:<br><br>

		Username: '.$employee_number.'<br>
		Password: '.$password.'<br><br>

		Thank you!<br><br>

		*This is an automatically generated email. Please do not reply to this email.<br>';

		sendMail($to, $name, $subject, $body);

	}else{
		echo "Exist";
	}

	function randomPassword() {
		$alphabet = 'abcdefghijklmnopqrstuvwxyz1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 12; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	
	
?>