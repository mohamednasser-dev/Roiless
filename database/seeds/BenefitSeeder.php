<?php

use Illuminate\Database\Seeder;
use App\Models\Benefit;
use App\Models\Section;
use App\Models\Seller;
use App\Models\Product;
use App\Models\ProductBenefit;
use App\Models\Order;
use App\Models\User;

class BenefitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $benefit_data = [
            [
                'id' => 6,
                'name_ar' => '6 شهور',
                'name_en' => '6 months',
                'months_count' => '6',
            ], [
                'id' => 12,
                'name_ar' => '12 شهر',
                'name_en' => '12 months',
                'months_count' => '12',
            ], [
                'id' => 18,
                'name_ar' => '18 شهر',
                'name_en' => '18 months',
                'months_count' => '18',
            ], [
                'id' => 24,
                'name_ar' => '24 شهر',
                'name_en' => '24 months',
                'months_count' => '24',
            ],
        ];
        foreach ($benefit_data as $get) {
            Benefit::updateOrCreate($get);
        }



        //sections
        $data = [
            [
                'title_ar' => 'الاجهزة الكهربية',
                'title_en' => 'electrical appliances',
            ],
            [
                'title_ar' => 'الاجهزة الالكترونية',
                'title_en' => 'electronic devices',
            ],
            [
                'title_ar' => 'موضة',
                'title_en' => 'fashion',
            ],
        ];
        foreach ($data as $get) {
            Section::updateOrCreate($get);
        }
        $sections = Section::where('parent_id', null)->get();
        foreach ($sections as $section) {
            $sub_data = [
                [
                    'title_ar' => 'القسم الفرعي الاول',
                    'title_en' => 'First subsection',
                    'parent_id' => $section->id,
                ],
                [
                    'title_ar' => 'القسم الفرعي الثاني',
                    'title_en' => 'Second subsection',
                    'parent_id' => $section->id,
                ],
            ];
            foreach ($sub_data as $row) {
                Section::updateOrCreate($row);
            }
        }


        Seller::updateOrCreate([
            'name' => 'admin',
            'phone' => '012',
            'image' => 'default-seller.jpg',
            'email' => 'seller@seller.com',
            'status' => 'accepted',
            'active' => '1',
            'password' => '123456',
        ]);


        //Product
        $seller = Seller::where('active','1')->where('status','accepted')->first();
        if($seller){
            $sections = Section::where('parent_id',null)->get();
            $benefits = Benefit::get();
            foreach ($sections as $row){
                if(count($row->Child) > 0){
                    $product = Product::create([
                        'name_ar' => 'منتج تجريبي',
                        'name_en' => 'test product',
                        'sub_section_id' => $row->id,
                        'section_id' => $row->Child->first()->id,
                        'body_ar' => 'منتج تجريبي منتج تجريبي منتج تجريبي',
                        'body_en' => 'test product test product test product ',
                        'seller_id' => $seller->id,
                        'price' => 1000,
                        'quantity' => 5,
                        'status' => 'accepted',
                        'type' => 'direct_installment',
                        'stars' => 1,
                    ]);
                    if($product){
                        foreach ($benefits as $benefit){
                            $benefit_data['product_id'] = $product->id;
                            $benefit_data['benefit_id'] = $benefit->id;
                            $benefit_data['ratio'] = $benefit->id;
                            ProductBenefit::updateOrCreate($benefit_data);
                        }
                    }
                }else{
                    Product::create([
                        'name_ar' => 'منتج تجريبي',
                        'name_en' => 'test product',
                        'sub_section_id' => $row->id,
                        'body_ar' => 'منتج تجريبي منتج تجريبي منتج تجريبي',
                        'body_en' => 'test product test product test product ',
                        'seller_id' => $seller->id,
                        'price' => 2500,
                        'quantity' => 9,
                        'status' => 'accepted',
                        'type' => 'not_direct_installment',
                        'stars' => 1,
                    ]);
                }

            }

            //order seeder
            $user = User::where('status', 'active')->first();
            if ($seller) {
                $products = Product::where('seller_id',$seller->id)->where('status', 'accepted')->get();
                if (count($products) > 0) {
                    foreach ($products as $product) {
                        $order_data['user_id'] = $user->id;
                        $order_data['product_id'] = $product->id;
                        $order_data['installment_type'] = $product->type;
                        $order_data['benefit'] = 7;
                        $order_data['monthly_amount'] = 200;
                        $order_data['price'] = 1000;
                        $order_data['total'] = 1200;
                        $order_data['status'] = 'accepted';
                        Order::create($order_data);
                    }
                }

            }
        }

    }
}
