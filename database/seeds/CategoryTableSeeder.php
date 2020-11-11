<?php

use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        Category::truncate();
        Category::insert([
            ['name' => 'Car diagnostics', 'slug' => 'car-diagnostics', 'created_at' => $now, 'updated_at' => $now, 'image' => 'category\October2020\sxuxqVhOm5eKcXZD2WOD.png', 'text' => 'A car diagnostic test can determine if your vehicle has issues with its engine, exhaust, transmission, ignition coils, oil tank, throttle, and more.'],
            ['name' => 'Diagnostics Accessories', 'slug' => 'diagnostics-accessories', 'created_at' => $now, 'updated_at' => $now, 'image' => 'category\October2020\yHLCIQhsVnyRMw70zerc.png', 'text' => 'Automotive diagnostic accessories'],
            ['name' => 'Locksmith Tools', 'slug' => 'locksmith-tools', 'created_at' => $now, 'updated_at' => $now, 'image' => 'category\October2020\xcmPvcRcPD24zwgEQwRm.png', 'text' => ''],
            ['name' => 'Passthru', 'slug' => 'passthru', 'created_at' => $now, 'updated_at' => $now, 'image' => 'category\October2020\Mvqyf6iti12hFx2pvTxw.png', 'text' => ''],
            ['name' => 'Truck Diagnostics', 'slug' => 'truck-diagnostics', 'created_at' => $now, 'updated_at' => $now, 'image' => 'category\October2020\aOH9xLFYJviRWJ9VHGZP.png', 'text' => ''],
            ['name' => 'Truck Explorer', 'slug' => 'truck-explorer', 'created_at' => $now, 'updated_at' => $now, 'image' => 'category\October2020\KlAFxYD2XcUeDYoyApen.jpg', 'text' => ''],
            ['name' => 'Motorcycle Diagnostics', 'slug' => 'motorcycle-diagnostics', 'created_at' => $now, 'updated_at' => $now, 'image' => 'category\October2020\e6uaNywZ9rsjxlnnSUa4.jpg', 'text' => ''],
        ]);
    }
}
