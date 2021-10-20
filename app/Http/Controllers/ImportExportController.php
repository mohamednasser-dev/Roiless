<?php

namespace App\Http\Controllers;
use App\Exports\BulkExport;
use App\Exports\user_fundExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class ImportExportController extends Controller
{
    //

    public function export() 
    {
        return Excel::download(new BulkExport, 'bulkData.xlsx');
    }
    public function export_userfund()
    {
        return Excel::download(new user_fundExport, 'bulkData.xlsx');
    }
    
}
