<?php
namespace App\Exports;
use App\Models\User_fund;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class user_fundExport implements FromCollection,WithHeadings
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
        return User_fund::select('id','user_status','created_at','user_id','fund_id')->with('Users')->with('Fund_details')->get()
        ->map(function($data) {
            $data->user_name = $data->Users->name ;
            $data->user_phone = $data->Users->phone ;
            $data->fund = $data->Fund_details->name_ar ;
            return $data;
        })->makeHidden(['user_id','fund_id']);
    }
    public function headings(): array
    {
        return [
            'Id',
            'status',
            'date',
            'user_name',
            'phone',
            'fund_name',
        ];
    }
}
