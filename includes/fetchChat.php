<?php  

	include'connection.php';

	$html = "";
	$sender = mysqli_real_escape_string($connection, $_POST['sender']);

	if ($sender !== "admin") {
		$chats = $connection->query("SELECT * FROM chats WHERE sender='$sender' OR receiver='$sender' ORDER BY created_at ASC");

	}else {
		$receiver = mysqli_real_escape_string($connection, $_POST['receiver']);
		$chats = $connection->query("SELECT * FROM chats WHERE sender='$receiver' OR receiver='$receiver' ORDER BY created_at ASC");

	}

	if ($chats->num_rows < 1) {
		?>
			<div class="form-group row">
				<div class="col-md-10 mx-auto rounded bg-light py-5 text-center border">
					<p class="h6">No recent messages.</p>
				</div>
			</div>
		<?php

	}else {
		while ($chatsRow = $chats->fetch_array()) {
		    
			if ($chatsRow['sender'] == $sender) {
				$position = "ml-auto";
				$textAlign = "text-right";
				$bgColor = "col-md-6 bg-secondary text-white rounded border py-1";
				$from = "You";
				$time = date("h:ia", strtotime($chatsRow['created_at']))." | ".date("M d, Y", strtotime($chatsRow['created_at']));
			}else {
				$position = "mr-auto";
				$textAlign = "text-left";
				$bgColor = "col-md-6 bg-light text-dark rounded border py-1";
				$from = $chatsRow['sender'];
				$time = date("h:ia", strtotime($chatsRow['created_at']))." | ".date("M d, Y", strtotime($chatsRow['created_at']));
			}
			?>
				<div class="form-group row">
					<div class="col-md-6 <?php echo $position; ?>">
						<div class="form-group row">
							<div class="col-md-12 <?php echo $textAlign; ?>">
								<p class="h6"><?php echo $from; ?></p>
							</div>
							<div class="col-md-12 <?php echo $bgColor; ?> <?php echo $textAlign; ?>">
								<p class="h6"><?php echo $chatsRow['message']; ?></p>
							</div>
							<div class="col-md-12 <?php echo $textAlign; ?>">
								<small class="text-secondary"><?php echo $time; ?></small>
							</div>
						</div>
					</div>
				</div>
			<?php
		}
	}

?>