<x-base-layout>
    <!-- ========== signin-section start ========== -->


    <div class="row g-0 mt-50 mx-auto auth-row d-flex justify-content-center w-50">

        <!-- end col -->
        <div class="col-sm-12">
            <div class="signin-wrapper">
                <div class="form-wrapper">
                    <div class="invoice-logo mb-50 d-flex justify-content-center">
                        <a href="/">
                            <img src="/img/newlogo.png" alt="logo" height="50" />
                        </a>
                    </div>
                    <p class="text-primary mb-10">Forgot Password</p>

                    <x-validation-errors class="mb-4" />
                    @if (session('status'))
                    <div class="text-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="input-style-1 mb-10">
                                    <label>Email</label>
                                    <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                </div>
                            </div>
                        

                            <div class="col-12 mb-10">
                                <div class="button-group d-flex justify-content-center flex-wrap">
                                    <button class="main-btn primary-btn btn-hover w-100 text-center">
                                        Email Password Reset Link
                                    </button>
                                </div>
                            </div>

                            <div class="col-xxl-6 col-lg-12 col-md-6">
                                <div class="text-start text-md-end text-lg-start text-xxl-end mb-30">
                                    <a href="{{ route('login') }}" class="hover-underline">
                                        Sign In with Password
                                    </a>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                        <p class="text-sm text-medium text-dark text-center">
                            Don’t have any account yet?
                            <a href="{{route('register')}}">Create an account</a>
                        </p>
                    </form>
                    <!-- <div class="singin-option pt-40"> -->
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
                            Don’t have any account yet?
                            <a href="{{route('register')}}">Create an account</a>
                        </p> -->
                    <!-- </div> -->
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <!-- ========== signin-section end ========== -->
</x-base-layout>