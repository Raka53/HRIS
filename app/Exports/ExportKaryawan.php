<?php

namespace App\Exports;

use App\Models\hrd;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ExportKaryawan implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        return hrd::orderBy('name', 'asc')
            ->select('NIK', 'name', 'gender', 'department', 'jobtitle') // Menghapus 'status_id'
            ->get();
           
    }

    public function headings(): array
    {
        return [
            'NIK',
            'Name',
            'Gender',
            'Department',
            'Job Title',
            
        ];
    }
}
