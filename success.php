<!DOCTYPE html>
<html>
<head>
    <title>Success</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f5f5f5;
        }
        .success-message {
            border: 1px solid black;
            padding: 10px;
            border-radius: 5px;
            font-size: 1.25rem;
            line-height: 1.75rem;
            font-weight: 600;
            text-align: center;
            color: #000;
        }

        .success-message a {
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $telephone = $_POST['telephone'];

            if (substr($telephone, 0, 1) === '0') {
                $telephone = '63' . substr($telephone, 1);
            }

            $email = $_POST['email'];
            $street = $_POST['street'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zip = $_POST['postal'];
            $country = $_POST['country'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];

            $role = isset($_POST['role']) ? $_POST['role'] : '';
            $specializations = isset($_POST['specialization']) ? $_POST['specialization'] : [];
            $licenses = isset($_POST['license']) ? $_POST['license'] : [];

            $specializationsString = implode(', ', $specializations);
            $licensesString = implode(', ', $licenses);
        }
    
        $conn = new mysqli('localhost', 'root', '', 'check_up');
        if ($conn->connect_error) {
            echo '<div class="success-message">
                Account NOT successfully created! Please
                <a href="login.php">Try Again</a>
            </div>';

            die("Connection failed: ". $conn->connect_error);
        }
        else{
            if($role == "patient"){
            $stmt = $conn->prepare("insert into patient(firstName, lastName, age, gender, phoneNumber, email, street, city, state, postal, country, role, password)
                values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssisissssisss", $firstName, $lastName, $age, $gender, $telephone, $email, $street, $city, $state, $zip, $country, $role, $password);
            }
            else{
                $stmt = $conn->prepare("insert into doctor(firstName, lastName, specialization, licenseNumber ,age, gender, phoneNumber, email, street, city, state, postal, country, role, password)
                values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssisissssisss", $firstName, $lastName, $specializationsString, $licensesString, $age, $gender, $telephone, $email, $street, $city, $state, $zip, $country, $role, $password);
            }
            $stmt->execute();
            echo '<div class="success-message">
                Account successfully created! Please
                <a href="login.php">Sign in</a>
            </div>';
            $stmt->close();
            $conn->close();
        }
?>

    <div class="success-message">
        Account successfully created! Please
        <a href="login.php">Sign in</a>
    </div>
    
</body>
</html>
