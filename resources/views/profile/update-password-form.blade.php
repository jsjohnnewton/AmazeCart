<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('Current Password') }}" />
            <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('New Password') }}" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
            <span id="passwordError" style="color: red;"></span>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button>
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>

<script>
    function validatePassword() {

        const passwordInput = document.getElementById("password");
        const passwordError = document.getElementById("passwordError");
        const password = passwordInput.value;
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
            return false;
        } else {
            passwordError.textContent = "";
            passwordError.style.display = "none";
            return true;
        }

    }

    document.addEventListener("DOMContentLoaded", function() {
        const passwordInput = document.getElementById("password");

        passwordInput.addEventListener("input", validatePassword);
    });
</script>