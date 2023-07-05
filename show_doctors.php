<!DOCTYPE html>
<html>
<head>
  <title>People Details</title>
  <link href="PatientVer2.css" rel="stylesheet" type="text/css">
</head>
  <?php 
    require 'navbar.php';
  ?>
<body>
  <div class="container">
    <div class="sidebar">

      <!-- Side fucking bar-->
      <h2>Filter</h2>
      <form action="show_doctors.php" method="post">
        <div class="search-bar">
          <input type="text" name="search" placeholder="Search..." />
        </div>
        <select name="specialization">
          <option value="">Filter Specialization</option>
          <option value="Cardiologist">Cardiologist</option>
          <option value="Dermatologist">Dermatologist</option>
          <option value="Endocrinologist">Endocrinologist</option>
          <option value="Gastroenterologist">Gastroenterologist</option>
          <option value="Neurologist">Neurologist</option>
          <option value="Oncologist">Oncologist</option>
          <option value="Pediatrician">Pediatrician</option>
          <option value="Psychiatrist">Psychiatrist</option>
          <option value="Surgeon">Surgeon</option>
        </select>
        <button type="submit">Filter</button>
      </form>

    </div>

    <!-- User Cards -->
    <div class="content">
      <?php
      // Establish the database connection
      $conn = new mysqli('localhost', 'root', '', 'check_up');

      // Check for connection errors
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Fetch data from the doctor table
      $sql = "SELECT * FROM doctors";
      
      // Check if search input is provided
      if (isset($_POST['search']) && !empty($_POST['search'])) {
        $search = $_POST['search'];
        // Add search filter to the SQL query
        $sql .= " WHERE name LIKE '%$search%'";
      }

      // Check if specialization is selected
      if (isset($_POST['specialization']) && !empty($_POST['specialization'])) {
        $specialization = $_POST['specialization'];
        // Add specialization filter to the SQL query
        if (strpos($sql, 'WHERE') !== false) {
          $sql .= " AND (FIND_IN_SET('$specialization', specialization) > 0 OR specialization LIKE '%$specialization%')";
        } else {
          $sql .= " WHERE (FIND_IN_SET('$specialization', specialization) > 0 OR specialization LIKE '%$specialization%')";
        }
      }

      $result = $conn->query($sql);

      // Check if there are any rows in the result
      if ($result->num_rows > 0) {
        // Loop through each row and create a card
        while ($row = $result->fetch_assoc()) {
          ?>
          <div class="card">
              <img class="profile-image" src="<?php echo $row['profile_picture']; ?>" alt="Profile Image">
              <h2 class="text-title"><?php echo "Dr. " . $row['name']; ?></h2>
              <p class="text-body">Specialization: <?php echo $row['specialization']; ?></p>
              <div class="info-card">
                  <p>Doctor ID: <?php echo $row['doctor_id']; ?>
                  <br>Age: <?php echo $row['age']; ?>
                  <br>Gender: <?php echo $row['gender']; ?>
                  <br>Phone: <?php echo $row['phone_number']; ?>
                  <br>Email: <?php echo $row['email']; ?>
                  <br>Address: <?php echo $row['address']; ?></p>
              </div>
              <a href="DoctorSetAppointment.php?doctor_id=<?php echo $row['doctor_id']; ?>&doctor_name=<?php echo urlencode($row['name']); ?>" class="card-button">Book Now</a>

          </div>
          <?php
      }
      
      
      } else {
        echo "No doctors found.";
      }

      // Close the database connection.
      $conn->close();
      ?>
    </div>


</body>
</html>
