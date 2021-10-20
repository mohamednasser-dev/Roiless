<?php
namespace App\Exports;
use App\Models\User_fund;
use Maatwebsite\Excel\Concerns\FromCollection;
class user_fundExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Id',
            'name',
            'email',
            'createdAt',
            'updatedAt',
        ];
    }
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
        return User_fund::select('id','user_status','created_at')->with('Users')->get();
    }
}
