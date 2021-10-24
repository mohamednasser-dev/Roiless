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
    protected $month;
    protected $year;
    protected $group1;
    function __construct($month = null,$annual = null,$group1 = null)
    {
      
        $this->month=$month;
        $this->year=$annual;
        $this->group1=$group1;
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
        if($this->group1 ==1)
        {
        return User::select('id','name','phone','email','created_at')->get();
        }
        elseif($this->group1 ==2)   
        {
            return User::select('id','name','phone','email','created_at')->whereYear('created_at', '=', $this->year)
            ->whereMonth('created_at', '=',$this->month)->get();
        }else{
            return User::select('id','name','phone','email','created_at')->whereYear('created_at', '=', $this->year)->get();
        }
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
