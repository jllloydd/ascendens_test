<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Manager</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
            @layer theme {
                :root, :host {
                    --font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                    --font-serif: ui-serif, Georgia, Cambria, "Times New Roman", Times, serif;
                    --font-mono: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
                }
            }
        </style>
    @endif
</head>
<body class="bg-gray-800 text-dark min-h-screen flex">
    <!-- Left Side: Login/Register Forms -->
    <div class="w-full lg:w-1/2 p-4 lg:p-8 flex items-center justify-center">        @if (Route::has('login'))
            @auth
                <p class="text-center text-white">You are already logged in. <a href="{{ url('/tasksview') }}" class="text-blue-600 hover:underline">Go to tasks</a></p>
            @else
                <!-- Login Form -->
                <div class="w-full max-w-md">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div>
                                <x-input-label for="email" class="text-white" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" class="text-white" :value="__('Password')" />
                                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Remember Me -->
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                    <span class="ms-2 text-sm text-white">{{ __('Remember me') }}</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                @if (Route::has('password.request'))
                                    <a class="text-sm text-blue-400 hover:underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif

                                <x-primary-button class="ms-3 bg-white text-black">
                                    {{ __('Log in') }}
                                </x-primary-button>
                            </div>
                        </form>

                    <!-- Link to the register page -->
                    <div class="mt-4 text-center">
                        <p class="text-sm text-white">Don't have an account? <a href="{{ route('register') }}" class="text-blue-400 hover:underline">Register here</a></p>
                    </div>
                </div>
            @endauth
        @endif
    </div>

    <!-- Right Side: Welcome Message -->
    <div class="w-1/2 p-8 items-center justify-center bg-white hidden lg:flex">
        <div class="max-w-md text-right">
            <h1 class="text-4xl font-bold mb-4">Welcome to Task Manager!</h1>
            <p class="text-lg text-gray-600 dark:text-gray-400">
                Manage your tasks efficiently and stay organized with our simple task management system.
            </p>
        </div>
    </div>
</body>
</html>