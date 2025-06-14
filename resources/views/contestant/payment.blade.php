<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased ">
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
                        <div class="px-10 py-8">
                            <form method="POST" action="{{ route('checkout') }}">
                            @csrf
                            @method("POST")
                                @if($publicationValue == "Yes")
                                    <li>Project ID: {{ $project->id }}</li>
                                    <flux:input name="id" value="{{ $project->id }}" hidden/>
                                    @if($project->currency == "USD")
                                    <li class="mb-2">Total Fee: {{ $project->currency }} <span> {{ $project->cat_fee + 11.80 }}</li>  
                                    <flux:input name="fee" value="{{ $project->cat_fee + 11.80 }}" hidden/>
                                    <flux:input name="currency" value="usd" hidden/>
                                    <flux:button.group class="mt-4">
                                        <flux:button type="submit" variant="primary" class="w-full">Proceed to Payment</flux:button>
                                        <flux:button href="{{ route('dashboard') }}" class="w-full">Back</flux:button>
                                    </flux:button.group>
                                    @else                   
                                    <li class="mb-2">Total Fee: {{ $project->currency }} <span> {{ $project->cat_fee + 50 }}</li>
                                    <flux:input name="fee" value="{{ $project->cat_fee + 50 }}" hidden/>
                                    <flux:input name="currency" value="myr" hidden/> 
                                    <flux:button.group class="mt-4">
                                        <flux:button type="submit" variant="primary" class="w-full">Proceed to Payment</flux:button>
                                        <flux:button href="{{ route('dashboard') }}" class="w-full">Back</flux:button>
                                    </flux:button.group> 
                                    @endif
                                @else
                                    <li>Project ID: {{ $project->id }}</li>
                                    <flux:input name="id" value="{{ $project->id }}" hidden/>
                                    <flux:input name="fee" value="{{ $project->cat_fee }}" hidden/>
                                    @if($project->currency == "USD")
                                    <li class="mb-2">Total Fee: {{ $project->currency }} <span> {{ $project->cat_fee }}</li>  
                                    <flux:input name="currency" value="usd" hidden/>
                                        <flux:button.group class="mt-4">
                                            <flux:button type="submit" variant="primary" class="w-full">Proceed to Payment</flux:button>
                                            <flux:button href="{{ route('dashboard') }}" class="w-full">Back</flux:button>
                                        </flux:button.group>
                                    @else                   
                                    <li class="mb-2">Total Fee: {{ $project->currency }} <span> {{ $project->cat_fee }}</li>  
                                    <flux:input name="currency" value="myr" hidden/>
                                    <flux:button.group class="mt-4">
                                        <flux:button type="submit" variant="primary" class="w-full">Proceed to Payment</flux:button>
                                        <flux:button href="{{ route('dashboard') }}" class="w-full">Back</flux:button>
                                    </flux:button.group>
                                    @endif
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>

