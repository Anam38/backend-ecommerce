<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Database\ProductRepositories;
use App\Repositories\Database\ProductCategoriesRepositories;

use App\Network\Builder\ProductsBuilder;

class ProductController extends Controller
{
  protected $productRepositories;
  protected $categoriesRepositories;

  public function __construct()
  {
    $this->productRepositories = new ProductRepositories;
    $this->categoriesRepositories = new ProductCategoriesRepositories;
  }

  public function load(Request $request)
  {
    $response = $this->productRepositories->joinCategoryTable();

    return response()->json(resp(true, 200, "get product success", $response));
  }

  public function new(Request $request)
  {
    $take = isset($request->take) ? $request->take : 0 ;

    $response = $this->productRepositories->getNew($take);

    return response()->json(resp(true, 200, "get new product success", $response));
  }

  public function popular(Request $request)
  {
    $take = isset($request->take) ? $request->take : 0 ;

    $response = $this->productRepositories->getPopular($take);

    return response()->json(resp(true, 200, "get popular product success", $response));
  }

  public function bycategories(Request $request)
  {
    if( isset($request->category) )
    {
      $response = $this->productRepositories->findByCategory($request->category);
    }elseif ( isset($request->category_child) ) {
      $response = $this->productRepositories->findByCategoryChild($request->category_child);
    }

    return response()->json(resp(true, 200, "get product by Categories found", $response));
  }

  public function randomeByCategories(Request $request)
  {
    $response = $this->productRepositories->randomeByCategories($request->category);

    return response()->json(resp(true, 200, "get relate product by ChildCategories found", $response));
  }

  public function find($id)
  {
    $response = $this->productRepositories->findById($id)->first();

    return response()->json(resp(true, 200, "get product success", $response));
  }
}
