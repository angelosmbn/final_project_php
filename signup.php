<?php 
        require 'navbar.php';
        if(isset($user)){
            // Redirect to the patient dashboard page
            header("Location: Home-Page.php");
            exit();
        }
        $_SESSION['signed'] = False;
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup']) && !isset($_SESSION['inserted'])){
            unset($_POST['signup']);
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['age'] = $_POST['age'];
            $_SESSION['gender'] = $_POST['gender'];
            $_SESSION['phone_number'] = $_POST['telephone'];
            $_SESSION['email'] = $_POST['email'];

            $_SESSION['street'] = $_POST['street'];
            $_SESSION['city'] = $_POST['city'];
            $_SESSION['state'] = $_POST['state'];
            $_SESSION['postal'] = $_POST['postal'];
            $_SESSION['country'] = $_POST['country'];
            $_SESSION['address'] = $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['postal'] . ', ' . $_POST['country'];

            $password = sha1($_POST['password']);
            $confirmPassword = $_POST['confirmPassword'];

            $_SESSION['role'] = isset($_POST['role']) ? $_POST['role'] : '';
            $specializations = isset($_POST['specialization']) ? $_POST['specialization'] : [];
            $licenses = isset($_POST['license']) ? $_POST['license'] : [];

            $specializationsString = implode(', ', $specializations);
            $licensesString = implode(', ', $licenses);

            $conn = new mysqli('localhost', 'root', '', 'check_up');
            
            if ($conn->connect_error) {
                $con_error_msg = "<div class='error-message'>Connection failed: " . $conn->connect_error . "</div>";
                die("Connection failed: " . $conn->connect_error);
            } else {
                // Check if the email is already taken
                $email = $_POST['email'];
                $emailQuery = "SELECT email FROM patient WHERE email = ? UNION SELECT email FROM doctors WHERE email = ?";
                $emailStmt = $conn->prepare($emailQuery);
                $emailStmt->bind_param("ss", $email, $email);
                $emailStmt->execute();
                $emailResult = $emailStmt->get_result();

                if ($emailResult->num_rows > 0) {
                    // Email is already taken, display error message and redirect back to the signup form
                    $email_error_msg = '<div class="error-message">Email is already taken. Please choose a different email.<br></div>';
                    $emailStmt->close();
                    $conn->close();
                }
                else {
                    // Email is not taken, proceed with account creation
                    if($_SESSION['role'] == 'doctor'){
                        $stmt = $conn->prepare("INSERT INTO doctors(name, specialization, license_number, age, gender, phone_number, email, address, role, password)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("sssissssss", $_SESSION['name'], $specializationsString, $licensesString ,$_SESSION['age'], $_SESSION['gender'], $_SESSION['phone_number'], $_SESSION['email'], $_SESSION['address'], $_SESSION['role'], $password);
                    }
                    elseif($_SESSION['role'] == "patient"){
                        $stmt = $conn->prepare("INSERT INTO patient(name, age, gender, phone_number, email, address, role, password)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("sissssss", $_SESSION['name'], $_SESSION['age'], $_SESSION['gender'], $_SESSION['phone_number'], $_SESSION['email'], $_SESSION['address'], $_SESSION['role'], $password);
                    }
                    $stmt->execute();

                    
            
                    $_SESSION['success_msg'] = 'Account successfully created!<br>';
                    $_SESSION['signed'] = TRUE;
                    $_SESSION['inserted'] = true;

                    $stmt->close();
                    $conn->close();
                }
            }            
        }
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign up</title>
    <style>
         body {
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f5f5f5;
        }

        .form {
            background-color: #fff;
            display: block;
            padding: 1rem;
            max-width: 350px;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            margin: auto;
            border: 0.5px solid black;
            margin-top: 150px;
        }
        .result{
            color: green;
            font-size: 15px;
            text-align: center;
        }

        .form-title {
            font-size: 1.25rem;
            line-height: 1.75rem;
            font-weight: 600;
            text-align: center;
            color: #000;
        }

        .input-container {
            position: relative;
        }

        .input-container input, .form button, select {
            outline: none;
            border: 1px solid #e5e7eb;
            margin: 8px 0;
        }

        .input-container input, select {
            background-color: #fff;
            padding: 1rem;
            padding-right: 3rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            width: 285px;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            cursor: pointer;
        }

        input[type="radio"] {
            cursor: pointer;
        }

        .submit {
            display: block;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
            padding-left: 1.25rem;
            padding-right: 1.25rem;
            background-color: #4F46E5;
            color: #ffffff;
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 500;
            width: 100%;
            border-radius: 0.5rem;
            text-transform: uppercase;
        }

        .signup-link {
            color: #6B7280;
            font-size: 0.875rem;
            line-height: 1.25rem;
            text-align: center;
        }

        .signup-link a {
            text-decoration: underline;
        }
        select {
            color: #6B7280;
            width: 220px;
        }
        #age{
            width: 60px;
        }
        select.black {
            color: #000;
        }
        #postal, #state, #city, #country{
            width: 107px;
        }
        .divider {
            padding-bottom: 20px;
            margin-top: 10px;
            border-top: 1px solid black;
        }

        .titles {
            font-size: 19px;
            text-align: center;
            color: #000;
            margin-bottom: 17px;
        }
        .input-role{
            display: flex;         
        }
        .specialization-form input, button{
            display: block;
            outline: none;
            border: 1px solid #e5e7eb;
            font-size: 0.875rem;
            line-height: 1.8rem;
            width: 350px;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            cursor: pointer;
        }
        #specialization, #license{
            width: 350px;
            line-height: 3rem;
        }
        #license{
            width: 345px;
        }
        .error{
            color: red;
        }
        label{
            margin-left: 10px;
            cursor: pointer;
        }
        #age_label{
            margin-left: 165px;
        }
        #state_label{
            margin-left: 140px;
        }
        #country_label{
            margin-left: 90px;
        }
        

    </style>
</head>
    
<body>
    <form id="signupForm" class="form hide" method="POST">
        <p class="form-title">Create an account</p>
        <div class="divider">
            <p class="titles">Personal Information</p>
            <div class="input-container">
  <label for="name">Full name:</label>
  <input type="text" placeholder="Lastname, Firstname, MI." name="name" id="name" value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>" pattern="^[A-Z][a-z]+,.*" title="Please enter a valid name in the format 'Lastname, Firstname, MI.'" required>
</div>

<div class="input-role">
    <label for="role">Role: </label>
    <input type="radio" name="role" id="role" value="patient" checked onchange="handleRoleChange(this)">
    Patient
    <input type="radio" name="role" id="role" value="doctor" onchange="handleRoleChange(this)" onclick="addSpecializationInput()">
    Doctor
</div>

<div id="specializationInput" style="display: none;" class="specialization-form">
  <div class="specialization-field"></div>
</div>

<button type="button" id="addSpecializationBtn" onclick="addSpecializationInput()" style="display: none;">Add Specialization</button>

<div class="input-container">
<br><label for="gender">Gender:</label><label for="age" id="age_label">Age:</label><br>
  <select name="gender" onchange="handleSelectChange(event)" required>
    <option value="">Select gender</option>
    <option value="male">Male</option>
    <option value="female">Female</option>
  </select>
  <input type="number" placeholder="Age" min="1" name="age" id="age" required>
</div>

<div class="input-container">
  <label for="telephone">Telephone:</label>
  <input type="tel" placeholder="+63-915-123-4567" name="telephone" id="telephone" value="<?php echo isset($_SESSION['telephone']) ? $_SESSION['telephone'] : ''; ?>" pattern="\+63-\d{3}-\d{3}-\d{4}" title="Please enter a valid contact number in the format '+63-915-123-4567'" required>
</div>

<div class="input-container">
  <label for="email">Email:</label>
  <input type="email" placeholder="Email" name="email" id="email" required>
</div>

<div class="input-container">
  <div class="divider">
    <p class="titles">Address</p>
    <label for="street">Street:</label>
    <input type="text" placeholder="Street" name="street" id="street" required><br>
    <label for="city">City:</label><label for="state" id="state_label">State:</label><br>
    <input type="text" placeholder="City" id="city" name="city" required>
    
    <input type="text" placeholder="State" id="state" name="state" required><br>
    <label for="postal">Postal Code:</label><label for="country" id="country_label">Country:</label><br>
    <input type="text" placeholder="Postal Code" id="postal" name="postal" required>
    
    <input type="text" placeholder="Country" id="country" name="country" required>
  </div>
</div>

<div class="divider">
  <p class="titles">Password</p>
  <div class="input-container">
    <label for="password">Password:</label>
    <input type="password" placeholder="Password" name="password" id="password" required>
  </div>
  <div class="input-container">
    <label for="confirmPassword">Confirm password:</label>
    <input type="password" placeholder="Confirm password" name="confirmPassword" id="confirmPassword" required>
  </div>
</div>


        <div id="passwordError" class="error">
            <?php 
                if (isset($con_error_msg) && $_SESSION['signed'] == False){
                    echo $con_error_msg;
                }
                elseif (isset($email_error_msg) && $_SESSION['signed'] == False){
                    echo $email_error_msg;
                }
            ?>
        </div>

        <?php 
            if ($_SESSION['signed'] == False && isset($_SESSION['signed'])) {
            echo'<button type="submit" name="signup" class="submit">Sign up</button>';
            echo'<p class="signup-link">
            Already have an account?
            <a href="login.php" id="loginLink">Sign in</a>
            </p>';
            }
        ?>
        

        
    </form>
    <?php 
        if ($_SESSION['signed'] && isset($_SESSION['signed'])) {
            echo "<div class='result'>";
            echo $_SESSION['success_msg'];
            echo '<a href="login.php">Sign in</a>';
            echo "</div>";
            session_unset();
            session_destroy();
        }        
    ?>

    <script>
        function handleRoleChange(radio) {
            var specializationInput = document.getElementById("specializationInput");
            var addSpecializationBtn = document.getElementById("addSpecializationBtn");

            if (radio.value === "doctor") {
                specializationInput.style.display = "block";
                addSpecializationBtn.style.display = "block";
                // Make the specialization and license number fields required
                var specializationFields = specializationInput.querySelectorAll('input[name="specialization[]"]');
                for (var i = 0; i < specializationFields.length; i++) {
                    specializationFields[i].required = true;
                }
                var licenseFields = specializationInput.querySelectorAll('input[name="license[]"]');
                for (var i = 0; i < licenseFields.length; i++) {
                    licenseFields[i].required = true;
                }
            } else {
                specializationInput.style.display = "none";
                addSpecializationBtn.style.display = "none";
                // Clear the values and remove the required attribute
                specializationInput.innerHTML = "";
            }
        }

        function handleSelectChange(event) {
            var selectedValue = event.target.value;
            if (selectedValue !== "") {
                event.target.classList.add("black");
            } else {
                event.target.classList.remove("black");
            }
        }

        function addSpecializationInput() {
            var specializationInput = document.getElementById("specializationInput");
            var specializationField = document.createElement("div");
            specializationField.classList.add("specialization-field");
            
            // Create a select element (dropdown) for specialization
            var specializationSelect = document.createElement("select");
            specializationSelect.id = "specialization";
            specializationSelect.name = "specialization[]";
            specializationSelect.required = true;
            specializationSelect.addEventListener("change", handleSelectChange); // Add event listener
            
            // Add a placeholder option
            var placeholderOption = document.createElement("option");
            placeholderOption.value = "";
            placeholderOption.text = "Select Specialization";
            specializationSelect.appendChild(placeholderOption);
            
            // Add options for different specializations
            var specializations = ["Cardiologist", "Dermatologist", "Endocrinologist", "Gastroenterologist", "Neurologist", "Oncologist", "Pediatrician", "Psychiatrist", "Surgeon"];
            for (var i = 0; i < specializations.length; i++) {
                var option = document.createElement("option");
                option.value = specializations[i];
                option.text = specializations[i];
                specializationSelect.appendChild(option);
            }
            
            // Create an input element for license number
            var licenseInput = document.createElement("input");
            licenseInput.type = "text";
            licenseInput.id = "license";
            licenseInput.placeholder = "    License Number";
            licenseInput.name = "license[]";
            licenseInput.required = true;
            
            // Create a button to remove the specialization input
            var removeButton = document.createElement("button");
            removeButton.type = "button";
            removeButton.textContent = "Remove";
            removeButton.onclick = function() {
                removeSpecializationInput(this);
            };
            
            // Append the elements to the specializationField div
            specializationField.appendChild(specializationSelect);
            specializationField.appendChild(licenseInput);
            specializationField.appendChild(removeButton);
            specializationInput.appendChild(specializationField);
        }



        function removeSpecializationInput(button) {
            var specializationField = button.parentNode;
            specializationField.parentNode.removeChild(specializationField);
        }

        // Function to validate the password fields
        function validatePasswords() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;
            var errorElement = document.getElementById("passwordError");

            if (password.length < 8) {
                // Password length is less than 8 characters, show error message
                errorElement.textContent = "Password should contain at least 8 characters";
                return false;
            } else if (password !== confirmPassword) {
                // Passwords don't match, show error message
                errorElement.textContent = "Passwords do not match";
                return false;
            } else {
                // Passwords match and have the required length, clear error message
                errorElement.textContent = "";
                return true;
            }
        }

        // Add an event listener to the form's submit event
        var signupForm = document.getElementById("signupForm");
        signupForm.addEventListener("submit", function (event) {
            if (!validatePasswords()) {
                // Prevent form submission if passwords don't match
                event.preventDefault();
            }
        });
    </script>





    <!--
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const signupLink = document.getElementById('signupLink');
            const loginLink = document.getElementById('loginLink');
            const loginForm = document.getElementById('loginForm');
            const signupForm = document.getElementById('signupForm');

            signupLink.addEventListener('click', function(event) {
                event.preventDefault();
                loginForm.classList.add('hide');
                signupForm.classList.remove('hide');
            });

            loginLink.addEventListener('click', function(event) {
                event.preventDefault();
                signupForm.classList.add('hide');
                loginForm.classList.remove('hide');
            });
        });
    </script>
    -->
</body>
</html>