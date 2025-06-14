<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class ProjectExport implements FromCollection, WithEvents, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $projects = DB::table('projects')
        ->join('categories', 'projects.category_id','=','categories.id')
        ->select('projects.id','projects.title',  
        'projects.leader','projects.organisation', 'projects.address','projects.phone','projects.member1',
        'projects.member2','projects.member3','projects.member4','projects.publication','categories.name','categories.fee',
        'projects.link', 'projects.status', 'projects.award')
        ->get();
        return $projects;
    }

    public function headings(): array
    {
        return ['ID', 'Title', 'Leader', 'Organisation', 'Address', 'Phone No', 'Member 1', 'Member 2', 'Member 3', 'Member 4', 'Publication', 'Category', 'Fee', 'Link',
             'Status', 'Award Received'];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Apply bold styling to headers
                $sheet->getStyle('A1:U1')->getFont()->setBold(true);
                
                // Set column width
                $sheet->getColumnDimension('A')->setWidth(20);
                $sheet->getColumnDimension('B')->setWidth(30);
                $sheet->getColumnDimension('C')->setWidth(30);
                $sheet->getColumnDimension('D')->setWidth(20);
                $sheet->getColumnDimension('E')->setWidth(20);
                $sheet->getColumnDimension('F')->setWidth(20);
                $sheet->getColumnDimension('G')->setWidth(20);
                $sheet->getColumnDimension('H')->setWidth(20);
                $sheet->getColumnDimension('I')->setWidth(20);
                $sheet->getColumnDimension('J')->setWidth(20);
                $sheet->getColumnDimension('K')->setWidth(20);
                $sheet->getColumnDimension('L')->setWidth(20);
                $sheet->getColumnDimension('M')->setWidth(20);
                $sheet->getColumnDimension('N')->setWidth(20);
                $sheet->getColumnDimension('O')->setWidth(20);
                $sheet->getColumnDimension('P')->setWidth(20);

                // Apply border to all cells
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
                $sheet->getStyle('A1:O100')->applyFromArray($styleArray);
            },
        ];
    }
}
