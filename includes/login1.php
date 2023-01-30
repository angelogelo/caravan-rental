<?php
require_once "db.php";

$client_email = $_POST['email'];
$password = $_POST['password'];

$time_logged = date("Y-m-d H:i:s", strtotime("now"));
$activity = "Login";

$sql = "SELECT id, client_email,email_verified_at, password FROM client_accs WHERE client_email = ?";
if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $param_client_email);
    $param_client_email = $client_email;
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $id, $client_email, $status, $hashed_password);
            if (mysqli_stmt_fetch($stmt)) {
                if (password_verify($password, $hashed_password)) {

                    if ($status == NULL) {
                        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

                        // insert in users table
                        $uSql = "UPDATE client_accs SET verification_code='$verification_code' WHERE client_email='$client_email'";
                        $uQuery = mysqli_query($link, $uSql);

                        if ($uQuery) {
                            $result['status'] = $verification_code;

                        } else {
                            $result['status'] = 'error';
                        }
                    } else {
                        $result['status'] = $id;
                    }

                    echo json_encode($result);

                    $logs = "INSERT INTO activity_log (client_id,activity_time,activity_desc,other_details) VALUES($id,'$time_logged','$activity',NULL) ";
                    $query = mysqli_query($link, $logs);

                } else {
                    $result['status'] = 'error';
                    echo json_encode($result);
                }
            } else {
                $result['status'] = 'error';
                echo json_encode($result);
            }
        } else {
            $result['status'] = 'error';
            echo json_encode($result);
        }
    } else {
        $result['status'] = 'error';
        echo json_encode($result);
    }
}

?>