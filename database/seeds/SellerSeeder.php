<?php

use Illuminate\Database\Seeder;
use App\Models\Seller;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Seller::updateOrCreate([
            'name' => 'admin',
            'phone' => '012',
            'image' => 'default-seller.jpg',
            'email' => 'seller@seller.com',
            'status' => 'accepted',
            'active' => '1',
            'password' => '123456',
        ]);
    }
}
