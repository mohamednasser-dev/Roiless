<?php

namespace App\Http\Controllers;
use App\Exports\BulkExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class ImportExportController extends Controller
{
    //

    public function export() 
    {
        return Excel::download(new BulkExport, 'bulkData.xlsx');
    }
    
}
