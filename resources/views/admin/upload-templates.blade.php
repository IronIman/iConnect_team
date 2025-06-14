<x-admin-layout :title="__('Templates')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative h-full flex-1 overflow rounded-xl border border-neutral-200 dark:border-neutral-700" style="padding: 20px; border-radius: 20px; color: white; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
            <flux:heading size="xl">Upload Awards Recipients</flux:heading>
            <br>
            <form action="/update-award-status" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <flux:input label="Upload Excel File" type="file" name="file"/>
                </div>
                <div class="mb-4">
                    <flux:button type="submit" variant="primary">Upload</flux:button>
                </div>
                <div class="mb-4">
                    <flux:label>Download this template!</flux:label>
                    <flux:button href="{{ route('template') }}">Download Template</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>