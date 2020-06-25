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
        $de = Depenses::query()->select( 'Input','label' ,'date' ,'somme','output' )->where('id_evenement', $this->id)->get();
        
        return $de;
    }
    public function headings(): array
    {
        return [
            
            'Input','label' ,'date' ,'somme' ,'Output',
        ];
    }
    public function startCell(): string
    {
        return 'F5';
    }
    
    
    
}
