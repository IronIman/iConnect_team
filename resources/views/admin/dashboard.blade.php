<x-admin-layout :title="__('Admin Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative h-full flex-1 overflow-hidden rounded-xl" style="padding:12px;">
            <table class="table-auto border-collapse border border-gray-300 w-full text-center">
            <thead>
                <tr class="rounded-sm">
                <th class="border border-gray-300 px-4 py-2">Project ID</th>
                <th class="border border-gray-300 px-4 py-2">Project Title</th>
                <th class="border border-gray-300 px-4 py-2">Contact Email</th>
                <th class="border border-gray-300 px-4 py-2">Contact Number</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <th class="border border-gray-300 px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                    @if($projects->isEmpty())
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">No projects found</td>
                    </tr>
                    @else
                    <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $project->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $project->title }}</td>
                    <td class="border border-gray-300 px-4 py-2 justify-items-center">{{ $project->email }}</td>
                    <td class="border border-gray-300 px-4 py-2 justify-items-center">{{ $project->phone }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        @if($project->status == "DRAFT")
                        <flux:badge size="lg" icon="folder" variant="solid" color="yellow">{{ $project->status }}</flux:badge>
                        @elseif($project->status == "SUBMITTED")
                        <flux:badge size="lg" icon="folder" variant="solid" color="green">{{ $project->status }}</flux:badge>
                        @elseif($project->status == "COMPLETED")
                        <flux:badge size="lg" icon="folder" variant="solid" color="blue">{{ $project->status }}</flux:badge>
                        @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-2 justify-items-center">
                        <flux:button href="{{ route('details.show',[$project->id]) }}" icon="eye">More Details</flux:button>
                    </td>
                    @endif
                @endforeach
                </tr>
            </tbody>
            </table>
            <br>
            <div>
                <flux:button.group>
                    <flux:button href="{{ route('pdf') }}" variant="primary">Save as PDF</flux:button>
                    <flux:button href="{{ route('excel') }}">Save as xlsx</flux:button>
                </flux:button.group>
            </div>
        </div>
    </div>
    <script>
    </script>
</x-admin-layout>