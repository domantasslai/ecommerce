<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        // Laptops
        for ($i = 1; $i <= 20; $i++) {
            Product::create([
                'name' => 'Car diagnostics ' . $i,
                'slug' => 'car-diagnostics-' . $i,
                'details' => 'Two channel differential Oscilloscope and Multimeter, Record Analyzer, Multi-Diag Scope is a part of a modular system Multi-Diag',
                'price' => rand(50000, 150000),
                'description' => 'OBD-II Connection Cable for ACTIA Basic+ XS Interface',
                'image' => 'products/September2020/car-diagnostics.png'
            ])->categories()->attach(1);
        }

        // Make laptop have a category of "Desktop" as well.
        $product = Product::find(1);
        $product->categories()->attach(2);

        // Desktops
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Diagnostics Accessories ' . $i,
                'slug' => 'diagnostics-accessories-' . $i,
                'details' => 'CABLE KIT FOR MULTIDIAG VCI 2G',
                'price' => rand(1000, 50000),
                'description' => 'Cable Kit includes: MultiDiag adapter cable for FIAT, MultiDiag adapter cable for VAG, MultiDiag adapter cable for RENAULT, MultiDiag adapter cable for OPEL, MultiDiag adapter cable for SKODA FAVORIT - SEAT CORDOBA, MultiDiag adapter cable for PSA, MultiDiag adapter cable for BMW, MultiDiag adapter cable for FORD, Universal diagnostic adapter for diagnostic cables, MultiDiag adapter cable for MERCEDES 1 (38 pin), MultiDiag adapter cable for MERCEDES 2 (14 pin), ACTIA reference number AC911898',
                'image' => 'products/September2020/diagnostics-accessories.png'
            ])->categories()->attach(2);
        }

        // Phones
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Locksmith Tools ' . $i,
                'slug' => 'locksmith-tools-' . $i,
                'details' => '1 KEY FOR MAN OR MERCEDES TRUCK + 1 TRANSPONDER CHIP ID13',
                'price' => rand(800, 25000),
                'description' => 'Pack includes 1 key + 1 transponder chip ID 13',
                'image' => 'products/September2020/locksmith-tools.png'
            ])->categories()->attach(3);
        }

        // Tablets
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Passthru ' . $i,
                'slug' => 'passthru-' . $i,
                'details' => 'ACTIA PASSTHRU+ XS 2G FULL',
                'price' => rand(100000, 150000),
                'description' => "PassThru+ XS 2G FULL SET (AR10005824)is a universal VCI (Vehicle Communication Interface) enabling you to communicate with the ECU's according to the J2534 & J2534-1 specifications. Compatible with MULTIDIAG ACCESS 2 (AC965831)",
                'image' => 'products/September2020/Passthru.png'
            ])->categories()->attach(4);
        }

        // TVs
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Truck Diagnostics ' . $i,
                'slug' => 'truck-diagnostics-' . $i,
                'details' => 'TRUCK EXPLORER STANDARD 2020',
                'price' => rand(300000, 500000),
                'description' => 'Truck Explorer Standard kit consists of most popular functions for trucks. You could work by OBD or by direct connection to the ECU on the table over DirectConnect 2U tool.',
                'image' => 'products/September2020/stackoverflow.png'
            ])->categories()->attach(5);
        }

        // Cameras
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Truck Explorer ' . $i,
                'slug' => 'truck-explorer-' . $i,
                'details' => 'TRUCK EXPLORER CHIPALLINO PACK',
                'price' => rand(500000, 800000),
                'description' => 'Truck Explorer Chipallino for MB trucks chiptuning. Software version V6.',
                'image' => 'products/September2020/Truck_Explorer.jpg'
            ])->categories()->attach(6);
        }

        // Appliances
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Motorcycle Diagnostics ' . $i,
                'slug' => 'motorcycle-diagnostics-' . $i,
                'details' => 'BMW MOTORCYCLE DIAGNOSTICS',
                'price' => rand(50000, 100000),
                'description' => 'Includes functions to perform diagnostics of all embeded control units through the diagnostic connector on the motorcycle.',
                'image' => 'products/September2020/Motorcycle_Diagnostics.jpg'
            ])->categories()->attach(7);
        }

        // Select random entries to be featured
        Product::whereIn('id', [1, 12, 22, 31, 41, 43, 47, 51, 53, 61, 69, 73, 80])->update(['featured' => true]);
    }
}
