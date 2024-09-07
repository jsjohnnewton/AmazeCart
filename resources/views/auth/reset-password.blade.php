<x-base-layout>
    <!-- ========== signin-section start ========== -->


    <div class="row g-0 auth-row">
        <div class="col-lg-4">
            <div class="auth-cover-wrapper bg-primary-100">
                <div class="auth-cover">
                    <div class="title text-center">
                        <div class="invoice-logo mb-50">
                            <a href="/">
                                <img src="/img/newlogo.png" alt="logo" height="50" />
                            </a>
                        </div>
                        <h1 class="text-primary mb-10">Reset Password</h1>
                        <p class="text-medium">
                            It happens to the best of us.
                            <br class="d-sm-block" />
                            Enter your new password and confirm to reset.
                            <br class="d-sm-block" />
                            Keep it secure!
                        </p>
                    </div>
                    <div class="cover-image">
                        <img src="/assets/images/auth/signin-image.svg" alt="" />
                    </div>
                    <div class="shape-image">
                        <img src="/assets/images/auth/shape.svg" alt="" />
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
        <div class="col-lg-8">
            <div class="signin-wrapper">
                <div class="form-wrapper">
                    <h6 class="mb-15">AmazeCart</h6>
                    <p class="text-sm mb-25">
                        Welcome to Best User Experiance
                    </p>
                    @if (session('status'))
                    <div class="text-danger">
                        {{ session('status') }}
                    </div>
                    @endif
                    <x-validation-errors class="text-danger" />

                    <form method="POST" action="{{ route('password.update') }}" id='passwordUpdateForm'>
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-style-2">
                                    <label>Email</label>
                                    <x-input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="input-style-2">
                                    <label>Password</label>
                                    <div class="password-wrapper">
                                        <input id="password" type="password" name="password" required autofocus autocomplete="new-password" />
                                        <span class="eye-icon toggle-password"></span>
                                    </div>
                                    <span id="passwordError" style="color: red;"></span>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="input-style-2">
                                    <label>Confirm Password</label>

                                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" oninput="validatePasswordConfirm()" />
                                    <span id="passwordErrorConfirm" style="color: red;"></span>

                                </div>
                            </div>
                            <!-- end col -->
                            <!-- <div class="col-xxl-6 col-lg-12 col-md-6">
                                <div class="form-check checkbox-style mb-30">
                                    <input class="form-check-input" type="checkbox" value="" id="remember_me" name="remember" />
                                    <label class="form-check-label" for="checkbox-remember">
                                        Remember me</label>
                                </div>
                            </div> -->
                            <!-- end col -->
                            <div class="col-xxl-6 col-lg-12 col-md-6">
                                <div class="text-start text-md-end text-lg-start text-xxl-end mb-30">
                                    <a href="{{ route('password.request') }}" class="hover-underline">
                                        Resend Password reset link?
                                    </a>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="button-group d-flex justify-content-center flex-wrap">
                                    <button class="main-btn primary-btn btn-hover w-100 text-center" type="submit" id="PasswordResetButton">
                                        Reset Password
                                    </button>
                                </div>
                            </div>



                        </div>
                        <!-- end row -->
                    </form>
                    <div class="singin-option pt-40">
                        <!-- <p class="text-sm text-medium text-center text-gray">
                                    Easy Sign In With
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
                        <!-- <p class="text-sm text-medium text-dark text-center">

                            <a href="{{route('login')}}">Go to Login</a>
                        </p> -->
                    </div>
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



        var isPasswordValid = validatePassword();
        var isvalidatePasswordConfirm = validatePasswordConfirm();

        if (isPasswordValid && isvalidatePasswordConfirm) {
            return true; // Allow form submission
        } else {
            return false; // Prevent form submission
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        const registerButton = document.getElementById("PasswordResetButton");

        registerButton.addEventListener("click", function(event) {
            // Prevent default form submission behavior
            event.preventDefault();

            // Validate the form
            var isFormValid = validateForm();

            // If the form is valid, submit it
            if (isFormValid) {
                document.getElementById('passwordUpdateForm').submit();
            }
        });
    });
</script>