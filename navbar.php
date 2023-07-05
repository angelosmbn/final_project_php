<?php
session_start(); // Start the session
// Retrieve the user details from the session
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

$Name = ""; // Initialize the variable

if ($user && $user['role'] == 'doctor') {
    $Name = "Dr. " . $user['name'];
}
if ($user && $user['role'] == 'patient') {
    $Name = $user['name'];
}

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Variable to indicate if navbar.php is included in login.php or signup.php
$isLoginPage = basename($_SERVER['PHP_SELF']) === 'login.php';
$isSignupPage = basename($_SERVER['PHP_SELF']) === 'signup.php';


$conn = new mysqli('localhost', 'root', '', 'check_up');




?>
<!DOCTYPE html>
<html>
<head>
<style>
    body {
        margin: 0;
        padding: 0;
    }

    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: #2c3e50;
      padding: 10px;
      width: 100%;
      height: 13vh;
    }

    .navbar-logo {
      width: 150px;
      height: auto;
      mix-blend-mode: multiply;
    }

    .navbar-menu {
      display: flex;
      list-style: none;
      padding: 0;
      margin-right: 80px;
    }

    .navbar-menu li {
      margin-left: 20px;
    }

    .navbar-menu a {
      color: white;
      text-decoration: none;
    }

    .navbar-menu a:hover {
      color: #8e12f3;
    }

    .user-image {
      padding-right: 10px;
      padding-top: 10px;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      float: right;
      margin-left: 20px;
      margin-top: -30px;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #567a9e;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 1;
      margin-top: 30px;
      margin-left: 20px;
    }

    .dropdown:hover .dropdown-content {
      color: black;
      display: block;
    }

    .dropdown-content a, h3 {
      color: white;
      padding: 12px 16px;
      display: block;
    }

    .dropdown-content a:hover {
      background-color: #2c3e50;
    }
</style>
</head>
<body>
    <div class="navbar">
        <img src="https://lh3.googleusercontent.com/drive-viewer/AFGJ81oPLY3tWwP5Ehvtv0-5ucfnf0ht4a204opiPOE9q4EjYrsrfHfAHVwX3L9Uk-sSdnEYQa7LZAZ8Rqnz7uYEbCcOPN29cg=s2560" class="navbar-logo" />
        <ul class="navbar-menu">
            <li><a href="Home-Page.php">Home</a></li>
            <?php
            if ($user && $user['role'] == 'patient') {
                echo '<li><a href="show_doctors.php">Doctors</a></li>';
            }
            if ($user && $user['role'] == 'doctor'){
                echo '<li><a href="doctorAppointment.php">My Appointments</a></li>';
            }else{
              echo '<li><a href="patientAppointment.php">My Appointments</a></li>';
            }
            ?>
            <li><a href="about.php">About</a></li>
            <?php if (!$isLoginPage && !$isSignupPage) {?>
                <div class="dropdown">
                    <img class="user-image" src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg" alt="Profile Image">
                    <div class="dropdown-content">
                        <?php
                        if (!isset($_SESSION['user'])) {
                            echo '<a href="signup.php">Sign-up</a>';
                            echo '<a href="login.php">Login</a>';
                        } else {
                            echo '<h3>' . $Name . '</h3>';
                            echo '<a href="profile.php">Profile</a>';
                            echo '<a href="settings.php">Account Settings</a>';
                            if ($user['role'] == 'doctor') {
                                echo '<a href="#">My Clinic</a>';
                            }
                            echo '<a href="?logout=true">Log Out</a>';
                        }
                        ?>
                    </div>
                </div>
            <?php }?>
        </ul>
    </div>
</body>
</html>
