<?php

    include 'connection.php';

    $payment_id = $_POST['payment_id'];
    $amount = $_POST['amount'];
    $customer_id = $_POST['customer_id'];

    $booking_id = $_POST['booking_id'];
    $transaction_no = $_POST['transaction_no'];

    $update = $connection->query("UPDATE tbl_rents SET transaction_no = '$transaction_no' WHERE id = '$booking_id'");
    
    if($update === TRUE){

        $update_transaction_on_rents = $connection->query("UPDATE tbl_payment SET status = 1, confirmation_date = '$timeNow' WHERE id = '$payment_id'");

        include '../functions/send-email.php';

		$select = $connection->query("SELECT * FROM user WHERE id = '$customer_id'");
		$select_row = $select->fetch_array();

        $email = $select_row['email'];
        $name = $select_row['firstname'].' '.$select_row['lastname'];

		$to = $email;

		$subject = 'Payment Confirmation';
        $body = '
        <!DOCTYPE html>
        <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
            <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width,initial-scale=1">
            <meta name="x-apple-disable-message-reformatting">
            <title></title>
            <!--[if mso]>
            <noscript>
                <xml>
                <o:OfficeDocumentSettings>
                    <o:PixelsPerInch>96</o:PixelsPerInch>
                </o:OfficeDocumentSettings>
                </xml>
            </noscript>
            <![endif]-->
            <style>
                table, td, div, h1, p {font-family: Arial, sans-serif;}
            </style>
            </head>
            <body style="margin:0;padding:0;">
                <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
                    <tr>
                        <td align="center" style="padding:0;">
                            <table role="presentation" style="width:500px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                                <tr>
                                    <td align="center" style="padding: 40px 0 40px 0; background:#70bbd9;">
                                        <img src="https://www.kindpng.com/picc/m/285-2852276_email-id-verification-reminder-plugin-verify-email-illustration.png" alt="" width="400" style="height:auto;display:block;" />
                                    </td>
                                </tr>
            
                                <tr>
                                    <td style="padding:36px 30px 42px 30px;">
                                        <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                            <tr>
                                                <td style="padding:0 0 36px 0;color:#153643;">
                                                    <center>
                                                        <h1 style="margin:0 0 20px 0;font-family:Arial,sans-serif; color: green;"">Payment Confirmation</h1>
                                                    </center><hr>
                                                    
                                                    <h2 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Hi '.ucwords($name).'</h2>
                                                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">This is just a quick email to say weve recieved your payment via Gcash.</p>
                                                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">Once everything is confirmed, well send you another email of other information of your booking.
                                                    </p><br><br><br><br><br>
                                                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                                        If you have any questions, please send an email to below.
                                                    <a href="#">caravanrental0001@gmail.com</a> 
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
            
                            </table>    
                        </td>
                    </tr>
                </table>
            </body>
        </html>
        ';

		sendMail($to, $name, $subject, $body);
        
        echo "Added";
    }else{
        echo "Failed";
    }
   
?>