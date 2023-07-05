<?php 
  require 'navbar.php';
  if (isset($_GET['doctor_id']) || isset($_GET['name'])) {
    $doctorId = $_GET['doctor_id'];
    $doctorName = $_GET['doctor_name'];
  } else {
      // Handle the case when no doctor_id is provided
  }

  // Database connection
  $conn = new mysqli('localhost', 'root', '', 'check_up');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form submitted, insert data into the 'appointments' table
    $clinic = $_POST['clinic_name'];
    $appointmentDate = $_POST['appointment_date'];
    $description = $_POST['description'];
    $clinicName = substr($clinic, 0, strpos($clinic, '(') - 1);
    $day = substr($clinic, strpos($clinic, '(') + 1, -1);

    $status = "pending";
    $patientId = $user['patient_id'];
    $apptQuery = "SELECT status, patient_id FROM appointments WHERE status = ? AND patient_id = ? AND doctor_id = ? AND appointment_date = ? AND clinic_name = ?";
    $apptStmt = $conn->prepare($apptQuery);
    $apptStmt->bind_param("siiss", $status, $patientId, $doctorId, $appointmentDate, $clinicName);
    $apptStmt->execute();
    $apptResult = $apptStmt->get_result();

    if ($apptResult->num_rows > 0) {
        // Email is already taken, display error message and redirect back to the signup form
        $error_msg = '<div class="error-message">You already have a schedule.<br></div>';
        $apptStmt->close();
        $conn->close();
    }
    else {

      // Prepare and execute the SQL query
      $query = "INSERT INTO appointments (patient_id, patient_name, patient_age, patient_gender, patient_phone, patient_email, doctor_id, doctor_name, clinic_name, day, appointment_date, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("isisssisssss", $user['patient_id'], $user['name'], $user['age'], $user['gender'], $user['phone_number'], $user['email'],$doctorId, $doctorName, $clinicName, $day, $appointmentDate, $description);

      $stmt->execute();

      // Check if the insertion was successful
      if ($stmt->affected_rows > 0) {
        // Appointment inserted successfully
        $success_msg = "Appointment Set!";
      } else {
        // Failed to insert appointment
        $success_msg = "Failed to set appointment.";
      }

      // Close the statement
      $stmt->close();
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link href="DoctorSetAppointments1.css" rel="stylesheet" type="text/css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <style>
    body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #b5c2c7;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.user-image {
    padding-right: 10px;
    padding-top: 10px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    float: right;
}

.profile-image {
    width: 300px;
    height: 300px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    margin-bottom: 300px;
}

.container-appointment {
    width: 360px;
    height: 550px;
    background: #fff;
    border-radius: 5px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

h2 {
    text-align: center;
    margin: 10px;
    color: #777;
}

.container-appointment form {
    width: 280px;
    position: absolute;
    top: 100px;
    left: 40px;
    transition: 0.5s;
}

form select, form input {
    width: 100%;
    padding: 10px 5px;
    margin: 5px 0;
    border: 0;
    border-bottom: 1px solid #999;
    outline: none;
    background: transparent;
}

::placeholder {
    color: #777;
}


form button {
    width: 110px;
    height: 35px;
    margin: 0 10px;
    background: linear-gradient(to right, #26c2c6, #22637a);
    border-radius: 30px;
    border: 0;
    outline: none;
    color: #fff;
    cursor: pointer;
    margin-top: 40px;
}

#datepicker {
    text-align: center;
  }
  
  ::-webkit-input-placeholder {
    text-align: center;
  }

  </style>
</head>

<body>

  <div class="container">
    <img class="profile-image" src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg">
    <div class="container-appointment">
      <form id="form1" method="POST">
        <h2>Choose Hospital</h2>
        <select id="hospitalSelect" name="clinic_name" required>
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
              $clinicName = $row['clinic_name']. " (". $row['day']. ")";
              echo "<option value=\"$clinicName\">$clinicName</option>";
            }
          }
          ?>
        </select>

        <br></br>
        <h2>Select Date</h2>
        <input type="text" placeholder="SELECT" name="appointment_date" id="datepicker" readonly="readonly" required />


        <h2>Describe what you feel</h2>
        <input type="text" name="description"></input>

        <div class="btn-box">
          <?php 
            if (isset($error_msg)){
              echo $error_msg, "<br>";
            }
            if(isset($success_msg)){
              echo $success_msg, "<br>";
              if (isset($error_msg)){
                unset($error_msg);
              }
            }
          ?>
          <button type="submit" id="submit">Submit</button>
        </div>
        </form>

    <script>

      $(document).ready(function() {
        var daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        var hospitalSelect = $('#hospitalSelect');
        var datepicker = $('#datepicker');

        datepicker.datepicker();
        hospitalSelect.change(function() {
            var selectedDay = hospitalSelect.val();
            datepicker.datepicker("option", "beforeShowDay", function(date) {
            return [false];
            });

            datepicker.datepicker("option", "beforeShowDay", function(date) {
            var currentDate = new Date();

            if (date < currentDate) {
                return [false];
            }

            if (selectedDay.includes("Monday")) {
                return [date.getDay() === daysOfWeek.indexOf("Monday")];
            } else if (selectedDay.includes("Tuesday")) {
                return [date.getDay() === daysOfWeek.indexOf("Tuesday")];
            } else if (selectedDay.includes("Wednesday")) {
                return [date.getDay() === daysOfWeek.indexOf("Wednesday")];
            } else if (selectedDay.includes("Thursday")) {
                return [date.getDay() === daysOfWeek.indexOf("Thursday")];
            } else if (selectedDay.includes("Friday")) {
                return [date.getDay() === daysOfWeek.indexOf("Friday")];
            } else if (selectedDay.includes("Saturday")) {
                return [date.getDay() === daysOfWeek.indexOf("Saturday")];
            } else if (selectedDay.includes("Sunday")) {
                return [date.getDay() === daysOfWeek.indexOf("Sunday")];
            } else {
                return [false];
            }
            });
        });

        var form1 = document.getElementById("form1");
        var form2 = document.getElementById("form2");
        var form3 = document.getElementById("form3");
        var form4 = document.getElementById("form4");

        var next1 = document.getElementById("next1");
        var next2 = document.getElementById("next2");
        var back1 = document.getElementById("back1");
        var back2 = document.getElementById("back2");
        var submit = document.getElementById("submit");

        var progress = document.getElementById("progress");
        function redirect() {
            window.location.href = "Home-Page.php";
        }

        next1.onclick = function() {
          form1.style.left = "-450px";
          form2.style.left = "40px";
          progress.style.width = "240px";
        };

        back1.onclick = function() {
          form1.style.left = "40px";
          form2.style.left = "450px";
          progress.style.width = "120px";
        };

        next2.onclick = function() {
          form2.style.left = "-450px";
          form3.style.left = "40px";
          progress.style.width = "360px";
        };

        back2.onclick = function() {
          form2.style.left = "40px";
          form3.style.left = "450px";
          progress.style.width = "240px";
        };

        submit.onclick = function() {
          form3.style.display = "none";
          form4.style.display = "block";
          alert("Appointment Set!");
          redirect();
        };


      });


    </script>
  </div>
</body>

</html>
<!--
        <select id="hospitalSelect" required>
          <option value="" selected disabled>Select an option</option>
          <option value="Sunday">Hospital 1 (Sunday)</option>
          <option value="Monday">Hospital 2 (Monday)</option>
          <option value="Tuesday">Hospital 3 (Tuesday)</option>
          <option value="Wednesday">Hospital 4 (Wednesday)</option>
          <option value="Thursday">Hospital 5 (Thursday)</option>
          <option value="Friday">Hospital 6 (Friday)</option>
          <option value="Saturday">Hospital 7 (Saturday)</option>
        </select>
        -->