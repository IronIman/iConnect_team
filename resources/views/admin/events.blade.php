<x-admin-layout :title="__('Admin Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative h-full flex-1 overflow rounded-xl border border-neutral-200 dark:border-neutral-700" style="padding: 20px; border-radius: 20px; color: white; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
            <table class="table-auto border-collapse border border-gray-300 w-full">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Event Name</th>
                        <th class="border border-gray-300 px-4 py-2">Registration Date</th>
                        <th class="border border-gray-300 px-4 py-2">Evaluation Date</th>
                        <th class="border border-gray-300 px-4 py-2">Final Submission Date</th>
                        <th class="border border-gray-300 px-4 py-2">Top 10 Announcement</th>
                        <th class="border border-gray-300 px-4 py-2">Exhibition</th>
                        <th class="border border-gray-300 px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{$event->name}}</td>
                        <td class="border border-gray-300 px-4 py-2">From:<span>{{$event->date_register_start}}
                            <br>To: {{$event->date_register_end}}</td>
                        <td class="border border-gray-300 px-4 py-2">From:{{$event->date_evaluate_start}} 
                            <br>To:{{$event->date_evaluate_end}}</td>
                        <td class="border border-gray-300 px-4 py-2">{{$event->date_submission}}</td>
                        <td class="border border-gray-300 px-4 py-2">{{$event->date_announcement}}</td>
                        <td class="border border-gray-300 px-4 py-2">{{$event->date_ceremony}}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <flux:button type="submit" variant="danger" size="sm">Delete</flux:button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="grid auto-rows-min gap-4 lg:grid-cols-1">
            <div class="relative h-full flex-1 overflow rounded-xl border border-neutral-200 dark:border-neutral-700" style="padding: 20px; border-radius: 20px; color: white; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                <form style="background: inherit; text-color: white;" action="{{ route('events.add') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <flux:input label="Event Name" type="text" name="name" required/>
                    </div>
                    <div class="mb-4">
                        <flux:textarea rows="4" label="Event Description" type="text" name="description" required/>
                    </div>
                    <div class="mb-4">
                        <flux:input.group label="Registration Dates">
                            <flux:input name="date_register_start" type="date" label="Start" nullable/>
                            <flux:input name="date_register_end" type="date" label="End" required/>
                        </flux:input.group>
                    </div>
                    <div class="mb-4">
                        <flux:input.group label="Evaluation Dates">
                            <flux:input name="date_evaluate_start" type="date" label="Start" nullable/>
                            <flux:input name="date_evaluate_end" type="date" label="End" required/>
                        </flux:input.group>
                    </div>
                    <div class="mb-4">
                        <flux:input.group label="Final Submission Date">
                            <flux:input name="date_submission" type="date" required/>
                        </flux:input.group>
                    </div>
                    <div class="mb-4">
                        <flux:input.group label="Top 10 Announcement Date">
                            <flux:input name="date_announcement" type="date" required/>
                        </flux:input.group>
                    </div>
                    <div class="mb-4">
                        <flux:input.group label="Physical Exhibition Date">
                            <flux:input name="date_ceremony" type="date" required/>
                        </flux:input.group>
                    </div>
                    <flux:button type="submit" variant="primary">Add Event</flux:button>
                </form>
            </div>
        </div>
        <div class="grid auto-rows-min gap-4 lg:grid-cols-1">
            @foreach($events as $event)
            <div class="relative h-full flex-1 overflow rounded-xl border border-neutral-200 dark:border-neutral-700" style="padding: 20px; border-radius: 20px; color: white; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                <form style="background: inherit; text-color: white;" action="{{ route('events.edit',$event->id) }}" method="GET">
                    @csrf
                    <div class="mb-4">
                        <flux:input label="Event Name" type="text" name="name" value="{{ $event->name }}" required/>
                    </div>
                    <div class="mb-4">
                        <flux:textarea rows="4" label="Event Description" type="text" name="description" required>{{ $event->description }}</flux:textarea>
                    </div>
                    <div class="mb-4">
                        <flux:input.group label="Registration Dates">
                            <flux:input name="date_register_start" type="date" value="{{ $event->date_register_start }}" nullable/>
                            <flux:input name="date_register_end" type="date" value="{{ $event->date_register_end }}" required/>
                        </flux:input.group>
                    </div>
                    <div class="mb-4">
                        <flux:input.group label="Evaluation Dates">
                            <flux:input name="date_evaluate_start" type="date" value="{{ $event->date_evaluate_start }}" nullable/>
                            <flux:input name="date_evaluate_end" type="date" value="{{ $event->date_evaluate_end }}" required/>
                        </flux:input.group>
                    </div>
                    <div class="mb-4">
                        <flux:input.group label="Final Submission Date">
                            <flux:input name="date_submission" type="date" value="{{ $event->date_submission }}" required/>
                        </flux:input.group>
                    </div>
                    <div class="mb-4">
                        <flux:input.group label="Top 10 Announcement Date">
                            <flux:input name="date_announcement" type="date" value="{{ $event->date_announcement }}" required/>
                        </flux:input.group>
                    </div>
                    <div class="mb-4">
                        <flux:input.group label="Physical Exhibition Date">
                            <flux:input name="date_ceremony" type="date" value="{{ $event->date_ceremony }}" required/>
                        </flux:input.group>
                    </div>
                    <flux:button type="submit" variant="primary">Save Edit</flux:button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</x-admin-layout>