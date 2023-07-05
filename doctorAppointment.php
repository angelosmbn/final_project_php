<?php
require 'navbar.php';
$doctorId = $user['doctor_id'];
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

    <form action="" method="post">
        <div class="container">
            <select id="hospitalSelect" name="hospitalSelect">
                <option value="" selected disabled>Select an Clinic</option>
                <?php
                $conn = new mysqli('localhost', 'root', '', 'check_up');
                // Assuming you have established a database connection in $conn variable
                $query = "SELECT clinic_name, day FROM `clinic-schedule` WHERE doctor_id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $doctorId);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $clinicName = $row['clinic_name'] . " (" . $row['day'] . ")";
                        $day = $row['day'];
                        echo "<option value=\"$clinicName\">$clinicName</option>";
                    }
                }
                ?>

            </select>
            <input type="date" name="appointment_date"></input>
            <button type="submit">Submit</button>

            <div class="schedules">
                <?php

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $conn = new mysqli('localhost', 'root', '', 'check_up');
                    if (isset($_POST['hospitalSelect'])) {
                        $clinic = $_POST['hospitalSelect'];

                        $clinicName = substr($clinic, 0, strpos($clinic, '(') - 1);
                        //$day = substr($clinic, strpos($clinic, '(') + 1, -1);
                        $appointment_date = date("m/d/Y", strtotime($_POST['appointment_date']));
                    }


                    $apptQuery = "SELECT * FROM appointments WHERE doctor_id = ? AND clinic_name = ? AND appointment_date = ?";
                    $apptStmt = $conn->prepare($apptQuery);
                    $apptStmt->bind_param("iss", $doctorId, $clinicName, $appointment_date);
                    $apptStmt->execute();
                    $apptResult = $apptStmt->get_result();

                    if ($apptResult->num_rows < 0) {
                        $error_msg = '<div class="error-message">Nothing Found.<br></div>';
                        $apptStmt->close();
                        $conn->close();
                    } else {
                        while ($row = $apptResult->fetch_assoc()) {
                            // Print each row of the result
                            echo "Done:<input type='radio' name='appointment_ids[]' value='" . $row['appointment_id'] . "'>";
                            echo "Failed:<input type='radio' name='failed_ids[]' value='" . $row['appointment_id'] . "'>";
                            echo "<br>Patient Name: " . $row['patient_name'] . "<br>";
                            echo "Age: " . $row['patient_age'] . "<br>";
                            echo "Gender: " . $row['patient_gender'] . "<br>";
                            echo "Phone: " . $row['patient_phone'] . "<br>";
                            echo "Email: " . $row['patient_email'] . "<br><br>";
                        }

                        if (isset($_POST['hospitalSelect'])) {
                            echo '<button type="submit" name="done">Done</button>';
                        }
                    }
                }

                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['done'])) {
                    if (isset($_POST['appointment_ids'])) {
                        $done_ids = $_POST['appointment_ids'];
                        $failed_ids = $_POST['failed_ids'];

                        foreach ($done_ids as $id) {
                            $query = "UPDATE appointments SET status = 'done' WHERE appointment_id = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("i", $id);
                            $stmt->execute();
                            $stmt->close();
                        }

                        foreach ($failed_ids as $id) {
                            $query = "UPDATE appointments SET status = 'failed' WHERE appointment_id = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("i", $id);
                            $stmt->execute();
                            $stmt->close();
                        }
                    }
                }

                ?>
            </div>


        </div>
    </form>
</body>

</html>
