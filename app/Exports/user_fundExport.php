<?php
namespace App\Exports;
use App\Models\Fund_user;
use Maatwebsite\Excel\Concerns\FromCollection;
class BulkExport implements FromCollection
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
        return Fund_user::select('name','phone','email','created_at')->get();
    }
}
