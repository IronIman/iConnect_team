<x-layouts.app :title="__('File Repository')">
    <style>
        .tips-box {
            background: inherit;
            border: 2px solid #c66f28;
            padding: 20px;
            border-radius: 12px;
        }
        .dark .tips-box {
            background: inherit;
            border-left: 5px solid #c66f28;
        }
        .tips-box h3 {
            color: #e2380d;
            margin-bottom: 10px;sss
            font-size: 18px;
        }
        .dark .tips-box h3 {
            color: yellow;
            font-size: 20px;
        }
    </style>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @if($projects->isEmpty())
                <div class="tips-box">
                    <h3>There are currently no projects submitted.</h3>
                    <ul>
                        <li><i>Register your first project <a href="{{ route('project.show') }}" class="underline" style="color: yellow;">here!</a></i></li>
                    </ul>
                </div>
        @else
            @foreach($projects as $project)
            <div class="tips-box">
                <div class="grid auto-rows-min gap-4 lg:grid-cols-1">
                    <div>
                        <h3>Project ID: {{ $project->id }}</h3>
                        <ul>
                            <li>Project Title: {{ $project->title }}</li>
                            <li>Project Status: <strong>{{ $project->status }}</strong></li>
                        </ul>
                    </div> 
                    <div class="grid auto-rows-min gap-4 lg:grid-cols-2">
                        @if($project->receipt == "NOT PAID")
                            <form action="{{ route('file') }}" enctype="multipart/form-data" method="POST" target="_blank">
                                @csrf
                                <div class='mb-4'>
                                    <flux:input type="text" name="id" value="{{ $project->id }}" hidden/>
                                    <flux:input type="text" name="type" value="LOA" hidden/>
                                    <flux:button type='submit' variant='primary' class="w-full" hidden>Letter Of Acceptance</flux:button>
                                </div>
                            </form>
                            <flux:button href="{{ $project->receipt }}" variant='primary' class="w-full" hidden>Receipt</flux:button>
                            <form action="{{ route('file') }}" enctype="multipart/form-data" method="POST" target="_blank">
                                @csrf
                                <div class='mb-4'>
                                    <flux:input type="text" name="id" value="{{ $project->id }}" hidden/>
                                    <flux:input type="text" name="type" value="PARTICIPATION" hidden/>
                                    <flux:button type='submit' variant='primary' class="w-full" hidden>Participation Certificate</flux:button>
                                </div>
                            </form>
                            <form action="{{ route('file') }}" enctype="multipart/form-data" method="POST" target="_blank">
                                @csrf
                                <div class='mb-4'>
                                    <flux:input type="text" name="id" value="{{ $project->id }}" hidden/>
                                    <flux:input type="text" name="type" value="AWARD" hidden/>
                                    <flux:button type='submit' variant='primary' class="w-full" hidden>Award Certificate</flux:button>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('file') }}" enctype="multipart/form-data" method="POST" target="_blank">
                                @csrf
                                <div class='mb-4'>
                                    <flux:input type="text" name="id" value="{{ $project->id }}" hidden/>
                                    <flux:input type="text" name="type" value="LOA" hidden/>
                                    <flux:button type='submit' variant='primary' class="w-full">Letter Of Acceptance</flux:button>
                                </div>
                            </form>
                            <flux:button href="{{ $project->receipt }}" variant='primary' class="w-full">Receipt</flux:button>
                            <form action="{{ route('file') }}" enctype="multipart/form-data" method="POST" target="_blank">
                                @csrf
                                <div class='mb-4'>
                                    <flux:input type="text" name="id" value="{{ $project->id }}" hidden/>
                                    <flux:input type="text" name="type" value="PARTICIPATION" hidden/>
                                    <flux:button type='submit' variant='primary' class="w-full" disabled>Participation Certificate</flux:button>
                                </div>
                            </form>
                            <form action="{{ route('file') }}" enctype="multipart/form-data" method="POST" target="_blank">
                                @csrf
                                <div class='mb-4'>
                                    <flux:input type="text" name="id" value="{{ $project->id }}" hidden/>
                                    <flux:input type="text" name="type" value="AWARD" hidden/>
                                    <flux:button type='submit' variant='primary' class="w-full" disabled>Award Certificate</flux:button>
                                </div>
                            </form>
                        @endif
                        @if($project->status == "COMPLETED")
                            <form action="{{ route('file') }}" enctype="multipart/form-data" method="POST" target="_blank">
                                @csrf
                                <div class='mb-4'>
                                    <flux:input type="text" name="id" value="{{ $project->id }}" hidden/>
                                    <flux:input type="text" name="type" value="LOA" hidden/>
                                    <flux:button type='submit' variant='primary' class="w-full">Letter Of Acceptance</flux:button>
                                </div>
                            </form>
                            <flux:button href="{{ $project->receipt }}" variant='primary' class="w-full">Receipt</flux:button>
                            <form action="{{ route('file') }}" enctype="multipart/form-data" method="POST" target="_blank">
                                @csrf
                                <div class='mb-4'>
                                    <flux:input type="text" name="id" value="{{ $project->id }}" hidden/>
                                    <flux:input type="text" name="type" value="PARTICIPATION" hidden/>
                                    <flux:button type='submit' variant='primary' class="w-full">Participation Certificate</flux:button>
                                </div>
                            </form>
                            <form action="{{ route('file') }}" enctype="multipart/form-data" method="POST" target="_blank">
                                @csrf
                                <div class='mb-4'>
                                    <flux:input type="text" name="id" value="{{ $project->id }}" hidden/>
                                    <flux:input type="text" name="type" value="AWARD" hidden/>
                                    <flux:button type='submit' variant='primary' class="w-full">Award Certificate</flux:button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</x-layouts.app>
