<?php
require 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .container {
            background-color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1rem;
            max-width: 700px;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            margin: auto;
            border: 0.5px solid black;
            margin-top: 150px;
        }

        .profile {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .name {
            font-size: 40px;
        }

        .details {
            font-size: 16px;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Appointments</h1>
        <?php 
        
        $conn = new mysqli('localhost', 'root', '', 'check_up');
        $status = "pending";
        $apptQuery = "SELECT * FROM appointments WHERE patient_id = ? AND status = ?";
        $apptStmt = $conn->prepare($apptQuery);
        $apptStmt->bind_param("is", $user['patient_id'], $status);
        $apptStmt->execute();
        $apptResult = $apptStmt->get_result();

        if ($apptResult->num_rows < 0) {
            $error_msg = '<div class="error-message">Nothing Found.<br></div>';
            $apptStmt->close();
            $conn->close();
        }
        else {
            while ($row = $apptResult->fetch_assoc()) {
                echo "Doctor Name: " . $row['doctor_name'] . "<br>";
                echo "Date: " . $row['appointment_date'] . "<br>";
                echo "Day: " . $row['day'] . "<br>";
                
            }
        }
        ?>

    </div>
</body>

</html>
