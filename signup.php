<!DOCTYPE html>
<html>
<head>
    <title>Sign up</title>
    <style>
         body {
            padding-top: 60px; /* Adjust the value to make space for the navbar */
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
            font-size: 0.875rem;
            line-height: 1.8rem;
            width: 310px;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        #specialization, #license{
            width: 315px;
            line-height: 3rem;
        }
        .error{
            color: red;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #2c3e50;
            padding: 10px;
            position: fixed; /* Change to fixed */
            top: 0; /* Position at the top */
            width: 100%; /* Make the navbar full-width */
            z-index: 1; /* Ensure the navbar is on top */
        }

        .navbar-logo {
            width: 150px;
            height: auto;
            mix-blend-mode: multiply;
        }

        .navbar-menu {
            display: flex;
            list-style: none;
            position: relative;
        }

        .navbar-menu li {
            margin-left: 20px;
        }

        .navbar-menu a {
            color: white;
            text-decoration: none;
        }

        .navbar-menu a:hover {
            color: #f39c12;
        }
        


    </style>
</head>
<body>
    <div class="navbar"> 
        <img src="https://lh3.googleusercontent.com/drive-viewer/AFGJ81oPLY3tWwP5Ehvtv0-5ucfnf0ht4a204opiPOE9q4EjYrsrfHfAHVwX3L9Uk-sSdnEYQa7LZAZ8Rqnz7uYEbCcOPN29cg=s2560" class="navbar-logo" /> </a>
            <ul class="navbar-menu"> 
            <li><a href="Home-Page.php">Home</a></li> 
            <li><a href="show_doctor.php">Doctors</a></li> 
            <li><a href="#">About</a></li> 
        </ul> 
    </div>
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
                <div class="specialization-field"></div>
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
            licenseInput.placeholder = "License Number";
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