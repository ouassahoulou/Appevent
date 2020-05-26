<?php

namespace App\Exports;

use App\Depenses;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
Use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class DepensesExport implements FromCollection,WithHeadings, WithCustomStartCell
{
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Depenses::query()->select( 'label' ,'date' ,'somme' )->where('id_evenement', $this->id)->get();
    }
    public function headings(): array
    {
        return [
            
            'label' ,'date' ,'somme' ,'justificatif',
        ];
    }
    public function startCell(): string
    {
        return 'F5';
    }
    
    
}
