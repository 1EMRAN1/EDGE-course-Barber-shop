<?php

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $age = $_POST["age"];
    $grade = $_POST["grade"];

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO students (name, age, grade) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $name, $age, $grade);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>
    <h2>Add Student</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Name:</label>
        <input type="text" name="name" required><br><br>
        <label>Age:</label>
        <input type="number" name="age" required><br><br>
        <label>Grade:</label>
        <input type="number" name="grade" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
