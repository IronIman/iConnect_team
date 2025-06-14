<?php

namespace App\Imports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class AdminImport implements ToCollection
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Project::where('id','=',$row[0])->update([
                'award' => $row[3],
            ]);
        }
    }
}
