<?php
  
  include 'includes/connection.php';
    $Customer_Username = $_GET["username"];

    //$username = $_SESSION['customer'];
    $customer = $connection->query("SELECT * FROM user WHERE username='$Customer_Username'");
    $customer_info = $customer->fetch_array();

    $id_number = $customer_info['id'];

  

  $chats = $connection->query("SELECT * FROM chat_reference WHERE student_id = '$id_number' ORDER BY created_at");

  $activeName = $customer_info['firstname']." ".$customer_info['lastname'];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CARAVAN &middot; RENT A CAR</title>
    
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700&display=swap" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Logo -->
    <link rel="icon" href="assets/images/caravan.png">
    <!-- Light Slider -->
    <link rel="stylesheet"  href="assets/lightslider/src/css/lightslider.css"/>
    </head>

    <body class="hold-transition login-page">
        <h3><?php echo $activeName; ?></h3>
        <div class="login-box" style="width: 80%;">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <?php if (!isset($Customer_Username)) { ?>

                        <button type="button" class="btn btn-primary btn-sm ml-3 mb-3" onclick="loginFirst()" style="position: fixed; left: 10px; bottom: 10px;"><i class="fa fa-comment"></i> Chat</button>

                        <?php //} else if($chats->num_rows < 1){ ?>

                        <!-- <div class="colg-lg-12">
                            <form action="" method="POST" id="chatForm">
                                <div class="card-header">
                                    <div class="card-tools">
                                        <a href="includes/logoutCustomer.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="container">
                                    <div class="form-group row">
                                        <div class="col-md-10 mx-auto rounded bg-light py-5 text-center border">
                                            <p class="h6">No recent messages.</p>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-10">
                                        <textarea name="message" id="message" class="form-control form-control-sm" placeholder="Type your message here" rows="3" required></textarea>
                                        </div>
                                        <div class="col-md-2">
                                        <input type="hidden" name="sender" id="sender" value="<?php //echo $id_number; ?>">
                                        <button type="submit" class="btn btn-primary btn-sm mb-3 w-100"><i class="fa fa-paper-plane"></i> Send</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        </div> -->

                        <?php } else { ?>

                        <div class="col-lg-12">
                            <form action="" method="POST" id="chatForm">
                                <div class="card-header">
                                    <h3 class="card-title">Caravan Rental</h3>
                                    
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
                                        <input type="hidden" name="sender" id="sender" value="<?php echo $id_number; ?>">
                                        <button type="submit" class="btn btn-primary btn-sm mb-3 w-100"><i class="fa fa-paper-plane"></i> Send</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="assets/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="assets/dist/js/adminlte.min.js"></script>
        <!-- Sweetalert -->
        <script src="assets/sweetalert/sweetalert.min.js"></script>
        <!-- DataTables -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="assets/plugins/select2/js/select2.full.min.js"></script>
        <!-- bs-custom-file-input -->
        <script src="assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
        <!-- ChartJS -->
        <script src="assets/plugins/chart.js/Chart.min.js"></script>
        <script src="assets/chart.js/Chart.js"></script>
        <script src="assets/lightslider/src/js/lightslider.js"></script>
    </body>
</html>


<!-- <script type="text/javascript">

    function loginFirst() {
      swal({
        title: "Log in first to use chat.",
        icon: "warning"
      }).then(function() {
        window.location.href = "customer.php";
      });
    }

    function showChat(sender) {
      var user = "client";
      $.ajax({
        url: "includes/clientSeen.php",
        method: "POST",
        dataType: "TEXT",
        data: {
          receiver: sender
        },
        success: function(data) {

        }
      });

      fetchChat(sender, user);
      $('#showChat').modal('show');
      setTimeout(function() {
        try {
          var chatMessages = document.getElementById('chatMessages');
          chatMessages.scrollTop = chatMessages.scrollHeight;
        } catch (err) {

        }
      }, 1000);
    }

    function fetchChat(sender, user) {
      $.ajax({
        url: "includes/fetchChat.php",
        method: "POST",
        dataType: "HTML",
        data: {
          sender: sender,
          user: user
        },
        success: function(data) {
          //console.log(data);
          $('#chatMessages').html(data);
          toBottom();
        }
      });
    }

</script> -->


<script type="text/javascript">
    $(document).ready(function() {
      var sender = <?php echo (isset($Customer_Username)) ? $id_number : 0; ?>;
      var user = "client";
      var receiver = "admin";

      setInterval(function() {
        fetchChat(sender, user);
      }, 1000);

      setInterval(function() {
        $.ajax({
          url: "includes/notifCount.php",
          method: "POST",
          dataType: "TEXT",
          data: {
            sender: sender
          },
          success: function(data) {
            $('#notifCount').text(data)
          }
        });
      }, 1500);

      $('#chatForm').submit(function(e){
		  e.preventDefault();
		  var message = $('#message').val();
		  var sender = $('#sender').val();

		  sendChat(sender, message, receiver);
		});

		var chatMessages = document.getElementById('chatMessages');
		chatMessages.scrollTop = chatMessages.scrollHeight;

		$(document).on('click', '.fetchChat', function() {
			var student_id = $(this).attr('data-student-id');
			var activeName = $(this).attr('data-active-name');
			receiver = student_id;
			$('#activeName').text(activeName);
			fetchChat(student_id, user, receiver);
		});

    });

    function validate(id) {
      var element = document.getElementById(id);
      element.value = element.value.replace(/[^a-zA-Z ]+/, '');
    };

    function logout() {
      window.location.replace('includes/logoutClient.php');
    }

    function showChat(sender) {
      var user = "client";

      $.ajax({
        url: "includes/clientSeen.php",
        method: "POST",
        dataType: "TEXT",
        data: {
          receiver: sender
        },
        success: function(data) {
        console.log(data);
        }
      });

      fetchChat(sender, user);
      // $('#showChat').modal('show');
      setTimeout(function() {
        try {
          var chatMessages = document.getElementById('chatMessages');
          chatMessages.scrollTop = chatMessages.scrollHeight;
        } catch (err) {

        }
      }, 1000);
    }

    function fetchChat(sender, user) {
      $.ajax({
        url: "includes/fetchChat.php",
        method: "POST",
        dataType: "HTML",
        data: {
          sender: sender,
          user: user
        },
        success: function(data) {
          //console.log(data);
          $('#chatMessages').html(data);
          toBottom();
        }
      });
    }

    var receiver = "admin";

    function options(sender) {
      swal({
        text: "Select an option below",
        buttons: {
          cancel: "Cancel",
          withPay: "Do I need to pay to get my document?",
          longProcess: "Does is take month(s) to get my document?",
          representative: "Does my relatives get my document if I'm not available?"
        }
      }).then(function(event) {
        if (event == "withPay") {
          var message = "Do I need to pay to get my document?";
          sendChat(sender, message, receiver);

        } else if (event == "longProcess") {
          var message = "Does is take month(s) to get my document?";
          sendChat(sender, message, receiver);

        } else if (event == "representative") {
          var message = "Does my relatives get my document if Im not available?";
          sendChat(sender, message, receiver);

        } else {
          //
        }
      });
    }

    function sendChat(sender, message) {
      $.ajax({
        url: "includes/sendChat.php",
        method: "POST",
        dataType: "TEXT",
        data: {
          sender: sender,
          message: message,
          receiver: receiver
        },
        success: function(data) {
          console.log(data);

          if (data == "Saved") {
            var user = "client";
            fetchChat(sender, user);
            $('#message').val("");
          }
        }
      });
    }

    function toBottom() {
      try {
        var chatMessages = document.getElementById('chatMessages');
        chatMessages.scrollTop = chatMessages.scrollHeight;
      } catch (err) {

      }
    }

    function loginFirst() {
      swal({
        title: "Log in first to use chat.",
        icon: "warning"
      }).then(function() {
        window.location.href = "index.php";
      });
    }
</script>