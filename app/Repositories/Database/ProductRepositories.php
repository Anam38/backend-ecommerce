<?php

namespace App\Repositories\Database;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Network\Builder\ProductsBuilder;

class ProductRepositories
{

    protected $table = 'products';
    protected $categoryPorduct_table_master = 'product_categories_master';
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

    public function findByCategory($code)
    {
      try {

        $response = DB::table($this->table)
              ->where('category_code_master',$code)
              ->get();

        return $response;

      } catch (\Exception $e) {

        return $e;
      }

    }
    public function findByCategoryChild($code)
    {
      try {

        $response = DB::table($this->table)
              ->where('category_code_child',$code)
              ->get();

        return $response;

      } catch (\Exception $e) {

        return $e;
      }

    }

    public function getPopular($take = false)
    {
      try {
        $response = DB::table($this->table)
              ->where('is_popular', '1')
              ->orderBy('id' , 'desc')
              ->get();

        if($take){
          $response = $response->take($take);
        }

        return $response;

      } catch (\Exception $e) {
        return $e;
      }
    }

    public function getNew($take = false)
    {
      try {
        $response = DB::table($this->table)
              ->where('is_new', '1')
              ->orderBy('id' , 'desc')
              ->get();

        if($take){
          $response = $response->take($take);
        }

        return $response;

      } catch (\Exception $e) {
        return $e;
      }
    }

    public function joinCategoryTable()
    {
      try {
        $response = DB::table($this->table)
                ->join($this->categoryPorduct_table_master, $this->table.'.category_code_master', '=', $this->categoryPorduct_table_master.'.code')
                ->join($this->categoryPorduct_table_child, $this->table.'.category_code_child', '=', $this->categoryPorduct_table_child.'.code')
                ->select($this->table.'.*', $this->categoryPorduct_table_master.'.name AS category_master_name', $this->categoryPorduct_table_child.'.name AS category_child_name')
                ->get();

        return $response;

      } catch (\Exception $e) {
        return $e;
      }
    }

    public function randomeByCategories($categories, $limit = 4)
    {
      try {
        $response = DB::table($this->table)
                ->where('category_code_child', $categories)
                ->inRandomOrder()
                ->limit($limit)
                ->get();

        return $response;

      } catch (\Exception $e) {
          return $e;
      }
    }

    // start CRUD function
    public function store(ProductsBuilder $product)
    {
      try {
          $response = DB::table($this->table)->insert([
            'name' => $product->getName(),
            'category_code_master' => $product->getCategoryCodeMaster(),
            'category_code_child' => $product->getCategoryCodeChild(),
            'img'  => $product->getImg(),
            'weight'  => $product->getWeight(),
            'stock'  => $product->getStock(),
            'size'  => $product->getSize(),
            'variant'  => $product->getVariant(),
            'price'  => $product->getPrice(),
            'is_popular'  => $product->getPopular(),
            'is_new'  => $product->getNew(),
            'discount'  => $product->getDiscount(),
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
                'category_code_master' => $product->getCategoryCodeMaster(),
                'category_code_child' => $product->getCategoryCodeChild(),
                'img'  => $product->getImg(),
                'weight'  => $product->getWeight(),
                'stock'  => $product->getStock(),
                'size'  => $product->getSize(),
                'variant'  => $product->getVariant(),
                'price'  => $product->getPrice(),
                'is_popular'  => $product->getPopular(),
                'is_new'  => $product->getNew(),
                'discount'  => $product->getDiscount(),
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
