<!DOCTYPE html>
<html>
<head>
  <title>People Details</title>
  <link href="PatientVer2.css" rel="stylesheet" type="text/css">
</head>

<body>
  <!-- Yung banner sa taas  -->
    <div class="banner">
        <div class="navbar">
            <a href="dashboard.php" style="box-shadow: 2px 0 2px 0 rgba(0, 0, 0, 0.1);">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="show_doctors.php" style="box-shadow: 2px 0 2px 0 rgba(0, 0, 0, 0.1);">Doctors</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#" style="box-shadow: 2px 0 2px 0 rgba(0, 0, 0, 0.1);">My Appointments</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#" style="box-shadow: 2px 0 2px 0 rgba(0, 0, 0, 0.1);">About</a>
        </div>
        <div>
            <img class="user-image" src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg" alt="Profile Image">
        </div>
    </div>


  <div class="container">
    <div class="sidebar">

      <!-- Side fucking bar-->
      <h2>Sidebar</h2>
      <form action="Patient.php" method="post">
        <div class="search-bar">
          <input type="text" placeholder="Search..." />
        </div>
        <select>
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

        <input type="submit" />
      </form>
    </div>

<!-- User Cards -->
<div class="content">
  <?php
  // Establish the database connection
  $conn = new mysqli('localhost', 'root', 'final123', 'check_up');

  // Check for connection errors
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Fetch data from the doctor table
  $sql = "SELECT firstName, lastName, specialization, picture FROM doctor";
  $result = $conn->query($sql);

  // Check if there are any rows in the result
  if ($result->num_rows > 0) {
    // Loop through each row and create a card
    while ($row = $result->fetch_assoc()) {
      ?>
      <div class="card">
        <img class="profile-image" src="<?php echo $row['picture']; ?>" alt="Profile Image">
        <h2 class="text-title"><?php echo $row['firstName'] . ' ' . $row['lastName']; ?></h2>
        <p class="text-body">Specialization: <?php echo $row['specialization']; ?></p>
        <div class="info-card">
          <h3>Additional Information</h3>
          <p>.</p>
        </div>
        <a href="#" class="card-button">Book Now</a>
      </div>
      <?php
    }
  } else {
    echo "No doctors found.";
  }

  // Close the database connection
  $conn->close();
  ?>
</div>

</body>
</html>
