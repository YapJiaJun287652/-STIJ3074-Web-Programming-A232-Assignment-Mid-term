<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $stmt = $conn->prepare('INSERT INTO users (name, email, password, phone, address) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('sssss', $name, $email, $password, $phone, $address);

    if ($stmt->execute()) {
        header('Location: login.php'); 
        exit(); 
    } else {
        if ($stmt->errno == 1062) {
            header('Location: register.php?message=email_taken');
        } else {
            header('Location: register.php?message=error');
        }
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clinic Registration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="scripts.js" defer></script>
</head>
<body>
    <div class="container">
        <h1 class="title">Clinic</h1>
        <div class="registration-form">
            <form id="registrationForm" action="register.php" method="POST" onsubmit="return validateRegistrationForm()">
                <h2>Register</h2>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea id="address" name="address" required class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
            <p id="registrationMessage"></p>
            <p>Already have an account? <a href="login.php">Login now!</a></p>
        </div>
    </div>
</body>
</html>
