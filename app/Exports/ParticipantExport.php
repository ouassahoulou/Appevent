<?php

namespace App\Exports;

use App\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
Use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;





class ParticipantExport implements FromCollection,WithHeadings, WithCustomStartCell
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
        return Participant::query()->select( 'nom' ,'prenom' ,'telephone','email','profession','CIN','naissance' )->where('id_evenement', $this->id)->get();
    }
    public function headings(): array
    {
        return [
            
            'nom' ,'prenom' ,'telephone','email','profession','CIN','naissance',
        ];
    }
    public function startCell(): string
    {
        return 'F5';
    }
    
    
}

