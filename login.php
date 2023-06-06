<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f5f5f5;
        }

        .form {
            background-color: #fff;
            display: block;
            padding: 1rem;
            max-width: 350px;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            margin: auto;
            border: 0.5px solid black;
        }


        .form-title {
            font-size: 1.25rem;
            line-height: 1.75rem;
            font-weight: 600;
            text-align: center;
            color: #000;
        }

        .input-container {
            position: relative;
        }

        .input-container input, .form button {
            outline: none;
            border: 1px solid #e5e7eb;
            margin: 8px 0;
        }

        .input-container input {
            background-color: #fff;
            padding: 1rem;
            padding-right: 3rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            width: 250px;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .submit {
            display: block;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
            padding-left: 1.25rem;
            padding-right: 1.25rem;
            background-color: #4F46E5;
            color: #ffffff;
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 500;
            width: 100%;
            border-radius: 0.5rem;
            text-transform: uppercase;
        }

        .signup-link {
            color: #6B7280;
            font-size: 0.875rem;
            line-height: 1.25rem;
            text-align: center;
        }

        .signup-link a {
            text-decoration: underline;
        }
        .error-message{
            color: red;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #2c3e50;
            padding: 10px;
            position: relative;
        }

        .navbar-logo {
            width: 150px;
            height: auto;
            mix-blend-mode: multiply;
        }

        .navbar-menu {
            display: flex;
            list-style: none;
            position: relative;
        }

        .navbar-menu li {
            margin-left: 20px;
        }

        .navbar-menu a {
            color: white;
            text-decoration: none;
        }

        .navbar-menu a:hover {
            color: #f39c12;
        }

    </style>
    <div class="navbar"> 
        <img src="https://lh3.googleusercontent.com/drive-viewer/AFGJ81oPLY3tWwP5Ehvtv0-5ucfnf0ht4a204opiPOE9q4EjYrsrfHfAHVwX3L9Uk-sSdnEYQa7LZAZ8Rqnz7uYEbCcOPN29cg=s2560" class="navbar-logo" /> </a>
            <ul class="navbar-menu"> 
            <li><a href="Home-Page.php">Home</a></li> 
            <li><a href="show_doctor.php">Doctors</a></li> 
            <li><a href="#">About</a></li> 
        </ul> 
    </div>
</head>
<?php
    session_start(); // Start the session

    $error_message = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = sha1(sha1($_POST['password']));

        $conn = new mysqli('localhost', 'root', 'final123', 'check_up');
        if ($conn->connect_error) {
            $error_message = 'Unable to connect to the database. Please try again later.';
            die("Connection failed: " . $conn->connect_error);
        } else {
            $stmt_patient = $conn->prepare("SELECT * FROM patient WHERE email = ? AND password = ?");
            $stmt_patient->bind_param("ss", $email, $password);
            $stmt_patient->execute();
            $result_patient = $stmt_patient->get_result();

            $stmt_doctor = $conn->prepare("SELECT * FROM doctor WHERE email = ? AND password = ?");
            $stmt_doctor->bind_param("ss", $email, $password);
            $stmt_doctor->execute();
            $result_doctor = $stmt_doctor->get_result();
           

            if ($result_patient->num_rows > 0) {
                // Patient login successful
                $user = $result_patient->fetch_assoc();

                // Store user details in session variables
                $_SESSION['user'] = $user;

                // Redirect to the patient dashboard page
                header("Location: Home-Page.php");
                exit();
            } elseif ($result_doctor->num_rows > 0) {
                // Doctor login successful
                $user = $result_doctor->fetch_assoc();

                // Store user details in session variables
                $_SESSION['user'] = $user;

                // Redirect to the doctor dashboard page
                header("Location: Home-Page.php");
                exit();
            } else {
                // Login failed
                $error_message = 'Invalid email or password. Please try again.';
            }

            $stmt_patient->close();
            $stmt_doctor->close();
            $conn->close();
        }
    }
?>


<body>
    
    <form class="form" method="POST" action="login.php">
        <p class="form-title">Sign in to your account</p>
        <div class="input-container">
            <input type="email" name="email" placeholder="Enter email">
            <span></span>
        </div>
        <div class="input-container">
            <input type="password" name="password" placeholder="Enter password">
            <?php if (!empty($error_message)) { ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php } ?>
        </div>
        <button type="submit" class="submit">Sign in</button>

        <p class="signup-link">
            No account?
            <a href="signup.php">Sign up</a>
        </p>
    </form>
</body>



</html>