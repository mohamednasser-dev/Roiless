<?php

use App\Models\Fundinput;
use App\Models\User;
use Illuminate\Database\Seeder;

class FundinputesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fundinput::create([
            'name' => 'الاسم الثلاتي',
            'slug' => 'full_name',
        ]);
        Fundinput::create([
            'name' => 'رقم الهاتف',
            'slug' => 'phone',
        ]);
        Fundinput::create([
            'name' => 'البريد الإلكتروني',
            'slug' => 'email',
        ]);
        Fundinput::create([
            'name' => 'العنوان',
            'slug' => 'address',
        ]);
        Fundinput::create([
            'name' => 'المدينة',
            'slug' => 'city',
        ]);
        Fundinput::create([
            'name' => 'الدولة',
            'slug' => 'country',
        ]);
        Fundinput::create([
            'name' => 'اسم الشركة',
            'slug' => 'company_name',
        ]);
        Fundinput::create([
            'name' => 'تليفون الشركة',
            'slug' => 'company_phone',
        ]);
        Fundinput::create([
            'name' => 'عنوان الشركة',
            'slug' => 'company_address',
        ]);
        Fundinput::create([
            'name' => 'مجال الشركة',
            'slug' => 'company_type',
        ]);
        Fundinput::create([
            'name' => 'الدخل السنوي',
            'slug' => 'annual_income',
        ]);
        Fundinput::create([
            'name' => 'مبلغ التمويل',
            'slug' => 'fund_amount',
        ]);
        Fundinput::create([
            'name' => 'نشاط الشركة',
            'slug' => 'Company_activity',
        ]);
        Fundinput::create([
            'name' => 'المبيعات السنوية',
            'slug' => 'annual_sales',
        ]);
        Fundinput::create([
            'name' => 'قيمة القرض المطلوب',
            'slug' => 'Required_fund_amount',
        ]);
        Fundinput::create([
            'name' => 'قيمة العقار المطلوب تمويله',
            'slug' => 'property_financed',
        ]);
        Fundinput::create([
            'name' => 'قيمة السيارة المطلوب تمويلها',
            'slug' => 'car_financed',
        ]);

    }
}
