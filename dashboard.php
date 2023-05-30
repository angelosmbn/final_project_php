<?php
    session_start(); // Start the session

    // Check if the user is logged in
    if (!isset($_SESSION['user'])) {
        // User is not logged in, redirect to the login page
        header("Location: login.php");
        exit();
    }

    // Retrieve the user details from the session
    $user = $_SESSION['user'];
?>

<body>
    <h1>Welcome, <?php echo $user['first_name']; ?>!</h1>
    <p>Email: <?php echo $user['email']; ?></p>
    <p>Age: <?php echo $user['age']; ?></p>
    <!-- Display more user details as needed -->
    <a href="login.php">Logout</a>
</body>
