<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Section;
use App\Models\Benefit;
use App\Models\ProductBenefit;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

        }

    }
}
