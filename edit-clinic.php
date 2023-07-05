<?php 
    require 'navbar.php';
    $doctorId = $user['doctor_id'];
    if(!isset($user)){
        // Redirect to the patient dashboard page
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="DoctorSchedules.css" rel="stylesheet" type="text/css">
    <script>
        function updateFormValues() {
            var clinicSelect = document.getElementById("hospitalSelect");
            var selectedClinic = clinicSelect.options[clinicSelect.selectedIndex].value;
            var values = selectedClinic.split(" (");
            var day = values[1].slice(0, -1);
            var startHour = values[0].split(":")[0];
            var endHour = values[0].split(":")[1];

            document.getElementById("daySelect1").value = day;
            document.getElementById("startHourSelect").value = startHour;
            document.getElementById("endHourSelect").value = endHour;
        }
    </script>
</head>

<body>
    <div class="container">
        <img class="profile-image" src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg">
        <div class="container-appointment">
            <form id="form1" method="post" action="DoctorSchedule.php">
                <select id="hospitalSelect" name="clinic_name" onchange="updateFormValues()">
                    <option value="" selected disabled>Select a Clinic</option>
                    <?php
                    $conn = new mysqli('localhost', 'root', '', 'check_up');
                    // Assuming you have established a database connection in $conn variable
                    $query = "SELECT clinic_name, day, start_hour, end_hour FROM `clinic-schedule` WHERE doctor_id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $doctorId);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $clinicName = $row['clinic_name'] . " (" . $row['start_hour'] . ":" . $row['end_hour'] . ")";
                            $day = $row['day'];
                            echo "<option value=\"$clinicName\">$clinicName</option>";
                        }
                    }
                    ?>
                </select>

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
</body>

</html>
