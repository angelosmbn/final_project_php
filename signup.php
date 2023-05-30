<!DOCTYPE html>
<html>
<head>
    <title>Sign up</title>
    <style>
        body {
            display: flex;
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
            width: 250px;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
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
            width: 205px;
        }
        #age{
            width: 40px;
        }
        select.black {
            color: #000;
        }
        #postal, #state, #city, #country{
            width: 90px;
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
            margin-bottom: 8px;
        }
        .input-role{
            display: flex;         
        }
        .specialization-form input, button{
            display: block;
            outline: none;
            border: 1px solid #e5e7eb;
            margin: 8px 0;
            font-size: 0.875rem;
            line-height: 2rem;
            width: 310px;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }


    </style>
    <script>
        function handleSelectChange(event) {
            var selectedValue = event.target.value;
            if (selectedValue !== "") {
                event.target.classList.add("black");
            } else {
                event.target.classList.remove("black");
            }
        }
    </script>
</head>
<body>
    <form id="signupForm" class="form hide" action="success.php" method="POST">
        <p class="form-title">Create an account</p>
        <div class="divider">
            <p class="titles">Personal Information</p>
            <div class="input-container">
                <input type="text" placeholder="First name" name="firstName" required>
            </div>
            <div class="input-container">
                <input type="text" placeholder="Last name" name="lastName" required>
            </div>

            <div class="input-role">
                <label>
                    <input type="radio" name="role" value="patient" checked onchange="handleRoleChange(this)">
                    Patient
                </label>
                <label>
                    <input type="radio" name="role" value="doctor" onchange="handleRoleChange(this)" onclick="addSpecializationInput()">
                    Doctor
                </label>
            </div>

            <div id="specializationInput" style="display: none;" class="specialization-form">
                <div class="specialization-field">
                </div>
            </div>

            <button type="button" id="addSpecializationBtn" onclick="addSpecializationInput()" style="display: none;">Add Specialization</button>

            <div class="input-container">
                <select name="gender" onchange="handleSelectChange(event)" required>
                    <option value="">Select gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <input type="number" placeholder="Age" min="1" name="age" id="age" required>
            </div>
            <div class="input-container">
                <input type="tel" placeholder="Contact Number" name="telephone" required>
            </div>
            
            <div class="input-container">
                <input type="email" placeholder="Email" name="email" required>
            </div>
            <?php
                $conn = new mysqli('localhost', 'root', '', 'check_up');
                if ($conn->connect_error) {
                    echo '<div class="success-message">
                        Account NOT successfully created! Please
                        <a href="login.php">Try Again</a>
                    </div>';
        
                    die("Connection failed: ". $conn->connect_error);
                }
                
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    // Get the submitted email
                    $email = $_POST["email"];

                    // Prepare a SELECT query to check if the email exists
                    $query = "SELECT * FROM users WHERE email = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        // Email already exists in the database
                        echo "The email is already registered.";
                        exit;
                    }

                    // Continue with the insertion of the new record
                    // ...
                    // Your existing code to insert the record into the database
                    // ...
                }
                ?>

        </div>
        <div class="input-container">
            <div class="divider">
                <p class="titles">Address</p>
                <input type="text" placeholder="Street" name="street" required><br>
                <input type="text" placeholder="City" id="city" name="city" required>
                <input type="text" placeholder="State" id="state" name="state" required><br>
                <input type="text" placeholder="Postal Code" id="postal" name="postal" required>
                <input type="text" placeholder="Country" id="country" name="country" required>
            </div>
        </div>
        <div class="divider">
            <p class="titles">Password</p>
            <div class="input-container">
                <input type="password" placeholder="Password" name="password" id="password" required>
            </div>
            <div class="input-container">
                <input type="password" placeholder="Confirm password" name="confirmPassword" id="confirmPassword" required>
            </div>
        </div>
        
        <div id="passwordError" class="error"></div>

        <button type="submit" class="submit">Sign up</button>

        <p class="signup-link">
            Already have an account?
            <a href="login.php" id="loginLink">Sign in</a>
        </p>
    </form>

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
                var specializationFields = specializationInput.querySelectorAll('input[name="specialization[]"]');
                for (var i = 0; i < specializationFields.length; i++) {
                    specializationFields[i].value = "";
                    specializationFields[i].required = false;
                }
                var licenseFields = specializationInput.querySelectorAll('input[name="license[]"]');
                for (var i = 0; i < licenseFields.length; i++) {
                    licenseFields[i].value = "";
                    licenseFields[i].required = false;
                }
            }
        }

        function addSpecializationInput() {
            var specializationInput = document.getElementById("specializationInput");
            var specializationField = document.createElement("div");
            specializationField.classList.add("specialization-field");
            specializationField.innerHTML = `
                <input type="text" placeholder="Specialization" name="specialization[]" required>
                <input type="text" placeholder="License Number" name="license[]" required>
                <button type="button" onclick="removeSpecializationInput(this)">Remove</button>
            `;
            specializationInput.appendChild(specializationField);
        }

        function removeSpecializationInput(button) {
            var specializationField = button.parentNode;
            specializationField.parentNode.removeChild(specializationField);
        }

        function handleSelectChange(event) {
            var genderSelect = event.target;
            var selectedGender = genderSelect.value;
            var maleOption = genderSelect.querySelector('option[value="male"]');
            var femaleOption = genderSelect.querySelector('option[value="female"]');

            if (selectedGender === "male") {
                femaleOption.removeAttribute("required");
                maleOption.setAttribute("required", true);
            } else if (selectedGender === "female") {
                maleOption.removeAttribute("required");
                femaleOption.setAttribute("required", true);
            } else {
                maleOption.removeAttribute("required");
                femaleOption.removeAttribute("required");
            }
        }

        // Function to validate the password fields
        function validatePasswords() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmPassword").value;
        var errorElement = document.getElementById("passwordError");

        if (password !== confirmPassword) {
            // Passwords don't match, show error message
            errorElement.textContent = "Passwords do not match";
            return false;
        } else {
            // Passwords match, clear error message
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
