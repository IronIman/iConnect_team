<x-admin-layout :title="__('Admin Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative h-full flex-1 overflow rounded-xl border border-neutral-200 dark:border-neutral-700" style="padding: 20px; border-radius: 20px; color: white; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
            <table class="table-auto border-collapse border border-gray-300 w-full">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Category Name</th>
                        <th class="border border-gray-300 px-4 py-2">Category Description</th>
                        <th class="border border-gray-300 px-4 py-2">Category Fee</th>
                        <th class="border border-gray-300 px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{$category->name}}</td>
                        <td class="border border-gray-300 px-4 py-2">{{$category->description}}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $category->currency }} <span>  {{$category->fee}}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <flux:button type="submit" variant="danger">Delete</flux:button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="grid auto-rows-min gap-4 lg:grid-cols-1">
            <div class="relative h-full flex-1 overflow rounded-xl border border-neutral-200 dark:border-neutral-700" style="padding: 20px; border-radius: 20px; color: white; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                <form style="background: inherit; text-color: white;" action="{{ route('categories.add') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <flux:input label="Category Name" type="text" name="name" required/>
                    </div>
                    <div class="mb-4">
                        <flux:input label="Category Description" type="text" name="description" required/>
                    </div>
                    <div class="mb-4">
                        <flux:input label="Category Fee" type="text" name="fee"  required/>  
                    </div>
                    <div class="mb-4">
                        <flux:radio.group name="currency" label="Currency of exchange" required>
                            <flux:radio value="MYR" label="MYR"/>
                            <flux:radio value="USD" label="USD"/>
                        </flux:radio.group>
                    </div>
                    <flux:button type="submit" variant="primary">Add Category</flux:button>
                </form>
            </div>
        </div>
        <div class="grid auto-rows-min gap-4 lg:grid-cols-2">
            @foreach($categories as $category)
            <div class="relative aspect-video overflow rounded-xl border border-neutral-200 dark:border-neutral-700" style="padding: 20px; border-radius: 20px; color: white; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                <form style="background: inherit; text-color: white;" action="{{ route('categories.edit') }}" method="GET">
                    @csrf
                    <div class="mb-4">
                        <flux:input label="Category Name" type="text" name="name" value="{{ $category->name }}" required/>
                    </div>
                    <div class="mb-4">
                        <flux:input label="Category Description" type="text" name="description" value="{{ $category->description }}" required/>
                    </div>
                    <div class="mb-4">
                        <flux:input label="Category Fee" type="number" name="fee" value="{{ $category->fee }}" required/>
                    </div>
                    <div class="mb-4">
                    @if($category->currency == "MYR")
                        <flux:radio.group name="currency" label="Currency of exchange" required>
                            <flux:radio value="MYR" label="MYR" checked/>
                            <flux:radio value="USD" label="USD"/>
                        </flux:radio.group>
                    @else
                        <flux:radio.group name="currency" label="Currency of exchange" required>
                            <flux:radio value="MYR" label="MYR"/>
                            <flux:radio value="USD" label="USD" checked/>
                        </flux:radio.group>
                    @endif
                </div>
                    <flux:input name="id" value="{{ $category->id }}" hidden/>
                    <flux:button type="submit" variant="primary">Save Edit</flux:button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</x-admin-layout>