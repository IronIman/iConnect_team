@if(Route::is('project.show'))
<x-layouts.app :title="__('Add Project')">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const textarea = document.getElementById('abstract');
            const wordCountDisplay = document.getElementById('wordCount');
            textarea.addEventListener("input", function () {
                // Buang space depan belakang dan split ikut 1 atau lebih white space
                const words = this.value.trim().split(/\s+/).filter(word => word.length > 0);
                const wordCount = words.length;
                if (wordCount > 500) {
                    // Potong perkataan lebih
                    this.value = words.slice(0, 500).join(' ');
                }
                // Update word count display
                wordCountDisplay.textContent = `${Math.min(wordCount, 500)}/500 words`;
            });
            document.querySelector("#phone").addEventListener("input", function (e) {
                e.target.value = e.target.value.replace(/[^0-9+]/g, '');
            });
            const input = document.querySelector("#phone");
            window.intlTelInput(input, {
                nationalMode: false,
                initialCountry: "MY",
                loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js"),
            });

            const first = document.getElementById("first");
            const second = document.getElementById("second");
            const third = document.getElementById("third");
            const fourth = document.getElementById("fourth");
            first.addEventListener("input", () => {
                if (first.value.trim() !== "") {
                second.disabled = false;
                third.disabled = false;
                fourth.disabled = false;
                } else {
                second.disabled = true;
                third.disabled = true;
                fourth.disabled = true;
                second.value = ""; // optional: clear the second input
                }
            });
        });
    </script>
    <style>
        .tips-box {
            background: linear-gradient(to right, yellow, orange);
            border: 2px solid #c66f28;
            padding: 20px;
            border-radius: 12px;
        }
        .dark .tips-box {
            background: inherit;
            border-left: 2px solid #c66f28;
            padding: 20px;
            border-radius: 12px;
        }
        .tips-box h3 {
            color: #e2380d;
            margin-bottom: 10px;sss
            font-size: 18px;
            font-style: bold;
        }
        .dark .tips-box h3 {
            color: yellow;
        }
        .tips-box ul {
            padding-left: 20px;
            font-size: 14px;
        }
        .dark .tips-box ul {
            padding-left: 20px;
            font-size: 14px;
        }
        .tips-box li {
            margin-bottom: 8px;
        }
    </style>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="tips-box">
            <h3><b>Read Me</b></h3>
            <ul>
                <li><strong style="font-size: 20px;color: yellow;">*</strong>  indicates <strong>REQUIRED</strong> section.</li>
                <li>All names entered must be full name.</li>
                <li>Mailing address must be your <strong>CURRENT</strong> address.</li>
                <li>Minimum number of a team member is <strong>2</strong>. Maximum is <strong>4</strong>.</li>
                <li>If you choose to publish 'Book of Chapters', an additional fee of <strong>RM50</strong> will be added.</li>
                <li>An Innovation video is required to submit before the registration ends.</li>
                <li>After payment is successful, you can no longer delete your project.</li>
                <li><i>To learn more about your project status, <a href="{{ route('information') }}" class="underline" style="color: yellow;"> click here!</a></i></li>
            </ul>
        </div>
        <div class="p-4 relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <form method='POST' action='{{ route('project.add') }}' enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="mb-4">
                    <flux:label class="pb-2">Project Title <b style="color:yellow;">*</b></flux:label>
                    <flux:input type="text" name="title" oninput="this.value = this.value.toUpperCase()" required/>
                </div>
                <div class="mb-4">
                    <flux:label class="pb-2">Project Abstract (Not more than 500 words!)<b style="color:yellow;">*</b> </flux:label>
                    <flux:textarea type="text" rows="4"  name="abstract" id="abstract" required/>
                    <small id="wordCount" class="text-gray-500">0/500 words</small>
                </div>
                <div class="mb-4">
                    <flux:label class="pb-2">University / School / Organization / Company (eg: SMK Bunga Raya)<b style="color:yellow;">*</b> </flux:label>
                    <flux:input type="text"  name="organisation" oninput="this.value = this.value.toUpperCase()" required/>
                </div>
                <div class="mb-4">
                    <flux:label class="pb-2">Project Leader (eg: MUHAMMAD BIN ALI)<b style="color:yellow;">*</b> </flux:label>
                    <flux:input type="text"  name="leader" oninput="this.value = this.value.toUpperCase()" required/>
                </div>
                <div class="mb-4">
                    <flux:label class="pb-2">First Member (eg: ALIA BINTI ABU)<b style="color:yellow;">*</b> </flux:label>
                    <flux:input id="first" type="text"  name="member1" oninput="this.value = this.value.toUpperCase()" required/>
                </div>
                <div class="mb-4">
                    <flux:input id="second" type="text"  name="member2" oninput="this.value = this.value.toUpperCase()" label="Second Member" disabled/>
                </div>
                <div class="mb-4">
                    <flux:input id="third" type="text"  name="member3" oninput="this.value = this.value.toUpperCase()" label="Third Member" disabled/>
                </div>
                <div class="mb-4">
                    <flux:input id="fourth" type="text"  name="member4" oninput="this.value = this.value.toUpperCase()" label="Fourth Member" disabled/>
                </div>
                <div class="mb-4">
                    <flux:label class="pb-2">Project Category <b style="color:yellow;">*</b></flux:label>
                    <flux:select name="category_id" required>
                        @foreach($categories as $category){
                            <flux:select.option value="{{ $category->id }}">{{$category->name}}</flux:select.option>
                        }
                        @endforeach
                    </flux:select>
                </div>
                <div class="mb-4">
                    <flux:label class="pb-2">Mailing Address (Please give full address - including country, state, ZIP code)<b style="color:yellow;">*</b> </flux:label>
                    <flux:input type="text"  name="address" required/>
                </div>
                <div class="mb-4" style="color: black;">
                    <flux:label class="pb-2">Contact Number (Must include country code!)<b style="color:yellow;">*</b> </flux:label>
                    <flux:input type="tel" id="phone" name="phone" required/>
                </div>
                <div class="mb-4">
                    <flux:radio.group name="publication" label="Book of Chapters Publications" nullable>
                        <flux:radio value="Yes" label="Yes"/>
                        <flux:radio value="No" label="No"/>
                    </flux:radio.group>
                </div>
                <div class="mb-4">
                    <flux:input type="file" name="technical_paper" label="Technical Paper (Only submit if you chose 'Yes')"/>
                </div>
                <div class="mb-4">
                    <flux:input type="url"  name="link" label="Video Submission Link" nullable/>
                </div>
                <flux:input type='text' name='user_id' value='{{ auth()->user()->id }}' hidden/>
                <flux:input type="email" name="email" value="{{ auth()->user()->email }}" hidden/>
                <flux:select name="event_id" hidden>
                    @foreach($events as $event){
                        <flux:select.option value="{{ $event->id }}">{{$event->name}}</flux:select.option>
                    }
                    @endforeach
                </flux:select>
                <flux:button type="submit" variant="primary" class="w-full">Add Project</flux:button>
            </form>
        </div>
    </div>
</x-layouts.app>
@endif

@if(Route::is('edit.show'))
<x-layouts.app :title="__('Edit Project')">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const textarea = document.getElementById('abstract');
            const wordCountDisplay = document.getElementById('wordCount');
            textarea.addEventListener("input", function () {
                // Buang space depan belakang dan split ikut 1 atau lebih white space
                const words = this.value.trim().split(/\s+/).filter(word => word.length > 0);
                const wordCount = words.length;
                if (wordCount > 500) {
                    // Potong perkataan lebih
                    this.value = words.slice(0, 500).join(' ');
                }
                // Update word count display
                wordCountDisplay.textContent = `${Math.min(wordCount, 500)}/500 words`;
            });
            document.querySelector("#phone").addEventListener("input", function (e) {
                e.target.value = e.target.value.replace(/[^0-9+]/g, '');
            });
            const input = document.querySelector("#phone");
            window.intlTelInput(input, {
                nationalMode: false,
                loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js"),
            });

            const first = document.getElementById("first");
            const second = document.getElementById("second");
            const third = document.getElementById("third");
            const fourth = document.getElementById("fourth");
            first.addEventListener("input", () => {
                if (first.value.trim() !== "") {
                second.disabled = false;
                third.disabled = false;
                fourth.disabled = false;
                } else {
                second.disabled = true;
                third.disabled = true;
                fourth.disabled = true;
                second.value = ""; // optional: clear the second input
                }
            });
        });
    </script>
    <style>
        .tips-box {
            background: linear-gradient(to right, yellow, orange);
            border: 2px solid #c66f28;
            padding: 20px;
            border-radius: 12px;
        }
        .dark .tips-box {
            background: inherit;
            border-left: 2px solid #c66f28;
            padding: 20px;
            border-radius: 12px;
        }
        .tips-box h3 {
            color: #e2380d;
            margin-bottom: 10px;sss
            font-size: 18px;
            font-style: bold;
        }
        .dark .tips-box h3 {
            color: yellow;
        }
        .tips-box ul {
            padding-left: 20px;
            font-size: 14px;
        }
        .dark .tips-box ul {
            padding-left: 20px;
            font-size: 14px;
        }
        .tips-box li {
            margin-bottom: 8px;
        }
    </style>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="tips-box">
            <h3><b>Read Me</b></h3>
            <ul>
                <li><strong style="font-size: 20px;color: yellow;">*</strong>  indicates <strong>REQUIRED</strong> section.</li>
                <li>All names entered must be full name.</li>
                <li>Mailing address must be your <strong>CURRENT</strong> address.</li>
                <li>Minimum number of a team member is <strong>2</strong>. Maximum is <strong>4</strong>.</li>
                <li>If you choose to publish 'Book of Chapters', an additional fee of RM50 will be added.</li>
                <li>An Innovation video is required to submit before the registration ends.</li>
                <li>After payment is successful, you can no longer delete your project.</li>
                <li><i>To learn more about your project status, <a href="{{ route('information') }}" class="underline" style="color: yellow;"> click here!</a></i></li>
            </ul>
        </div>
        <div class="p-4 relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <form method='POST' action='{{ route('project.edit') }}' enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="mb-4">
                    <flux:label class="pb-2">Project Title <b style="color:yellow;">*</b></flux:label>
                    <flux:input  type="text" name="title" value="{{ $project->title }}" required/>
                </div>
                <div class="mb-4">
                    <flux:label class="pb-2">Project Abstract (Not more than 500 words!)<b style="color:yellow;">*</b> </flux:label>
                    <flux:textarea type="text" rows="4"  name="abstract" id="abstract" required>{{ $project->abstract }}</flux:textarea>
                    <small id="wordCount" class="text-gray-500">0/500 words</small>
                </div>
                <div class="mb-4">
                    <flux:label class="pb-2">University / School / Organization / Company (eg: SMK Bunga Raya)<b style="color:yellow;">*</b> </flux:label>
                    <flux:input type="text"  name="organisation" value="{{ $project->organisation }}" required/>
                </div>
                <div class="mb-4">
                    <flux:label class="pb-2">Project Leader (eg: MUHAMMAD BIN ALI)<b style="color:yellow;">*</b> </flux:label>
                    <flux:input type="text"  name="leader" value="{{ $project->leader }}" required/>
                </div>
                <div class="mb-4">
                    <flux:label class="pb-2">First Member (eg: ALIA BINTI ABU)<b style="color:yellow;">*</b> </flux:label>
                    <flux:input id="first" type="text"  name="member1" value="{{ $project->member1 }}" />
                </div>
                <div class="mb-4">
                    <flux:input id="second" type="text"  name="member2" value="{{ $project->member2 }}" label="Second Member"/>
                </div>
                <div class="mb-4">
                    <flux:input id="third" type="text"  name="member3" value="{{ $project->member3 }}" label="Third Member"/>
                </div>
                <div class="mb-4">
                    <flux:input id="fourth" type="text"  name="member4" value="{{ $project->member4 }}" label="Fourth Member"/>
                </div>
                <div class="mb-4" style="width: auto;">
                    <flux:label class="pb-2">Project Category <b style="color:yellow;">*</b></flux:label>
                    <flux:select name="category_id" required>
                        <flux:select.option value="{{ $project->cat_id }}">{{$project->cat_name}}</flux:select.option>
                        @foreach($categories as $category){
                            <flux:select.option value="{{ $category->id }}">{{$category->name}}</flux:select.option>
                        }
                        @endforeach
                    </flux:select>
                </div>
                <div class="mb-4">
                    <flux:label class="pb-2">Mailing Address (Please give full address - including country, state, ZIP code)<b style="color:yellow;">*</b> </flux:label>
                    <flux:input type="text"  name="address" value="{{ $project->address}}" required/>
                </div>
                <div class="mb-4" style="color: black;">
                    <flux:label class="pb-2">Contact Number (Must include country code!)<b style="color:yellow;">*</b> </flux:label>
                    <flux:input type="tel" id="phone" name="phone" value="{{ $project->phone}}" required/>
                </div>
                <div class="mb-4">
                    @if($project->publication == "Yes")
                    <flux:radio.group name="publication" label="Book of Chapters Publications">
                        <flux:radio value="Yes" label="Yes" checked/>
                        <flux:radio value="No" label="No"/>
                    </flux:radio.group>
                    @else
                    <flux:radio.group name="publication" label="Book of Chapters Publications">
                        <flux:radio value="Yes" label="Yes"/>
                        <flux:radio value="No" label="No" checked/>
                    </flux:radio.group>
                    @endif
                </div>
                <div class="mb-4">
                    @if($project->technical_paper)
                    <flux:button href="{{ asset('storage/'.$project->technical_paper) }}" download>Old Technical Paper</flux:button>
                    @endif
                    <flux:input type="file" name="technical_paper" label="New Technical Paper"/>
                <div class="mb-4">
                    <flux:input type="url"  name="link" value="{{ $project->link }}" label="Video Submission Link"/>
                </div>
                <flux:input type="email"  name="email" value="{{ $project->email }}" hidden/>
                <flux:input type='text' name='user_id' value='{{ auth()->user()->id }}' hidden/>
                <flux:input  type="text" name="id" value="{{ $project->ProID }}" hidden/>
                <flux:select name="event_id" hidden>
                    @foreach($events as $event){
                        <flux:select.option value="{{ $event->id }}">{{$event->name}}</flux:select.option>
                    }
                    @endforeach
                </flux:select>
                <flux:button.group>
                    <flux:button type="submit" variant="primary" class="w-full">Save Edit</flux:button>
                    <flux:button href="{{ route('dashboard') }}" class="w-full">Back</flux:button>
                </flux:button.group>
            </form>
        </div>
    </div>
</x-layouts.app>
@endif