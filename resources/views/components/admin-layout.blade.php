<x-admin-sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-admin-sidebar>