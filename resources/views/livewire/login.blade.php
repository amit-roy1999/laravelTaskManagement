<div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
    {{-- <a href="#" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">

        <img src="{{ config('appConfig.appLogo') }}" class="mr-4 h-11" alt="FlowBite Logo">
        <span>Sign In</span>
    </a> --}}
    <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
        @if ($alert !== null)
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            {{ $alert }}
          </div>
        @endif

        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
             Sign in to platform
        </h2>
            <x-form-builder :formData='$loginForm' />
    </div>
</div>
