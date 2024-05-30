<x-app-layout>

    <div class="py-8 bg-gradient-to-bl from-white via-blue-200 to-white">
        <h2 class="mb-4 ml-10 font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-gray-500 bg-opacity-25 p-4 sm:p-8 dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            @if (!Auth::user()->external_id)
            <div class="p-4 sm:p-8 bg-gray-500 bg-opacity-25 dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            @else
                <!-- Si el usuario ha autenticado con Google, mostrar un mensaje o simplemente no mostrar el enlace -->
                <p>No es posible cambiar la contraseña si has iniciado sesión con Google.</p>
            @endif

            <div class="p-4 sm:p-8 bg-gray-500 bg-opacity-25 dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
