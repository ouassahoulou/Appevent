<?php

namespace App\Http\Controllers;
use App\Partcipants;
use App\Depenses;
use Illuminate\Http\Request;
// use App\Exports\UsersExport;
use App\Exports\ParticipantExport;

use Illuminate\Support\Facades\Validator;
use Excel;
use App\Exports\DepensesExport;

class ExcelController extends Controller
    {
     
    
          public function exportdepenses(Request $request)
          {
              return Excel::download(new DepensesExport($request->id), 'Dépenses.xlsx');
          }
    
          public function exportparticipant(Request $request)
          {
              return Excel::download(new ParticipantExport($request->id), 'Partcicipants.xlsx');
          }
    }



    
    
    