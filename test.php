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
                <input type="radio" name="role" value="doctor" onchange="handleRoleChange(this)">
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
