<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class ProductCategoryMaster extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('product_categories_master')->insert([
          [
            'code' => 'mans',
            'name' => 'Mans',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
          ],
          [
            'code' => 'womens',
            'name' => 'Womens',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
          ],
          [
            'code' => 'child',
            'name' => 'childrens',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
          ],
      ]);
    }
}
