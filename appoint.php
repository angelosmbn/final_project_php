<!DOCTYPE html>
<html lang="en">

<head>
  <link href="DoctorSetAppointments1.css" rel="stylesheet" type="text/css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <style>
    .ui-datepicker-calendar tr span.disabled {
      display: none;
    }
  </style>
</head>

<body>
  <div class="navbar">
    <img src="https://lh3.googleusercontent.com/drive-viewer/AFGJ81oPLY3tWwP5Ehvtv0-5ucfnf0ht4a204opiPOE9q4EjYrsrfHfAHVwX3L9Uk-sSdnEYQa7LZAZ8Rqnz7uYEbCcOPN29cg=s2560" class="navbar-logo" />
    </a>
    <ul class="navbar-menu">
      <li><a href="Home-Page.php">Home</a></li>
      <li><a href="#">Doctors</a></li>
      <li><a href="#">My Appointments</a></li>
      <li><a href="#">About</a></li>
    </ul>
  </div>

  <div class="container">
    <img class="profile-image" src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg">
    <div class="container-appointment">
      <form id="form1">
        <h3>Choose Hospital</h3>
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

        <div class="btn-box-1">
          <button type="button" id="next1">Next</button>
        </div>
      </form>
      <form id="form2">
        <h3>Select Date</h3>
        <input type="text" placeholder="SELECT" id="datepicker" readonly="readonly" required />

        <div class="btn-box">
          <button type="button" id="back1">Back</button>
          <button type="button" id="next2">Next</button>
        </div>
      </form>
      <form id="form3">
        <h3>Describe what you feel</h3>
        <input type="text"></input>

        <div class="btn-box">
          <button type="button" id="back2">Back</button>
          <button type="submit" id="submit">Submit</button>
        </div>
      </form>
      <form id="form4" style="display: none;" action="Home-Page.php">
        <h3>Appointment Successful</h3>
        <p>Your appointment has been scheduled successfully.</p>
      </form>

      <div class="step-row">
        <div id="progress"></div>
        <div class="step-col"><small>Step 1</small></div>
        <div class="step-col"><small>Step 2</small></div>
        <div class="step-col"><small>Step 3</small></div>
      </div>
    </div>

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
