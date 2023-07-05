<?php 
    require 'navbar.php';
    if(!isset($user)){
        // Redirect to the patient dashboard page
        header("Location: login.php");
        exit();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $clinic_name = $_POST["clinic_name"];
        $day = $_POST["day"];
        $start = $_POST["starthr"];
        $end = $_POST["endhr"];
        $max = $_POST["max_patients"];

        $conn = new mysqli('localhost', 'root', '', 'check_up');
        if ($conn->connect_error) {
            $con_error_msg = "<div class='error-message'>Connection failed: " . $conn->connect_error . "</div>";
            die("Connection failed: " . $conn->connect_error);
        }
        else {
            $stmt_check = $conn->prepare("SELECT * FROM `clinic-schedule` WHERE doctor_id = ? AND clinic_name = ? AND day = ? AND start_hour = ? AND end_hour = ? AND max_patients = ?");
            $stmt_check->bind_param("issiii", $user['doctor_id'], $clinic_name, $day, $start, $end, $max);
            $stmt_check->execute();
            $result_check = $stmt_check->get_result();

            
            if ($result_check->num_rows > 0) {
                $schedule_error_msg = '<div class="error-message">Schedule Already Taken.<br></div>';
                $stmt_check->close();
                $conn->close();
            }
            else{

                $stmt_conflict = $conn->prepare("SELECT * FROM `clinic-schedule` WHERE doctor_id = ? AND day = ? AND ((start_hour <= ? AND end_hour > ?) OR (start_hour < ? AND end_hour >= ?) OR (start_hour >= ? AND end_hour <= ?))");
                $stmt_conflict->bind_param("isiiiiii", $user['doctor_id'], $day, $start, $start, $end, $end, $start, $end);
                $stmt_conflict->execute();
                $result_conflict = $stmt_conflict->get_result();
                
                if ($result_conflict->num_rows > 0) {
                    $schedule_error_msg = '<div class="error-message">Schedule Conflict.<br></div>';
                    $stmt_conflict->close();
                    $conn->close();
                }
                else{
                    $stmt = $conn->prepare("INSERT INTO `clinic-schedule` (doctor_id, clinic_name, day, start_hour, end_hour, max_patients)
                        VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("issiii", $user['doctor_id'], $clinic_name, $day, $start, $end, $max);
                    $stmt->execute();

                    $success_msg = 'Successfully added a clinic!<br>';

                    $stmt->close();
                    $conn->close();

                    if(isset($schedule_error_msg)){
                        unset($schedule_error_msg);
                    }
                    
                }



                
            }
        }

    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="DoctorSchedules.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div class="container">
        <img class="profile-image" src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg">
        <div class="container-appointment">
            <form id="form1" method="post" action="DoctorSchedule.php">
                <h2>Add Hospital</h2>
                <input type="text" name="clinic_name" id="hospitalInput1" required placeholder="Enter Hospital" />

                <select id="daySelect1" name="day" required>
                    <option value="" selected disabled>Select a day</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
                <select id="startHourSelect" name="starthr" required>
                    <option value="" selected disabled>Select start hour</option>
                    <?php
                    for ($hour = 1; $hour <= 24; $hour++) {
                        if($hour < 12) {
                            echo "<option value=\"$hour\">$hour:00 AM</option>";
                        }
                        elseif($hour == 24) {
                            echo "<option value=\"$hour\">$hour:00 MIDNIGHT</option>";
                        }
                        else{
                            echo "<option value=\"$hour\">$hour:00 PM</option>";
                        }
                    }
                    ?>
                </select>
                <select id="endHourSelect" name="endhr" required>
                    <option value="" selected disabled>Select end hour</option>
                    <?php
                    for ($hour = 1; $hour <= 24; $hour++) {
                        if($hour < 12) {
                            echo "<option value=\"$hour\">$hour:00 AM</option>";
                        }
                        elseif($hour == 24) {
                            echo "<option value=\"$hour\">$hour:00 MIDNIGHT</option>";
                        }
                        else{
                            echo "<option value=\"$hour\">$hour:00 PM</option>";
                        }
                    }
                    ?>
                </select>
                <input type="number" id="max_patients" name="max_patients" required placeholder="Enter Max Patients" required/>
                <!--
                <select id="startHourSelect" name="starthr" required>
                    <option value="" selected disabled>Select start hour</option>
                    <option value="9">9:00 AM</option>
                    <option value="10">10:00 AM</option>
                    <option value="11">11:00 AM</option>
                    <option value="12">12:00 PM</option>
                </select>

                <select id="endHourSelect" name="endhr" required>
                    <option value="" selected disabled>Select end hour</option>
                    <option value="13">1:00 PM</option>
                    <option value="14">2:00 PM</option>
                    <option value="15">3:00 PM</option>
                    <option value="16">4:00 PM</option>
                    <option value="17">5:00 PM</option>
                </select>
                -->
                <?php 
                    if(isset($schedule_error_msg)){
                        echo $schedule_error_msg;
                    }
                    if(isset($success_msg)){
                        echo $success_msg;
                    }
                ?>
                <div class="btn-box-1">
                    <button type="submit">Add</button>
                </div>
            </form>
        </div>

    </div>


    <!--
    <script>
        let previousData = [];

        function addToPreviousDetails(hospital, day, startHour, endHour) {
            const previousDetails = document.getElementById('previousDetails');
            const listItem = document.createElement('li');
            listItem.textContent = `${hospital} - ${day}, ${startHour}:00 AM - ${endHour}:00 PM`;
            previousDetails.appendChild(listItem);
        }

        function clearFormInputs() {
            document.getElementById('hospitalInput1').value = '';
            document.getElementById('daySelect1').selectedIndex = 0;
            document.getElementById('startHourSelect').selectedIndex = 0;
            document.getElementById('endHourSelect').selectedIndex = 0;
        }
        
        document.getElementById('addFormButton').addEventListener('click', function (event) {
            event.preventDefault();

            const hospital = document.getElementById('hospitalInput1').value;
            const day = document.getElementById('daySelect1').value;
            const startHour = document.getElementById('startHourSelect').value;
            const endHour = document.getElementById('endHourSelect').value;

            const isDayAlreadySelected = previousData.some(data => data.day === day);

            if (isDayAlreadySelected) {
                alert('This day has already been selected.');
                return;
            }

            addToPreviousDetails(hospital, day, startHour, endHour);

            previousData.push({
                hospital: hospital,
                day: day,
                startHour: startHour,
                endHour: endHour
            });

            clearFormInputs();
        });
    </script>
    -->
</body>

</html>
