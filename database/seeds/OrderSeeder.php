<?php

use Illuminate\Database\Seeder;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seller = Seller::where('active', '1')->where('status', 'accepted')->first();
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
