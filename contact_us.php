<?php
$db_hostname = "127.0.0.1";
$db_username = "root";
$db_password = "";
$db_name = "tour";

header("Content-Type: application/json");

$conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
if (!$conn) {
    echo json_encode(["status" => "error", "message" => "Database connection failed."]);
    exit;
}

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$sql = "INSERT INTO contact (Name, Email, Phone, Subject, Message)
        VALUES ('$name', '$email', '$phone', '$subject', '$message')";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo json_encode(["status" => "success", "message" => "Your message has been sent successfully!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error saving message."]);
}

mysqli_close($conn);
?>
