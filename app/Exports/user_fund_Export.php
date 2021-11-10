<?php
namespace App\Exports;
use App\Models\User_fund;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class user_fund_Export implements FromCollection,WithHeadings
{
    protected $month;
    protected $year;
    protected $group1;
    protected $category;

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
     function __construct($month = null,$annual = null,$group1 = null,$category =null)
    {
      
        $this->month=$month;
        $this->year=$annual;
        $this->group1=$group1;
        $this->category=$category;

    }
    public function collection()
    {
        if($this->group1 ==1)
        {
            return User_fund::select('id','user_status','created_at','user_id','fund_id')->with('Users')->with('Fund_details')->get()
            ->map(function($data) {
                $data->user_name = $data->Users->name ;
                $data->user_phone = $data->Users->phone ;
                $data->fund = $data->Fund_details->name_ar ;
                return $data;
            })->makeHidden(['user_id','fund_id']);
        }
        elseif( $this->group1 ==2 )
        {
            return User_fund::select('id','user_status','created_at','user_id','fund_id')->whereYear('created_at', '=', $this->year)
        ->whereMonth('created_at', '=',$this->month)->with('Users')->with('Fund_details')->get()
        ->map(function($data) {
            $data->user_name = $data->Users->name ;
            $data->user_phone = $data->Users->phone ;
            $data->fund = $data->Fund_details->name_ar ;
            return $data;
        })->makeHidden(['user_id','fund_id']);
        }elseif($this->group1 ==3)
        {
            return User_fund::select('id','user_status','created_at','user_id','fund_id')->whereYear('created_at', '=', $this->year)
            ->with('Users')->with('Fund_details')->get()
            ->map(function($data) {
                $data->user_name = $data->Users->name ;
                $data->user_phone = $data->Users->phone ;
                $data->fund = $data->Fund_details->name_ar ;
                return $data;
            })->makeHidden(['user_id','fund_id']);
        }else{
            return User_fund::select('id','user_status','created_at','user_id','fund_id')->where('fund_id', '=', $this->category)
            ->with('Users')->with('Fund_details')->get()
            ->map(function($data) {
                $data->user_name = $data->Users->name ;
                $data->user_phone = $data->Users->phone ;
                $data->fund = $data->Fund_details->name_ar ;
                return $data;
            })->makeHidden(['user_id','fund_id']);
        }
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
