<!DOCTYPE html>
<html>
<head>
  <title>Account Settings</title>
  <style>
        body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        display: relative;
        }

        .container {
        flex: 1;
        padding: 20px;
        }

        .form-container {
        max-width: 400px;
        margin: 0 auto;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.3);
        padding: 20px;
        animation: fade-in 0.5s ease;
        }

        @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
        }

        label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 16px;
        border-radius: 3px;
        border: 1px solid #ccc;
        box-sizing: border-box;
        }

        input[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 3px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
        background-color: #45a049;
        }

        button[type="button"] {
        background-color: #f44336;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 3px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        }

        button[type="button"]:hover {
        background-color: #d32f2f;
        }


        .navigation-bar {
        position: relative;
        width: 150px;
        background-color: #f8f8f8;
        border-right: 1px solid #ccc;
        padding: 20px;
        animation: slide-in 0.5s ease;
        }

        @keyframes slide-in {
        from {
            transform: translateX(-200px);
        }
        to {
            transform: translateX(0);
        }
        }

        .navigation-bar ul {
        list-style-type: none;
        padding: 0;
        }

        .navigation-bar li {
        margin-bottom: 10px;
        }

        .navigation-bar a {
        text-decoration: none;
        color: #333;
        transition: color 0.3s ease;
        }

        .navigation-bar a:hover {
        color: #555;
        }
        .container_main{
            display: flex;
            margin-left: auto;
            margin-right: auto;
            margin-top: 200px;
            border: 1px solid #ccc;
            width: 800px;
        } 

  </style>
</head>
<?php
require 'navbar.php';
?>
<body>
  <?php
  // Retrieve user's existing settings from the database (if available)
  // You'll need to connect to your database and fetch the user's data here
  // For simplicity, let's assume the user's data is stored in variables

  // Example data (replace with your own implementation)
  $email = isset($user['email']) ? $user['email'] : '';
  $_SESSION['oldPassword'] = isset($user['password']) ? $user['password'] : '';
  ?>
  <div class="container_main">
    <div class="navigation-bar">
      <ul>
        <li><a href="settings.php">Account Settings</a></li>
        <li><a href="personal_information.php">Personal Information</a></li>
        <?php 
          if($user['role'] == 'doctor'){
            echo '<li><a href="DoctorSchedule.php">Clinic Settings</a></li>';
          }
        ?>
      </ul>
    </div>

    <div class="container">
      <div class="form-container">
        <h1>Account Settings</h1>

        <form method="POST" action="settings.php" onsubmit="return validateForm()">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

          <label for="password">Current Password:</label>
          <input type="password" id="curPassword" name="curPassword">

          <label for="password">New Password:</label>
          <input type="password" id="newPassword" name="newPassword">

          <label for="password">Confirm New Password:</label>
          <input type="password" id="cnPassword" name="cnPassword">
          <span class="error-message"></span>

          <br><input type="submit" value="Save">
          <button type="button" onclick="cancelForm()">Cancel</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    function validateForm() {
      <?php
        if (isset($_POST['curPassword'], $_POST['newPassword'], $_POST['cnPassword'])) {
            $curPassword = sha1(sha1($_POST['curPassword']));
            $newPassword = sha1(sha1($_POST['newPassword']));
            $cnPassword = sha1(sha1($_POST['cnPassword']));
        }
      ?>
      var curPassword = <?php echo $curPassword; ?>;
      var newPassword = <?php echo $newPassword; ?>;
      var cnPassword = <?php echo $cnPassword; ?>;
      var oldPassword = "<?php echo $_SESSION['oldPassword']; ?>";
      var errorMessage = document.querySelector(".error-message");
      
      // Check if any password input has a value
      if (curPassword || newPassword || cnPassword) {
        // If any one of them has a value, require all password inputs
        if (!curPassword || !newPassword || !cnPassword) {
          // Display error message in the <span> element
          errorMessage.textContent = "Please fill in all password fields.";
          return false; // Prevent form submission
        }
      }

      if (curPassword && newPassword === curPassword) {
        // Display error message in the <span> element
        errorMessage.textContent = "New password must not be the same as the current password.";
        return false; // Prevent form submission
      }

      if (curPassword === oldPassword && newPassword !== curPassword && newPassword === cnPassword) {
        // Create a pop-up asking the user to confirm changes
        var confirmChanges = confirm("Are you sure you want to save the changes?");

        if (!confirmChanges) {
          return false; // User clicked cancel, prevent form submission
        }
        else{
          <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Update the user's password in the database
            $conn = new mysqli('localhost', 'root', 'final123', 'check_up');
            
            // Check for a successful database connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            
            // Retrieve the patient's ID or any identifier needed to update the correct row
            $patientId = $user['id']; // Set the patient's ID here or fetch it from a previous query
            
            // Update the password column
            $sql = "UPDATE patient SET password = '$newPassword' WHERE id = '$patientId'";
            
            if ($conn->query($sql) === TRUE) {
              echo "Password updated successfully.";
            } else {
              echo "Error updating password: " . $conn->error;
            }
            
            $conn->close();
          }
          ?>
        }

      }

      // Additional password validation logic goes here
      // ...

      // Clear error message if validation passes
      errorMessage.textContent = "";

      return true; // Allow form submission
    }

    function cancelForm() {
      // Perform any necessary actions to cancel the form here
      // For example, you can redirect the user to another page
      // or clear the form inputs
    }
  </script>
</body>


</html>
