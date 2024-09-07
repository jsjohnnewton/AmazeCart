<!DOCTYPE html>
<html lang="en">

@include('home.head')


<body>



    <!-- Header -->
    @include('home.header')
    <!-- /header -->
    <!-- navigation -->
    @include('home.dashboard.navigation')
    <!-- navigation -->


    <style>
        .btn {
            background-color: red !important;
        }


        input,
        label,
        button,
        select {
            padding: 2px;
            /* border: 1px solid #ccc;
            border-radius: 5px; */
            margin-right: 5px;
            font-size: 1.7rem !important;
        }

        input {
            border: 1px solid #ccc;
            /* border-radius: 5px; */
        }

        .text-sm {
            font-size: 13px !important;
        }
    </style>

    <div class="main-panel">
        <div class="content-wrapper">

            <div class="section mb-4">
                <!-- container -->
                <div class="container">

                    <div class="row">
                        <x-slot name="header">

                            {{ __('Profile') }}

                        </x-slot>
                        <div class="mx-auto py-10 sm:px-6 lg:px-8 ex-large">
                            @if (Laravel\Fortify\Features::canUpdateProfileInformation())


                            @livewire('profile.update-profile-information-form')

                            <x-section-border />
                            @endif

                            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                            <div class="mt-10 sm:mt-0" id="changepassword">
                                @livewire('profile.update-password-form')
                            </div>

                            <x-section-border />
                            @endif


                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.logout-other-browser-sessions-form')
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                            <x-section-border />

                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.delete-user-form')
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- FOOTER -->
    @include('home.footer')
    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
    <script src="home/js/jquery.min.js"></script>
    <script src="home/js/bootstrap.min.js"></script>
    <script src="home/js/slick.min.js"></script>
    <script src="home/js/nouislider.min.js"></script>
    <script src="home/js/jquery.zoom.min.js"></script>
    <script src="home/js/main.js"></script>

</body>

</html>