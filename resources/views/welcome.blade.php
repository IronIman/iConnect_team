<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <link rel="icon" type="image/x-icon" href="\images\logo_idrivers.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />  

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxAppearance
    </head>
    <body class="text-[#fdfdfd] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
            <div class="grid auto-rows-min gap-4 lg:grid-cols-2">
                <div class="flex items-center justify-center rounded-xl bg-white text-accent-foreground" style="box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                    <x-app-logo-icon class="size-5 rounded-md fill-current text-white dark:text-black" />
                </div>
                <div class="relative aspect-video overflow rounded-xl" style="padding: 20px; border-radius: 20px; color: white; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                    <flux:container class="space-y-6">
                        <div>
                            <flux:heading size="xl" class="text-center">WELCOME</flux:heading>
                        </div>
                        <div class="space-y-2">
                            @if (Route::has('login'))
                            @auth
                                <flux:button href="{{ route('dashboard') }}" class="w-full">Dashboard</flux:button>
                            @else
                                <flux:label>Already registered?</flux:label>
                                <flux:button href="{{ route('login') }}" variant="primary" class="w-full">Log in</flux:button>
                                <flux:label>Register for a new user</flux:label>
                                <flux:button href="{{ route('register') }}" variant="primary" class="w-full">Register</flux:button>
                            @endauth
                            @endif
                        </div>
                    </flux:container>
                </div>
            </div>
            <div class="grid auto-rows-min gap-4 lg:grid-cols-1">
                <div class="space-y-4">
                    <p style="font-size:25px;font-style:italic;padding-top:115px;">"Pioneering Horizons: Bridging Fundamentals, Humanizing Technology and Shaping the Future"</p>
                </div>
            </div>
        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>
