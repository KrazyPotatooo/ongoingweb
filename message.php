<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender_name = $_POST['fullname'];

    // Fetch the receiver's name from the session
    $receiver_name = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : "DefaultReceiverName";

    $email = $_POST['email'];
    $message = $_POST['message'];

    $insert_query = $conn->prepare("INSERT INTO contact_messages (sender, receiver, email, message) VALUES (?, ?, ?, ?)");
    $insert_query->bind_param("ssss", $sender_name, $receiver_name, $email, $message);

    if ($insert_query->execute()) {
        header("location: contact_success.php");
    } else {
        header("location: contact_error.php");
    }

    $insert_query->close();
} else {
    header("location: contact_error.php");
}
?>
