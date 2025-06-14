<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;
use App\Models\Event;


class UpdateProjectStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-project-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = Event::orderBy('date_ceremony', 'desc')->value('date_ceremony'); 

        if ($date && \Carbon\Carbon::parse($date)->lessThan(now())) {
            Project::where('status', '!=', 'COMPLETED')
                ->update(['status' => 'COMPLETED']);

            $this->info('Project statuses updated successfully!');
        }
    }
}
