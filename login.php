<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT password FROM users WHERE username='$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            echo "Your login is successful";
        } else {
            echo "You have entered an invalid password";
        }
    } else {
        echo "No user found";
    }
}

$conn->close();
?>
