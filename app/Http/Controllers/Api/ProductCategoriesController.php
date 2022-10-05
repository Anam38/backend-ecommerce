<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Database\ProductCategoriesRepositories;

class ProductCategoriesController extends Controller
{
  protected $categoriesRepositories;

  public function __construct()
  {
    $this->categoriesRepositories = new ProductCategoriesRepositories;
  }

  public function load(Request $request)
  {
    $response = collect($this->categoriesRepositories->get())->all();

    return response()->json(resp(true, 200, "get catrgory success", $response));
  }

  public function joinCategoryChildTable()
  {
    $response = $this->categoriesRepositories->joinCategoryChildTable()->all();

    return response()->json(resp(true, 200, "get catrgory success", $response));
  }
}
