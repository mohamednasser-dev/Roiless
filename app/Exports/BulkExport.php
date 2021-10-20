<?php
namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class BulkExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
   
    public function map($bulk): array
    {
        return [
            $bulk->id,
            $bulk->name,
            $bulk->email,
            Date::dateTimeToExcel($bulk->created_at),
            Date::dateTimeToExcel($bulk->updated_at),
        ];
    }
    public function collection()
    {
        return User::select('id','name','phone','email','created_at')->get();
    }
    public function headings(): array
    {
        return [
            'Id',
            'name',
            'phone',
            'email',
            'date',
        ];
    }
    
}
