@if(Auth::user()->usertype == "admin")
<x-admin-sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-admin-sidebar>
@endif
@if(Auth::user()->usertype == "contestant")
<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
@endif
