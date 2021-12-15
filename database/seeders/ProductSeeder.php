<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\Product;
  
class ProductSeeder extends Seeder
{
    public function run()
    {           
        $products = [
            [
			    'kode' => 'FA4532',
                'nama' => 'Purple Reign FA',
                'image' => 'https://img.floweradvisor.com/p/6-purple-roses-spray-bouquet-with-medium-bear-fa4532-006',
                'harga' => 455000
            ],
            [
			    'kode' => 'FA3518',
                'nama' => 'Enchanting Belle',
                'image' => 'https://img.floweradvisor.com/p/hari-ibu-2021-a-bouquet-of-3-pink-roses-3-1-fa22174-002',
                'harga' => 366000
            ],
            [
			    'kode' => 'FA21708',
                'nama' => 'Grateful Festival',
                'image' => 'https://img.floweradvisor.com/p/inside-the-hamper-kis-mint-cherry-merah-fa21708-004',
                'harga' => 500000
            ],
            [
			    'kode' => 'FA21712',
                'nama' => 'Grateful Festival',
                'image' => 'https://img.floweradvisor.com/p/inside-the-hamper-fox-kaleng-lotus-fa21712-005',
                'harga' => 1500000
            ]
        ];
  
        foreach ($products as $key => $value) {
            Product::create($value);
        }
    }
}