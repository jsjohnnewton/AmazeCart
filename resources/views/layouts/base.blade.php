<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/css/lineicons.css" />
    <link rel="stylesheet" href="/assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="/assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="/assets/css/main.css" />



    <style>
        .eye-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            width: 24px;
            height: 24px;
            background-image: url('/assets/images/auth/eye-outline.svg');
            /* Replace with path to your eye icon image */
            background-size: cover;
            opacity: 0.5;
        }

        .eye-icon::before {
            content: '';
            display: block;
            width: 0;
            height: 0;
            /* border-left: 8px solid transparent;
            border-right: 8px solid transparent; */
            /* border-top: 8px solid #333; */
            /* Change color as needed */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            right: -15px;
        }

        #password {
            /* padding-right: 40px; */
            /* Adjust the padding to accommodate the eye icon */
        }

        .phone-input-wrapper::before {
            content: "+91";
            position: absolute;
            left: 8px;
            top: 40%;
            /* transform: translateY(-50%); */
            pointer-events: none;
            /* Ensures the pseudo-element does not intercept pointer events */
        }

        .phone-input-wrapper input {
            padding-left: 40px;
            /* Adjust this value based on the width of the prefix */
            box-sizing: border-box;
            /* Ensure padding is included in the input's total width */
        }
    </style>
</head>

<body>


    <section class="signin-section">
        <div class="container-fluid">
            {{ $slot }}
        </div>
    </section>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const togglePassword = document.querySelector('.toggle-password');

            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                // Change eye icon based on password visibility
                if (type === 'password') {
                    togglePassword.style.backgroundImage = "url('/assets/images/auth/eye-outline.svg')";
                } else {
                    togglePassword.style.backgroundImage = "url('/assets/images/auth/eye-off-outline.svg')";
                }
            });
        });
    </script>


    <script>
        function validateName() {
            var nameInput = document.getElementById('name');
            var nameError = document.getElementById('nameError');
            var name = nameInput.value.trim();

            // Check if all characters in the name are the same
            var allSameCharacters = name.split('').every(function(char) {
                return char === name[0];
            });


            // Regular expression to check if the name contains only alphabetical characters and spaces
            var alphabeticalRegex = /^[A-Za-z\s]+$/;


            if (name.length === 0) {
                nameError.textContent = 'Name is required';
                nameInput.style.borderColor = 'red';
                return false;
            } else if (name.length < 3) {
                nameError.textContent = 'Name should be at least 3 characters long';
                nameInput.style.borderColor = 'red';
                return false;

            } else if (name.length > 25) {
                nameError.textContent = 'Name is too long';
                nameInput.style.borderColor = 'red';
                return false;

            } else if (allSameCharacters) {
                nameError.textContent = 'Name should not contain all the same characters';
                nameInput.style.borderColor = 'red';
                return false;

            } else if (!alphabeticalRegex.test(name)) {
                nameError.textContent = 'Name  Invalid';
                nameInput.style.borderColor = 'red';
                return false;

            } else {
                nameError.textContent = '';
                nameInput.style.borderColor = '';
                return true;

            }
        }



        function validateEmail() {
            var emailInput = document.getElementById('email');
            var emailError = document.getElementById('emailError');
            var email = emailInput.value.trim();

            if (email) {
                var commonEmailDomains = ["gmail", "yahoo", "hotmail", "outlook", "aol", "icloud", "protonmail", "gracecoe"];
                var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

                var domain = email.split('@')[1];
                var validDomain = commonEmailDomains.some(function(commonDomain) {
                    return domain.includes(commonDomain);
                });

                if (email.match(emailRegex) && validDomain) {
                    emailError.style.display = 'none';
                    emailInput.style.borderColor = '';
                    return true;
                } else {
                    emailError.innerHTML = "Please enter a valid email address with a common domain (e.g., gmail.com, yahoo.com).";
                    emailError.style.display = 'block';
                    emailInput.style.borderColor = 'red';
                    return false;
                }
            } else {
                emailError.innerHTML = "Email is Required";
                emailError.style.display = 'block';
                emailInput.style.borderColor = 'red';

                return false;
            }
        }

        function validatePhone() {
            var phoneInput = document.getElementById('phone');
            var phoneError = document.getElementById('phoneError');

            // Remove non-numeric characters from input value
            phoneInput.value = phoneInput.value.replace(/\D/g, '');



            var phoneval = phoneInput.value;


            // Regular expression to check if the phone number is valid
            var phoneRE = /^[6-9]\d{9}$/;


            if (phoneval.length == 0) {
                phoneError.textContent = 'Phone number is Required';
                phoneError.style.display = 'block';
                phoneInput.style.borderColor = 'red';
                return false;
            } else if (phoneval.length !== 10) {
                phoneError.textContent = 'Phone number should be 10 digits';
                phoneInput.style.borderColor = 'red';
                return false;

            } else if (!phoneRE.test(phoneval)) { // Use phoneval instead of name
                phoneError.textContent = 'Invalid phone number';
                phoneInput.style.borderColor = 'red';
                return false;

            } else {
                phoneError.textContent = '';
                phoneInput.style.borderColor = '';
                return true;
            }
        }




        function validateDob() {
            var dobinput = document.getElementById('dob').value;
            var dob = new Date(document.getElementById('dob').value);
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();
            var monthDiff = today.getMonth() - dob.getMonth();


            if (dobinput.trim()) {

                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                    age--;
                }

                if (age < 18) {
                    document.getElementById('dobError').style.display = 'block';
                    document.getElementById('dobError').textContent = 'You must be at least 18 years old';
                    document.getElementById('dob').style.borderColor = 'red';
                    return false;
                } else {
                    document.getElementById('dobError').textContent = '';
                    document.getElementById('dobError').style.display = 'none';
                    document.getElementById('dob').style.borderColor = '';

                    return true;
                }
            } else {
                document.getElementById('dob').style.borderColor = 'red';
                document.getElementById('dobError').style.display = 'block';
                document.getElementById('dobError').textContent = 'DOB is Required';
                return false;
            }


        }

        function validatePassword() {

            const passwordInput = document.getElementById("password");
            const passwordError = document.getElementById("passwordError");
            const password = passwordInput.value;

            if (password.trim()) {
                // Your custom password validation logic
                if (password.length < 8 || !/[a-z]/.test(password) || !/[A-Z]/.test(password) || !/[0-9]/.test(password) || !/[^a-zA-Z0-9]/.test(password)) {
                    let errorMessage = "Password must Contain at least :";
                    if (password.length < 8) {
                        errorMessage += "  8 characters ";
                    }
                    if (!/[a-z]/.test(password)) {
                        errorMessage += "  one lowercase letter";
                    }
                    if (!/[A-Z]/.test(password)) {
                        errorMessage += " one uppercase letter";
                    }
                    if (!/[0-9]/.test(password)) {
                        errorMessage += " one digit";
                    }
                    if (!/[^a-zA-Z0-9]/.test(password)) {
                        errorMessage += " one special character";
                    }
                    passwordError.textContent = errorMessage;
                    passwordError.style.display = "block";
                    passwordInput.style.borderColor = 'red';
                    return false;
                } else {
                    passwordError.textContent = "";
                    passwordError.style.display = "none";
                    passwordInput.style.borderColor = '';
                    return true;
                }
            } else {
                passwordError.textContent = "Passsword is Required";
                passwordError.style.display = "block";
                passwordInput.style.borderColor = 'red';
                return false;
            }

        }

        document.addEventListener("DOMContentLoaded", function() {
            const passwordInput = document.getElementById("password");

            passwordInput.addEventListener("input", validatePassword);
        });

        function validatePasswordConfirm() {
            const passwordInput = document.getElementById("password");
            const passwordconfirm = document.getElementById("password_confirmation");
            const passwordError = document.getElementById("passwordErrorConfirm");

            if (password_confirmation.value.trim()) {

                if (passwordInput.value == passwordconfirm.value) {
                    passwordError.textContent = "";
                    passwordError.style.display = "none";

                    passwordInput.style.borderColor = '';
                    passwordconfirm.style.borderColor = '';

                    return true;
                } else {
                    passwordError.textContent = 'Password does not match';
                    passwordError.style.display = "block";

                    passwordInput.style.borderColor = 'red';
                    passwordconfirm.style.borderColor = 'red';

                    return false;
                }
            } else {
                passwordError.textContent = 'Password Confirmation is required';
                passwordError.style.display = "block";

                passwordInput.style.borderColor = 'red';
                passwordconfirm.style.borderColor = 'red';
                return false;

            }
        }
    </script>



    <!-- ========= All Javascript files linkup ======== -->
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/Chart.min.js"></script>
    <script src="/assets/js/dynamic-pie-chart.js"></script>
    <script src="/assets/js/moment.min.js"></script>
    <script src="/assets/js/fullcalendar.js"></script>
    <script src="/assets/js/jvectormap.min.js"></script>
    <script src="/assets/js/world-merc.js"></script>
    <script src="/assets/js/polyfill.js"></script>
    <script src="/assets/js/main.js"></script>
</body>

</html>