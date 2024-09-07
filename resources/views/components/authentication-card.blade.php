<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        <div class="invoice-logo mb-50 d-flex justify-content-center">
            <a href="/">
                <img src="/img/newlogo.png" alt="logo" style="height:60px" />
            </a>
        </div>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>