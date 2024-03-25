<?php
require_once('../dbengine/dbconnect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_GET['reject'])) {
    $order = mysqli_real_escape_string($conn, $_GET['reject']);

    $query = "SELECT contact FROM booking_details WHERE order_ref=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $order);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $to = $row['contact'];

    $updateQuery = "UPDATE booking_details SET status='Rejected' WHERE order_ref=?";
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

    $mail->Subject = "Booking Rejected!";
    $mail->Body = "Unfortunately your payment could not be verified. Please contact support. 
    Click <a href='http://localhost/Ticket_Reservation_system/booking/booking.php?order={$order}'><u>HERE</u></a> to go back to booking.<br><br> 
    
    <a style='display: inline-block; background-color: #4CAF50; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;' href='http://localhost/Ticket_Reservation_system/booking/booking.php?order={$order}'>Book Ticket!</a>";

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