<?php
    $page = 'message';
    include 'header.php';
?>


<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"> Messages</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col">
                        <input type="text" name="searchcustomer" id="searchcustomer" class="form-control form-control-lg" style="border-radius: 25px;" placeholder="Search Customer">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col" style="height: 290px; overflow-y: auto;">
                        <div class="list-group" id="list-tab" role="tablist">
                            <?php  
                                $chats = $connection->query("SELECT * FROM chat_reference ORDER BY created_at DESC");
                                if ($chats->num_rows < 1) {
                                    ?>
                                        <a class="list-group-item list-group-item-action disabled">No message(s) yet</a>
                                    <?php
                                }else {
                                    $active = 1;
                                    while ($chatsRow = $chats->fetch_array()) {
                                        $customer_id = $chatsRow['customer_id'];
                                        $customers = $connection->query("SELECT * FROM user WHERE id='$customer_id'");
                                        $customersRow = $customers->fetch_array();

                                        if ($active == 1) {
                                            $activeCustomer = $customer_id;
                                            $activeName = $customersRow['firstname']." ".$customersRow['lastname'];
                                        }else {
                                            $notactivecustomer = 0;
                                            $notactiveName = $customersRow['firstname']." ".$customersRow['firstname'];
                                        }

                                        ?>
                                            <a class="list-group-item list-group-item-action fetchChat <?php echo ($active == 1) ? "active" : ""; ?>" id="messages-list" data-customer-id="<?php echo $chatsRow['customer_id']; ?>" data-active-name="<?php echo ($active == 1) ? $activeName: $notactiveName; ?>" data-toggle="list" href="#messages" role="tab" aria-controls="home"><?php echo $customersRow['firstname']." ".$customersRow['lastname']; ?></a>
                                        <?php

                                        $active++;
                                    }
                                }
                            ?>
                    </div>
                    <div class="list-group" id="list-tab2" role="tablist" style="display: none;">
                        <div id="searchcustomerResult"></div>
                    </div>
                    </div>
                </div>
            </div><!-- /.col-lg-4 -->


            <div class="col-lg-8">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="messages" role="tabpanel" aria-labelledby="messages-list">
                        <?php  
                            if ($chats->num_rows < 1) {
                                    ?>
                                        <div class="card shadow">
                                            <div class="card-header">
                                                <div class="row col-md-12 d-flex justify-content-end">
                                                    No Message
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-md-10 mx-auto">
                                                        <div class="jumbotron text-center"><p class="h4">No message(s) yet</p></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }else {
                                ?>
                                    <div class="card shadow">
                                        <form action="" method="POST" id="chatForm">
                                            <div class="card-header">
                                                <h3 class="card-title"><?php echo ucwords($activeName); ?></h3>
                                                <!--<div class="row col-md-12 d-flex justify-content-end">-->
                                                <!--    <span id="activeName"></span>-->
                                                <!--</div>-->
                                            </div>
                                            <div class="card-body">
                                                <div class="container">
                                                <div class="modal-body-custom px-3" id="chatMessages" style="height: 290px !important; overflow-y: auto;">
                                                    <!--  -->
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-10">
                                                    <textarea name="message" id="message" class="form-control form-control-sm" placeholder="Type your message here" rows="3" required></textarea>
                                                    </div>
                                                    <div class="col-md-2">
                                                    <input type="hidden" name="sender" id="sender" value="admin">
                                                    <button type="submit" class="btn btn-primary btn-sm mb-3 w-100"><i class="fa fa-paper-plane"></i> Send</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div><!-- /.col-lg-8 -->
        
        </div>
    </div><!-- /.container-fluid -->
</div><!-- /.content -->

<?php include 'footer.php' ?>

<script>
    $(function(){

        $('#invoiceListTables').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            iDisplayLength: 25,
        });

    });
</script>

<script type="text/javascript">

	var receiver = <?php echo json_encode($activeCustomer); ?>;
	var sender = "admin";
	var user = "admin";

	$(document).ready(function(){

		setInterval(function(){
		  fetchChat(sender, user, receiver);
		}, 1000);

		fetchChat(sender, user, receiver);

		$('#chatForm').submit(function(e){
		  e.preventDefault();
		  var message = $('#message').val();
		  var sender = $('#sender').val();

		  sendChat(sender, message, receiver);
		});

		var chatMessages = document.getElementById('chatMessages');
		chatMessages.scrollTop = chatMessages.scrollHeight;

		$(document).on('click', '.fetchChat', function() {
			var customer_id = $(this).attr('data-customer-id');
			var activeName = $(this).attr('data-active-name');
			receiver = customer_id;
			$('#activeName').text(activeName);
			fetchChat(customer_id, user, receiver);
		});

       

	});

	function fetchChat(sender, user, receiver) {
	  $.ajax({
	    url: "../includes/fetchChat.php",
	    method: "POST",
	    dataType: "HTML",
	    data: {
	      sender: sender,
	      user: user,
	      receiver: receiver
	    },success: function(data) {
	      //console.log(data);
	      $('#chatMessages').html(data);
	      toBottom();
	    }
	  });
	}

	function sendChat(sender, message) {
	  $.ajax({
	    url: "../includes/sendChat.php",
	    method: "POST",
	    dataType: "TEXT",
	    data: {
	      sender: sender,
	      message: message,
	      receiver: receiver
	    },success: function(data) {
        console.log(data);
	      if (data == "Saved") {
	        var user = "client";
	        fetchChat(sender, user, receiver);
	        $('#message').val("");
	      }
	    }
	  });
	}

	function toBottom() {
	  var chatMessages = document.getElementById('chatMessages');
	  chatMessages.scrollTop = chatMessages.scrollHeight;
	}

	$('#searchcustomer').keyup(function() {
		var data = $(this).val();

		$.ajax({
			url: "../includes/searchcustomer.php",
			method: "POST",
			dataType: "HTML",
			data: {
				data: data
			},success: function(result) {
				if (data == "") {
					$('#list-tab').show();
					$('#list-tab2').hide();
				}else if (data !== "") {
					$('#list-tab').hide();
					$('#searchcustomerResult').html(result);
					$('#list-tab2').show();
				}
			}
		})
	});
</script>