<?php

namespace App\Repositories\Database;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Network\Builder\ProductCategoriesChildBuilder;

class ProductCategoriesChildRepositories
{

    protected $table = 'product_categories_child';

    public function get()
    {
      try {

        $response = DB::table($this->table)->get();

        return $response;

      } catch (\Exception $e) {

        return $e;
      }

    }

    public function findById($id)
    {
      try {

        $response = DB::table($this->table)
              ->where('id',$id)
              ->get();

        return $response;

      } catch (\Exception $e) {

        return $e;
      }

    }

    public function findByCode($code)
    {
      try {

        $response = DB::table($this->table)
              ->where('category_master_code',$code)
              ->get();

        return $response;

      } catch (\Exception $e) {

        return $e;
      }

    }

    public function store(ProductCategoriesChildBuilder $category)
    {
      try {
          $response = DB::table($this->table)->insert([
            'name' => $category->getName(),
            'category_master_code'  => $category->getCategoryMasterCode(),
            'code' => $category->getCode(),
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
          ]);

        return $response;

      } catch (\Exception $e) {
          return $e;
      }
    }

    public function update(ProductCategoriesChildBuilder $category)
    {
      try {
          $response = DB::table($this->table)
              ->where('id', $category->getId())
              ->update([
                'name' => $category->getName(),
                'category_master_code'  => $category->getCategoryMasterCode(),
                'code' => $category->getCode(),
                'updated_at'  => Carbon::now(),
              ]);

        return $response;

      } catch (\Exception $e) {
          return $e;
      }
    }

    public function destroy($id)
    {
      try {
          $response = DB::table($this->table)
              ->where('id', $id)
              ->delete();

        return $response;

      } catch (\Exception $e) {
          return $e;
      }
    }

}
