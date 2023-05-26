<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
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
    <form id="signupForm" class="form hide" action="success.php">
        <p class="form-title">Create an account</p>
        <div class="divider">
        <p class="titles">Personal Information</p>
            <div class="input-container">
                <input type="text" placeholder="First name">
            </div>
            <div class="input-container">
                <input type="text" placeholder="Last name">
            </div>

            <div class="input-role">
                <label>
                    <input type="checkbox" name="role" value="doctor" onchange="showSpecializationInput(this)">
                    Doctor?
                </label>
            </div>

            <div id="specializationInput" style="display: none;" class="specialization-form">
                <div class="specialization-field">
                    <input type="text" placeholder="Specialization" name="Specialization[]" id="specialization">
                    <input type="text" placeholder="License Number" name="License[]" id="license">
                    <button type="button" onclick="removeSpecializationInput(this)">Remove</button>
                </div>
            </div>

                <button type="button" id="addSpecializationBtn" onclick="addSpecializationInput()" style="display: none;">Add Specialization</button>


            <div class="input-container">
                <select onchange="handleSelectChange(event)">
                    <option value="">Select gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <input type="number" placeholder="Age" min="1" id="age">
            </div>
            <div class="input-container">
                <input type="tel" placeholder="Contact Number">
            </div>
            <div class="input-container">
                <input type="email" placeholder="Email">
            </div>
        </div>
        <div class="input-container">
            <div class="divider">
                <p class="titles">Address</p>
                <input type="text" placeholder="Street"><br>
                <input type="text" placeholder="City" id="city">
                <input type="text" placeholder="State" id="state"><br>
                <input type="text" placeholder="Postal Code" id="postal">
                <input type="text" placeholder="Country" id="country">
            </div>
        </div>
        <div class="divider">
            <p class="titles">Password</p>
            <div class="input-container">
                <input type="password" placeholder="Password">
            </div>
            <div class="input-container">
                <input type="password" placeholder="Confirm password">
            </div>
        </div>
        <button type="submit" class="submit">Sign up</button>

        <p class="signup-link">
            Already have an account?
            <a href="login.php" id="loginLink">Sign in</a>
        </p>
    </form>

    <script>
        function showSpecializationInput(checkbox) {
        var specializationInput = document.getElementById("specializationInput");
        var addSpecializationBtn = document.getElementById("addSpecializationBtn");
        var licenseNumberInput = document.getElementById("specializationInput");
        var addSpecializationBtn = document.getElementById("addSpecializationBtn");

        if (checkbox.checked) {
            specializationInput.style.display = "block";
            licenseNumberInput.style.display = "block";
            addSpecializationBtn.style.display = "block";
        } else {
            specializationInput.style.display = "none";
            addSpecializationBtn.style.display = "none";
        }
        }

        function addSpecializationInput() {
        var specializationInput = document.getElementById("specializationInput");
        var specializationField = document.createElement("div");
        specializationField.classList.add("specialization-field");
        specializationField.innerHTML = `
            <input type="text" placeholder="Specialization" name="Specialization[]">
            <input type="text" placeholder="License Number" name="License[]" id="license">
            <button type="button" onclick="removeSpecializationInput(this)">Remove</button>
            
        `;
        specializationInput.appendChild(specializationField);
        }

        function removeSpecializationInput(button) {
        var specializationField = button.parentNode;
        specializationField.parentNode.removeChild(specializationField);
        }
    </script>








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
</body>
</html>
