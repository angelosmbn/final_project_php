<!DOCTYPE html>
<html>
<head>
  <title>People Details</title>
  <link href="PatientVer2.css" rel="stylesheet" type="text/css">
</head>

<body>
  <!-- Yung banner sa taas  -->
  <div class="navbar"> 
     <img src="https://lh3.googleusercontent.com/drive-viewer/AFGJ81oPLY3tWwP5Ehvtv0-5ucfnf0ht4a204opiPOE9q4EjYrsrfHfAHVwX3L9Uk-sSdnEYQa7LZAZ8Rqnz7uYEbCcOPN29cg=s2560" class="navbar-logo" /> </a>
        <ul class="navbar-menu"> 
         <li><a href="#">Home</a></li> 
         <li><a href="#">Doctors</a></li> 
         <li><a href="#">My Appointments</a></li> 
         <li><a href="#">About</a></li> 
         <li class="login"><a href="Signup-page.php">Sign-up</a>   ||   <a href="Login-page.php">   Login</a></li>(optional if need ng login signup)
       </ul> 
  </div>


  <div class="container">
    <div class="sidebar">

      <!-- Side fucking bar-->
      <h2>Sidebar</h2>
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
      $conn = new mysqli('localhost', 'root', 'final123', 'check_up');

      // Check for connection errors
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Fetch data from the doctor table
      $sql = "SELECT firstName, lastName, specialization, picture FROM doctor";
      
      // Check if search input is provided
      if (isset($_POST['search']) && !empty($_POST['search'])) {
        $search = $_POST['search'];
        // Add search filter to the SQL query
        $sql .= " WHERE firstName LIKE '%$search%' OR lastName LIKE '%$search%'";
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
            <img class="profile-image" src="<?php echo $row['picture']; ?>" alt="Profile Image">
            <h2 class="text-title"><?php echo "Dr." . $row['firstName'] . ' ' . $row['lastName']; ?></h2>
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

      // Close the database connection.
      $conn->close();
      ?>
    </div>


</body>
</html>
