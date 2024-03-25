<?php
require_once('../dbengine/dbconnect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_GET['accept'])) {
    $order = mysqli_real_escape_string($conn, $_GET['accept']);

    $query = "SELECT contact FROM booking_details WHERE order_ref=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $order);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $to = $row['contact'];

    $updateQuery = "UPDATE booking_details SET status='Accepted' WHERE order_ref=?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("s", $order);
    $updateStmt->execute();

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'georgetanarayana@gmail.com'; // Your Gmail
    $mail->Password = 'prdr zdbe epqq iptc'; // Your Gmail app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('georgetanarayana@gmail.com'); // Your Gmail
    $mail->addAddress($to);
    $mail->isHTML(true);

    $mail->Subject = "Booking Confirmed!";
    $mail->Body = "Your booking (Order Ref: <span style='color:red;'>{$order}</span>) is confirmed. 
    Please keep this Order Ref number safe and never share it with anyone. 
    This reference number is used to reprint lost tickets. 
    Click <a href='http://localhost/Ticket_Reservation_system/booking/validate.php?ticket={$order}&validate'><u>HERE</u></a> to download your ticket.<br><br>
    
    <a style='display: inline-block; background-color: #4CAF50; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;' href='http://localhost/Ticket_Reservation_system/booking/validate.php?ticket={$order}&validate'>Download Ticket</a>";

    // Attempt to send the email
    if ($mail->send()) {
        header("Location: bookings.php?mailsent=true");
        exit;
    } else {
        error_log('Mail failed to send for order ' . $order);
        header("Location: bookings.php?error=mailfailed");
        exit;
    }
}
?>