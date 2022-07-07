<?php  

	include 'connection.php';

	$customer = $_POST['data'];
	$html = '';

	$select = $connection->query("SELECT * FROM user WHERE id='$customer'");;
	if ($select->num_rows > 0) {
		while ($row = $select->fetch_array()) {
			$customer_id = $row['id'];
			$customer_name = $row['lastname']." ".$row['firstname'];

			$html .= '
				<a class="list-group-item list-group-item-action fetchChat" id="messages-list" data-customer-id="'.$customer_id.'" data-toggle="list" href="#messages" role="tab" aria-controls="home">'.$customer_name.'</a>
			';
		}
	}else {
		$select1 = $connection->query("SELECT * FROM user WHERE lastname='$customer'");;
		if ($select1->num_rows > 0) {
			while ($row = $select1->fetch_array()) {
				$customer_id = $row['id'];
				$customer_name = $row['lastname']." ".$row['firstname'];

				$html .= '
					<a class="list-group-item list-group-item-action fetchChat" id="messages-list" data-customer-id="'.$customer_id.'" data-toggle="list" href="#messages" role="tab" aria-controls="home">'.$customer_name.'</a>
				';
			}
		}else {
			$select2 = $connection->query("SELECT * FROM user WHERE firstname='$customer'");;
			if ($select2->num_rows > 0) {
				while ($row = $select2->fetch_array()) {
					$customer_id = $row['id'];
					$customer_name = $row['lastname']." ".$row['firstname'];

					$html .= '
						<a class="list-group-item list-group-item-action fetchChat" id="messages-list" data-customer-id="'.$customer_id.'" data-toggle="list" href="#messages" role="tab" aria-controls="home">'.$customer_name.'</a>
					';
				}
			}else {
				$html .= '
					<a class="list-group-item list-group-item-action" id="messages-list"role="tab" aria-controls="home">No result(s)</a>
				';
			}
		}
	}

	echo $html;

?>