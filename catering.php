<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cuisine = $_POST['cuisine'];
    $people = $_POST['people'];
    $variety = $_POST['variety'];
    $mealType = $_POST['mealType'];

    $costPerPerson = 0;
    switch ($variety) {
        case 'standard':
            $costPerPerson = 100;
            break;
        case 'deluxe':
            $costPerPerson = 200;
            break;
        case 'premium':
            $costPerPerson = 300;
            break;
    }

    $totalCost = $people * $costPerPerson;

    switch ($mealType) {
        case 'breakfast':
            $totalCost *= 1;
            break;
        case 'lunch':
            $totalCost *= 1.2;
            break;
        case 'dinner':
            $totalCost *= 1.5;
            break;
        case 'full-day':
            $totalCost *= 3;
            break;
    }

    $sql = "INSERT INTO catering (cuisine, people, variety, mealType) VALUES ('$cuisine', '$people', '$variety', '$mealType')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        echo "Total Cost: ₹" . $totalCost;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>