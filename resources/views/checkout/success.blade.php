<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-neutral-100 antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="bg-muted flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-md flex-col gap-6">
                <a href="{{ route('dashboard') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <span class="flex items-center justify-center rounded-md bg-accent-content text-accent-foreground">
                        <x-app-logo-icon class="size-2 fill-current text-black dark:text-white" />
                    </span>
                    <span class="sr-only">{{ config('app.name') }}</span>
                </a>

                <div class="flex flex-col gap-6">
                    <div class="rounded-xl border">
                        <div class="px-10 py-8 justify-items-center text-center">
                            <flux:heading class="mb-2">Your receipt has been sent to your email!</flux:heading>
                            <flux:button variant="primary" size="sm" href="{{ route('repository.show') }}">Return to repository</flux:button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>