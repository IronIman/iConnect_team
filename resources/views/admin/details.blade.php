<x-admin-layout :title="__('Contestant Project')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700" style="padding:12px;">
                <div class="mb-4">
                    <flux:input  type="text" name="title" value="{{ $project->title }}" label="Project Title" readonly/>
                </div>
                <div class="mb-4">
                    <flux:textarea type="text" rows="4"  name="abstract" id="abstract" label="Project Abstract (Not more than 500 words!)" readonly>{{ $project->abstract }}</flux:textarea>
                    <small id="wordCount" class="text-gray-500">0/500 words</small>
                </div>
                <div class="mb-4">
                    <flux:input type="text"  name="organisation" value="{{ $project->organisation }}" label="University/School/Organization/Company" readonly/>
                </div>
                <div class="mb-4">
                    <flux:input type="text"  name="leader" value="{{ $project->leader }}" label="Project Leader" readonly/>
                </div>
                <div class="mb-4">
                    <flux:input type="text"  name="member1" value="{{ $project->member1 }}" label="Fisrt Member" readonly/>
                </div>
                <div class="mb-4">
                    <flux:input type="text"  name="member2" value="{{ $project->member2 }}" label="Second Member" readonly/>
                </div>
                <div class="mb-4">
                    <flux:input type="text"  name="member3" value="{{ $project->member3 }}" label="Third Member" readonly/>
                </div>
                <div class="mb-4">
                    <flux:input type="text"  name="member4" value="{{ $project->member4 }}" label="Fourth Member" readonly/>
                </div>
                <div class="mb-4" style="width: auto;">
                    <flux:select name="category_id" label="Project Category" readonly>
                        <flux:select.option value="{{ $project->cat_id }}">{{$project->cat_name}} ({{ $project->cat_fee }})</flux:select.option>
                    </flux:select>
                </div>
                <div class="mb-4">
                    <flux:input type="text"  name="address" value="{{ $project->address}}" label="Mailing Address (Please give full address - including postcode, state)" readonly/>
                </div>
                <div class="mb-4">
                    <flux:input type="tel" name="phone" value="{{ $project->phone}}" label="Phone Number" readonly/>
                </div>
                <div class="mb-4">
                    <flux:input value="{{ $project->publication }}" label="Book of Chapters"/>
                </div>
                <div class="mb-4">
                    @if($project->publication == "Yes")
                    <flux:button variant="primary" href="{{ asset('storage/' . $project->technical_paper) }}" download="{{ $project->ProID }}.pdf">Download Technical Paper</flux:button>
                    @else
                    <flux:button href="{{ asset('storage/' . $project->technical_paper) }}" hidden>Download Technical Paper</flux:button>
                    @endif
                </div>
                <div class="mb-4">
                    <flux:input type="url"  name="link" value="{{ $project->link }}" label="Video Submission Link" readonly/>
                </div>
                <div class="mb-4">
                    <flux:input type="email"  name="email" value="{{ $project->email }}" label="Contact Email" readonly/>
                </div>
                <div class="mb-4">
                    <flux:input type='text' name='id' value='{{ $project->ProID}}' label="Project ID" readonly/>
                </div>
                <flux:button href="{{ route('dashboard') }}" type="submit" variant="primary" class="w-full">Back</flux:button>
        </div>
    </div>
</x-admin-layout>