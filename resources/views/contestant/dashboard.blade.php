<x-layouts.app :title="__('Dashboard')">
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
        .swiper {
            width: 90%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            padding: 2rem 3rem;
            border-radius: 20px;
            text-align: center;
            width: 90%;
            max-width: 500px;
        }

        .glass h2 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .timer {
            display: flex;
            justify-content: center;
            gap: 1.2rem;
        }

        .unit {
            text-align: center;
        }

        .number {
            font-size: 2.2rem;
            font-weight: bold;
            color: #00f5ff;
        }

        .label {
            font-size: 0.85rem;
            color: #ccc;
        }
    </style>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <video autoplay muted loop playsinline class="w-full h-auto rounded-xl">
                <source src="\images\Banner.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="grid auto-rows-min gap-4 md:grid-cols-2">
            <div class="py-10 px-12 justify-items-middle relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="tips-box" style="text-align: center">
                    <p style="font-size: 20px; font-weight: bold;">{{ $draft }}</p>
                    <h3>Number of Drafts</h3>
                </div>
                <div class="tips-box mt-11" style="text-align: center;">
                    <p style="font-size: 20px; font-weight: bold;">{{ $submitted }}</p>
                    <h3>Number of Submissions</h3>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach ($events as $event)
                        <div class="swiper-slide">
                            <div class="glass">
                            <h2>Registration ends in</h2>
                            <div class="timer" id="countdown-{{ $event->id }}"
                                data-date="{{ \Carbon\Carbon::parse($event->date_register_end)->format('Y-m-d\TH:i:s') }}">
                                Loading...
                            </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="glass">
                            <h2>Submission ends in</h2>
                            <div class="timer" id="countdown-{{ $event->id }}"
                                data-date="{{ \Carbon\Carbon::parse($event->date_submission)->format('Y-m-d\TH:i:s') }}">
                                Loading...
                            </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="glass">
                            <h2>Online evaluation ends in</h2>
                            <div class="timer" id="countdown-{{ $event->id }}"
                                data-date="{{ \Carbon\Carbon::parse($event->date_evaluate_end)->format('Y-m-d\TH:i:s') }}">
                                Loading...
                            </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="glass">
                            <h2>Top 10 Announcement</h2>
                            <div class="timer" id="countdown-{{ $event->id }}"
                                data-date="{{ \Carbon\Carbon::parse($event->date_announcement)->format('Y-m-d\TH:i:s') }}">
                                Loading...
                            </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="glass">
                            <h2>Physical Exhibition</h2>
                            <div class="timer" id="countdown-{{ $event->id }}"
                                data-date="{{ \Carbon\Carbon::parse($event->date_ceremony)->format('Y-m-d\TH:i:s') }}">
                                Loading...
                            </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
                <div class="tips-box">
                <h3>{{ auth()->user()->name }}'s Projects</h3>
                    <table class="table-auto border-collapse w-full">
                        <thead>
                            <tr>
                                <th class="border border-white px-auto py-2 font-bold">Project ID</th>
                                <th class="border border-white px-auto py-2 font-bold">Project Title</th>
                                <th class="border border-white px-auto py-2 font-bold">Fee</th>
                                <th class="border border-white px-auto py-2 font-bold">Status</th>
                                <th class="border border-white px-auto py-2 font-bold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($projects->isEmpty())
                                <tr>
                                    <td class="border border-white text-center p-2" colspan="5"><i>Register your first project
                                        <a href="{{ route('project.show') }}" class="underline" style="color: yellow;">here!</a></i>
                                    </td>
                                </tr>
                            @else
                                @foreach($projects as $project)
                                    <tr>
                                        <td class="text-center border border-white p-2">
                                            @if($project->receipt == "NOT PAID")
                                                <i>No ID</i> 
                                            @else
                                                {{ $project->ProID }}
                                            @endif
                                        </td>
                                        <td class="text-center border border-white p-2">{{ $project->title }}</td>
                                        <td class="text-center border border-white p-2">
                                            @if($project->currency == "MYR" && $project->publication == "Yes")
                                                {{ $project->currency }} <span> {{ $project->fee + 50.00 }}
                                            @elseif($project->currency == "MYR" && $project->publication == "No")
                                                {{ $project->currency }} <span> {{ $project->fee }}
                                            @elseif($project->currency== "USD" && $project->publication == "Yes")
                                                {{ $project->currency }} <span> {{ $project->fee + 11.80 }}
                                            @elseif($project->currency == "USD" && $project->publication == "No")
                                                {{ $project->currency }} {{ $project->fee }}
                                            @endif
                                        </td>
                                        <td class="text-center border border-white p-2">
                                            @if($project->status == "DRAFT")
                                                <flux:badge size="lg" icon="folder" variant="solid" color="yellow">{{ $project->status }}</flux:badge>
                                            @elseif($project->status == "SUBMITTED")
                                                <flux:badge size="lg" icon="folder" variant="solid" color="green">{{ $project->status }}</flux:badge>
                                            @elseif($project->status == "COMPLETED")
                                                <flux:badge size="lg" icon="folder" variant="solid" color="blue">{{ $project->status }}</flux:badge>
                                            @endif
                                        </td>
                                        <td class="justify-items-center border border-white">
                                            @foreach($events as $event)
                                                @if(Carbon\Carbon::now()->lessThan(Carbon\Carbon::createFromFormat('Y-m-d', $event->date_ceremony)))
                                                @if($project->receipt != "NOT PAID" && $project->status == "DRAFT" || $project->status == "SUBMITTED")
                                                <flux:button.group>
                                                    <flux:button href="{{ route('edit.show', [$project->ProID]) }}" variant="primary" size="sm" class="w-full">
                                                        Edit 
                                                    </flux:button>
                                                    <flux:button size="sm" href="{{ route('repository.show') }}" class="w-full">Download Receipt & LOA</flux:button>
                                                </flux:button.group>
                                                @else
                                                <flux:button.group>
                                                    <flux:button href="{{ route('edit.show', [$project->ProID]) }}" variant="primary" size="sm" class="w-full">
                                                        Edit 
                                                    </flux:button>
                                                    <form method="POST" action="{{ route('project.delete') }}">
                                                        @csrf
                                                        @method('POST')
                                                        <flux:input type="text" name="id" value="{{ $project->ProID }}" hidden/>
                                                        <flux:button type="submit" variant="danger" size="sm" class="w-full">
                                                            Delete
                                                        </flux:button>
                                                    </form>
                                                    <form method="POST" action="{{ route('checkout.view') }}">
                                                        @csrf
                                                        @method("POST")
                                                        <flux:input name="id" value="{{ $project->ProID }}" hidden/>
                                                        <flux:button type="submit" icon="banknotes" size="sm" class="w-full">
                                                            Pay
                                                        </flux:button>
                                                    </form>
                                                </flux:button.group>
                                                @endif
                                            @else
                                                <flux:button size="sm" href="{{ route('repository.show') }}" class="w-full">Download Receipt & LOA</flux:button>
                                            @endif
                                            @if(Carbon\Carbon::now()->greaterThanOrEqualTo(Carbon\Carbon::createFromFormat('Y-m-d', $event->date_ceremony)))
                                                <flux:button size="sm" href="{{ route('repository.show') }}" class="w-full">Download Your Certificates</flux:button>
                                            @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <flux:button href="{{ route('information') }}" variant="primary" class="mt-4" icon="arrow-left">Project Indicators</flux:button>
            </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Swiper setup
            const swiper = new Swiper(".mySwiper", {
                spaceBetween: 30,
                centeredSlides: true,
                autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                },
                pagination: { el: ".swiper-pagination", clickable: true },
                navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
                },
            });

            // Countdown logic
            document.querySelectorAll("[id^='countdown-']").forEach(container => {
                const target = new Date(container.dataset.date).getTime();

                const update = () => {
                const now = new Date().getTime();
                const gap = target - now;

                if (gap < 0) {
                    container.innerHTML = "<div class='unit' style='color:yellow;'>Passed!</div>";
                    return;
                }

                const d = Math.floor(gap / (1000 * 60 * 60 * 24));
                const h = Math.floor((gap % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const m = Math.floor((gap % (1000 * 60 * 60)) / (1000 * 60));
                const s = Math.floor((gap % (1000 * 60)) / 1000);

                container.innerHTML = `
                    <div class="unit"><div class="number" style='color:yellow;'>${d}</div><div class="label">Days</div></div>
                    <div class="unit"><div class="number" style='color:yellow;'>${h}</div><div class="label">Hours</div></div>
                    <div class="unit"><div class="number" style='color:yellow;'>${m}</div><div class="label">Minutes</div></div>
                    <div class="unit"><div class="number" style='color:yellow;'>${s}</div><div class="label">Seconds</div></div>
                `;
                };

                update();
                setInterval(update, 1000);
            });
        });
    </script>
</x-layouts.app>
