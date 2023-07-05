<!DOCTYPE html>
<html>
<head>
  <title>Account Settings</title>
  <!DOCTYPE html>
<html>
<head>
  <title>Personal Information</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      background-image: url("https://img.freepik.com/premium-photo/light-clean-gradient-background-image-hd_181020-1366.jpg?w=2000");
      background-size: cover;
      background-repeat: no-repeat;
      display: flex;
    }
    
    .container {
      flex: 1;
      padding: 20px;
    }
    
    .form-container {
        max-width: 400px;
        margin: 0 auto;
        background-color: rgba(255, 255, 255, 0.5); /* Updated with alpha value */
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
    
    input[type="text"],
    input[type="number"],
    input[type="date"],
    select {
      width: 100%;
      padding: 10px;
      margin-bottom: 16px;
      border-radius: 3px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    
    select {
      height: 38px;
    }
    
    input:invalid {
      border-color: #ff0000;
    }
    
    input:valid {
      border-color: #00ff00;
    }
    
    input[type="submit"] {
      background-color: #0000FF;
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
        position: fixed;
        top: 0;
        left: 0;
        width: 200px;
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
      display: flex;
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
  </style>
</head>
<body>

  <?php
      // Retrieve user's existing settings from the database (if available)
      // You'll need to connect to your database and fetch the user's data here
      // For simplicity, let's assume the user's data is stored in variables

      // Example data (replace with your own implementation)
      $firstName = isset($user['first_name']) ? $user['first_name'] : '';
      $lastName = isset($user['last_name']) ? $user['last_name'] : '';
      $age = isset($user['age']) ? $user['age'] : '';
      $birthday = isset($user['birthday']) ? $user['birthday'] : '';
      $gender = isset($user['gender']) ? $user['gender'] : '';
      $phoneNumber = isset($user['phone_number']) ? $user['phone_number'] : '';
      $street = isset($user['street']) ? $user['street'] : '';
      $city = isset($user['city']) ? $user['city'] : '';
      $region = isset($user['region']) ? $user['region'] : '';
      $postal = isset($user['postal']) ? $user['postal'] : '';
      $country = isset($user['country']) ? $user['country'] : '';
      $role = isset($user['role']) ? $user['role'] : '';

      // Check if the form has been submitted and display a success or error message
      $isSubmitted = isset($_POST['firstName']);

      if ($isSubmitted) {
          // Assuming you have validation logic in place, you can check if the form data is valid here
          // For simplicity, let's assume the form data is valid
          $isValid = true;

          // Perform necessary actions (e.g., updating the database) when the form is submitted and valid
          if ($isValid) {
              // Update the user's data in the database
              // You'll need to connect to your database and perform the necessary update query here

              $successMessage = 'Personal information updated successfully.';
          } else {
              $errorMessage = 'Invalid form data. Please check your inputs and try again.';
          }
      }
  ?>


<div class="navigation-bar">
    <ul>
      <li><a href="settings.php">Account Settings</a></li>
    </ul>
  </div>
  
  <div class="container">
    <div class="form-container">
      <h1>Personal Information</h1>

      <?php if (isset($successMessage)): ?>
        <div class="message success"><?php echo $successMessage; ?></div>
      <?php elseif (isset($errorMessage)): ?>
        <div class="message error"><?php echo $errorMessage; ?></div>
      <?php endif; ?>
  

      <form method="POST" action="personal_information.php">
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" value="<?php echo $firstName; ?>" required>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" value="<?php echo $lastName; ?>" required>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="<?php echo $age; ?>" required>

        <label for="birthday">Birthday:</label>
        <input type="date" id="birthday" name="birthday" value="<?php echo $birthday; ?>" required>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="Male" <?php if ($gender === 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($gender === 'Female') echo 'selected'; ?>>Female</option>
        </select>

        <label for="phoneNumber">Phone Number:</label>
        <input type="tel" id="phoneNumber" name="phoneNumber" value="<?php echo $phoneNumber; ?>" required>

        <label for="street">Street:</label>
        <input type="text" id="street" name="street" value="<?php echo $street; ?>" required>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" value="<?php echo $city; ?>" required>

        <label for="region">Region:</label>
        <input type="text" id="region" name="region" value="<?php echo $region; ?>" required>

        <label for="postal">Postal Code:</label>
        <input type="text" id="postal" name="postal" value="<?php echo $postal; ?>" required>

        <label for="country">Country:</label>
        <input type="text" id="country" name="country" value="<?php echo $country; ?>" required>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="Patient" <?php if ($role === 'patient') echo 'selected'; ?>>Patient</option>
            <option value="Doctor" <?php if ($role === 'doctor') echo 'selected'; ?>>Doctor</option>
        </select>

        <input type="submit" value="Save">
        <button type="button" onclick="cancelForm()">Cancel</button>
      </form>
    </div>
  </div>
  <script>
    function cancelForm() {
      // Perform any necessary actions to cancel the form here
      // For example, you can redirect the user to another page or clear the form inputs
    }
  </script>
</body>
</html>
