<?php

namespace App\Exports;
use App\Models\gaji;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ExportGaji implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Gaji::with('hrd')->select('hrd.name', 'harga_sewa', 'salary', 'total_medical_claim', 'transport')
        ->join('hrd', 'gaji.hrd_id', '=', 'hrd.id') // Assuming the relationship is established via 'hrd_id' foreign key
        ->get();
       
    }
    public function headings(): array
    {
        return [
            'Nama',
            'Harga Sewa',
            'salary',
            'Total Medical Claim',
            'Transport',
            
        ];
    }
}
