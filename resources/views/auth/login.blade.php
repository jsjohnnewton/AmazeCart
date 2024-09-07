<x-base-layout>
    <!-- ========== signin-section start ========== -->


    <div class="row g-0 auth-row mt-10 d-flex justify-content-center mx-auto w-50">

        <!-- end col -->

        <div class=" col-lg-12">
            <div class="signin-wrapper">
                <div class="form-wrapper">
                    <div class="invoice-logo mb-50 d-flex justify-content-center">
                        <a href="/">
                            <img src="/img/newlogo.png" alt="logo" height="50" />
                        </a>
                    </div>
                   
                    @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div style="color:red">
                        <x-validation-errors class="mb-4" />
                    </div>

                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-10">
                                <div class="input-style-1">
                                    <label>Email</label>
                                    <input type="email" placeholder="Email" id="email" name="email" required autofocus autocomplete="username" />
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12 mb-10">
                                <div class="input-style-1">
                                    <label>Password</label>
                                    <div class="password-wrapper">
                                        <input id="password" type="password" name="password" required autocomplete="current-password" />
                                        <span class="eye-icon toggle-password"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-xxl-6 col-lg-12 col-md-6">
                                <div class="form-check checkbox-style mb-30">
                                    <input class="form-check-input" type="checkbox" value="" id="remember_me" name="remember" />
                                    <label class="form-check-label" for="checkbox-remember">
                                        Remember me</label>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-xxl-6 col-lg-12 col-md-6">
                                <div class="text-start text-md-end text-lg-start text-xxl-end mb-30">
                                    <a href="{{ route('password.request') }}" class="hover-underline">
                                        Forgot Password?
                                    </a>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="button-group d-flex justify-content-center flex-wrap">
                                    <button class="main-btn primary-btn btn-hover w-50 text-center">
                                        Sign In
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
                        <p class="text-sm text-medium text-dark text-center">
                            Don’t have any account yet?
                            <a href="{{route('register')}}">Create an account</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <!-- ========== signin-section end ========== -->
</x-base-layout>