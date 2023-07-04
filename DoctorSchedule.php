<?php 
    require 'navbar.php';
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
                <input type="text" id="hospitalInput1" required placeholder="Enter Hospital" />

                <select id="daySelect1" name="hospital" required>
                    <option value="" selected disabled>Select a day</option>
                    <option value="monday">Monday</option>
                    <option value="tuesday">Tuesday</option>
                    <option value="wednesday">Wednesday</option>
                    <option value="thursday">Thursday</option>
                    <option value="friday">Friday</option>
                    <option value="saturday">Saturday</option>
                    <option value="sunday">Sunday</option>
                </select>

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

                <div class="btn-box-1">
                    <button type="button" id="addFormButton">Add</button>
                </div>
            </form>
        </div>

        <div class="previous-details-container">
            <h2>Previous Details:</h2>
            <ul id="previousDetails"></ul>
        </div>
    </div>
    <?php
         if (!isset($_POST['hospital'])) {
            $_POST['hospital'] = null;
        }
        if (!isset($_POST['starthr'])) {
            $_POST['starthr'] = null;
        }
        if (!isset($_POST['endhr'])) {
            $_POST['endhr'] = null;
        }
    ?>

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

</body>

</html>
