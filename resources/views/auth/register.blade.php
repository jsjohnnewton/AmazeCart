<x-base-layout>
    <!-- ========== signin-section start ========== -->

    <div class="row g-0 mt-50 d-flex justify-content-center">

        <div class="col-sm-8">
            <div class="signup-wrapper">
                <div class="form-wrapper">
                    <form id="registrationForm" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="invoice-logo mb-50 d-flex justify-content-center">
                                    <a href="/">
                                        <img src="/img/newlogo.png" alt="logo" height="50" />
                                    </a>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="input-style-1">
                                    <label>Name</label>
                                    <input id="name" type="text" name="name" :value="old('name')" autofocus autocomplete="name" oninput="validateName()" />
                                    <span id="nameError" style="color: red;"></span>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                                <div class="input-style-1">
                                    <label>Email</label>
                                    <input id="email" type="email" name="email" :value="old('email')" autocomplete="username" oninput="validateEmail()" placeholder="Email" />
                                    <span id="emailError" style="color: red;"></span>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                                <div class="input-style-1">
                                    <label>Phone</label>
                                    <div class="phone-input-wrapper">
                                        <input id="phone" type="text" name="phone" :value="old('phone')" oninput="validatePhone()" />
                                    </div>
                                    <span id="phoneError" style="color: red;"></span>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                                <div class="input-style-1">
                                    <label>Date of Birth</label>
                                    <input id="dob" type="date" name="dob" :value="old('dob')" oninput="validateDob()" />
                                    <span id="dobError" style="color: red;"></span>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-6">
                                <div class="input-style-1">
                                    <label>Password</label>
                                    <div class="password-wrapper">
                                        <input id="password" type="password" name="password" autocomplete="new-password" />
                                        <span class="eye-icon toggle-password"></span>
                                    </div>
                                    <span id="passwordError" style="color: red;"></span>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                                <div class="input-style-1">
                                    <label>Confirm Password</label>
                                    <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" oninput="validatePasswordConfirm()" />
                                    <span id="passwordErrorConfirm" style="color: red;"></span>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="form-check checkbox-style mb-30">
                                    <input class="form-check-input" type="checkbox" value="" id="termsofuse" required />
                                    <label class="form-check-label" for="checkbox-not-robot">
                                        I agree to the <a href="{{route('terms')}}" target="_blank">terms and conditions</a></label>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="button-group d-flex justify-content-center flex-wrap">
                                    <button class="main-btn primary-btn btn-hover w-25 text-center" type="submit" id="registerButton">
                                        Sign Up
                                    </button>
                                </div>
                                <p class="text-sm text-medium text-dark text-center">
                                    Already have an account? <a href="{{route('login')}}">Sign In</a>
                                </p>
                            </div>
                        </div>
                        <!-- end row -->
                    </form>
                    <!-- <div class="singup-option pt-40"> -->
                    <!-- <p class="text-sm text-medium text-center text-gray">
                                    Easy Sign Up With
                                </p>
                                <div class="button-group pt-40 pb-40 d-flex justify-content-center flex-wrap">
                                    <button class="main-btn primary-btn-outline m-2">
                                        <i class="lni lni-facebook-fill mr-10"></i>
                                        Facebook
                                    </button>
                                    <button class="main-btn danger-btn-outline m-2">
                                        <i class="lni lni-google mr-10"></i>
                                        Google
                                    </button>
                                </div> -->

                    <!-- </div> -->
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <!-- ========== signin-section end ========== -->
</x-base-layout>

<script>
    function validateForm() {

        var isNameValid = validateName();
        var isEmailValid = validateEmail();
        var isPhoneValid = validatePhone();
        var isDateOfBirthValid = validateDob();
        var isPasswordValid = validatePassword();
        var isvalidatePasswordConfirm = validatePasswordConfirm();

        // Check if terms and conditions checkbox is selected
        var isTermsChecked = document.getElementById('termsofuse').checked;

        if (isNameValid && isEmailValid && isPhoneValid && isDateOfBirthValid && isPasswordValid && isvalidatePasswordConfirm && isTermsChecked) {
            return true; // Allow form submission
        } else {
            if (!isTermsChecked) {
                alert('Please agree to the terms and conditions before submitting.');
            }
            return false; // Prevent form submission
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        const registerButton = document.getElementById("registerButton");

        registerButton.addEventListener("click", function(event) {
            // Prevent default form submission behavior
            event.preventDefault();

            // Validate the form
            var isFormValid = validateForm();

            // If the form is valid, submit it
            if (isFormValid) {
                document.getElementById('registrationForm').submit();
            }
        });
    });
</script>