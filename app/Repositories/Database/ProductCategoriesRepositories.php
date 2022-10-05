<?php

namespace App\Repositories\Database;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Network\Builder\ProductCategoriesBuilder;

class ProductCategoriesRepositories
{

    protected $table = 'product_categories_master';
    protected $categoryPorduct_table_child = 'product_categories_child';

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

    public function joinCategoryChildTable()
    {
      try {
        $response = DB::table($this->table)
                ->join($this->categoryPorduct_table_child, $this->table.'.code', '=', $this->categoryPorduct_table_child.'.category_master_code')
                ->select($this->table.'.*', $this->categoryPorduct_table_child.'.code AS category_child_code', $this->categoryPorduct_table_child.'.name AS category_child_name')
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
              ->where('code',$code)
              ->get();

        return $response;

      } catch (\Exception $e) {

        return $e;
      }

    }

    public function store(ProductCategoriesBuilder $category)
    {
      try {
          $response = DB::table($this->table)->insert([
            'name' => $category->getName(),
            'code' => $category->getCode(),
            'img'  => $category->getImg(),
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
          ]);

        return $response;

      } catch (\Exception $e) {
          return $e;
      }
    }

    public function update(ProductCategoriesBuilder $category)
    {
      try {
          $response = DB::table($this->table)
              ->where('id', $category->getId())
              ->update([
                'name' => $category->getName(),
                'code' => $category->getCode(),
                'img'  => $category->getImg(),
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
