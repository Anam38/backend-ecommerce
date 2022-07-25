<?php

namespace App\Repositories\Database;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Network\Builder\ProductsBuilder;

class ProductRepositories
{

    protected $table = 'products';
    protected $categoryPorduct_table = 'product_categories';

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

    public function findByCategory($code)
    {
      try {

        $response = DB::table($this->table)
              ->where('category_code',$code)
              ->get();

        return $response;

      } catch (\Exception $e) {

        return $e;
      }

    }

    public function joinCategoryTable()
    {
      try {
        $response = DB::table($this->table)
                ->join($this->categoryPorduct_table, $this->table.'.category_code', '=', $this->categoryPorduct_table.'.code')
                ->select($this->table.'.*', $this->categoryPorduct_table.'.name AS category_name')
                ->get();

        return $response;

      } catch (\Exception $e) {
        return $e;
      }
    }

    public function store(ProductsBuilder $product)
    {
      try {
          $response = DB::table($this->table)->insert([
            'name' => $product->getName(),
            'category_code' => $product->getCategoryCode(),
            'img'  => $product->getImg(),
            'weight'  => $product->getWeight(),
            'stock'  => $product->getStock(),
            'size'  => $product->getSize(),
            'variant'  => $product->getVariant(),
            'price'  => $product->getPrice(),
            'description'  => $product->getDescription(),
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
          ]);

        return $response;

      } catch (\Exception $e) {
          return $e;
      }
    }

    public function update(ProductsBuilder $product)
    {
      try {
          $response = DB::table($this->table)
              ->where('id', $product->getId())
              ->update([
                'name' => $product->getName(),
                'category_code' => $product->getCategoryCode(),
                'img'  => $product->getImg(),
                'weight'  => $product->getWeight(),
                'stock'  => $product->getStock(),
                'size'  => $product->getSize(),
                'variant'  => $product->getVariant(),
                'price'  => $product->getPrice(),
                'description'  => $product->getDescription(),
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
