<?php
$servername = "localhost";
$user_name = "root";
$pass_word = "";
$database_name = "project";

// Create connection
$conn = new mysqli($servername, $user_name, $pass_word, $database_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $service = $_POST['service'];
    $hobbies = $_POST['hobby'];

    if (is_array($hobbies)) {
        $hobbies = implode(',', $hobbies);
    } else {
        $hobbies = $hobbies;
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO register (name, age, address, email, hobby, gender, country, service) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissssss", $name, $age, $address, $email, $hobbies, $gender, $country, $service);

    if ($stmt->execute()) {
        header("Location: Log.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>