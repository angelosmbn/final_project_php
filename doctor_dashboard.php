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

    if($user['role'] == 'doctor'){
        $drName = "Dr. " . $user['firstName'] . " " . $user['lastName'];
    }

    // Logout logic
    if (isset($_GET['logout'])) {
        session_destroy();
        header("Location: login.php");
        exit();
    }
?>

<body>
    <h1>Welcome, <?php echo $drName; ?>!</h1>
    <p>Email: <?php echo $user['email']; ?></p>
    <p>Age: <?php echo $user['age']; ?></p>
    <p>Role: <?php echo $user['role']; ?></p>
    <!-- Display more user details as needed -->
    <a href="?logout=true">Logout</a>
</body>
