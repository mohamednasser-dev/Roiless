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
            'name' => 'الاسم الاول',
            'slug' => 'first_name',
        ]);
        Fundinput::create([
            'name' => 'الاسم الاخير',
            'slug' => 'lastname',
        ]);
        Fundinput::create([
            'name' => 'البريد الإلكتروني',
            'slug' => 'email',
        ]);
        Fundinput::create([
            'name' => 'رقم الهاتف',
            'slug' => 'phone',
        ]);

        Fundinput::create([
            'name' => 'العنوان',
            'slug' => 'address',
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
            'name' => 'رقم هاتف الشركة',
            'slug' => 'company_phone',
        ]);
        Fundinput::create([
            'name' => 'عنوان الشركة',
            'slug' => 'company_address',
        ]);
        Fundinput::create([
            'name' => 'مدينة الشركة',
            'slug' => 'company_city',
        ]);
        Fundinput::create([
            'name' => 'دولة الشركة',
            'slug' => 'company_country',
        ]);
        Fundinput::create([
            'name' => 'مجال الشركة',
            'slug' => 'company_field',
        ]);
        Fundinput::create([
            'name' => 'نوع الشركة',
            'slug' => 'company_type',
        ]);
        Fundinput::create([
            'name' => 'الدخل السنوي',
            'slug' => 'annual_sales',
        ]);
    }
}
