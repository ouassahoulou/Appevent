<?php

namespace App\Http\Controllers;

use App\Depenses;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Illuminate\Support\Facades\Validator;
use Excel;
use App\Exports\DepensesExport;



    
    
    class ExcelController extends Controller
    {
     
    
          public function export(Request $request)
          {
              return Excel::download(new DepensesExport($request->id), 'Dépenses.xlsx');
          }
    
    }