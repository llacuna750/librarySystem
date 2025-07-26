<!-- #6 changes -->

<!-- Working remove image -->
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- MAIN PROFILE UPDATE FORM -->
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- AVATAR SECTION -->
        <div>
            <x-input-label for="avatar" :value="__('Profile Photo')" />
            <div class="flex items-center gap-4 mt-2">
                <img src="{{ $user->avatar 
                    ? asset('storage/avatars/' . $user->avatar) 
                    : asset('images/default-avatar.png') }}"
                    alt="Avatar"
                    class="w-16 h-16 rounded-full object-cover">

                <input type="file" name="avatar" id="avatar" class="block text-sm text-gray-500 dark:text-gray-300">
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
            </div>
            @endif
        </div>

        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    <!-- SEPARATE AVATAR REMOVE FORM -->
    @if ($user->avatar)
    <form method="POST" action="{{ route('profile.avatar.remove') }}" class="mt-2">
        @csrf
        @method('DELETE')
        <button type="submit"
            class="text-red-600 text-sm hover:underline"
            onclick="return confirm('Remove avatar?')">
            {{ __('Remove Avatar') }}
        </button>
    </form>
    @endif
</section>

<!-- Back to creating Inventory System
    #9 changes -✅ Step 7: Create Models and Migrations

    php artisan make:model Supplier -mcr
    php artisan make:model Product -mcr
    php artisan make:model Order -mcr
-->