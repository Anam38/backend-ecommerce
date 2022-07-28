<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Database\ProductCategoriesChildRepositories;
use App\Network\Builder\ProductCategoriesChildBuilder;

class ProductCategoriesChildController extends Controller
{
  protected $categoriesRepositories;

  public function __construct()
  {
    $this->categoriesRepositories = new ProductCategoriesChildRepositories;
  }

  public function load(Request $request)
  {
    $response = collect($this->categoriesRepositories->get())->all();

    return response()->json(resp(true, 200, "get user success", $response));
  }

  public function store(Request $request)
  {
      $request->validate([
          'name' => 'required',
          'code' => 'required',
          'category_master_code' => 'required',
      ]);

      $param = (new ProductCategoriesChildBuilder())
          ->setName($request->name)
          ->setCode($request->code)
          ->setCategoryMasterCode($request->category_master_code);

      $codeCheck = $this->categoriesRepositories->findByCode($request->code);

      if ($codeCheck->first()) {
        return response()->json(resp(false, 200, "Promotion code already exist", []));
      }

      $response = $this->categoriesRepositories->store($param);
      if (!$response) {
        return response()->json(resp(false, 200, "store failed", $response));
      }

      return response()->json(resp(true, 200, "store success", []));
  }

  public function findByCode($code)
  {
    $response = $this->categoriesRepositories->findByCode($code);
    return response()->json(resp(true, 200, "get success", $response->all()));
  }

  public function update(Request $request)
  {
      $request->validate([
          'name' => 'required',
          'code' => 'required',
          'category_master_code' => 'required',
      ]);

      $param = (new ProductCategoriesChildBuilder())
          ->setId($request->id)
          ->setName($request->name)
          ->setCode($request->code)
          ->setCategoryMasterCode($request->category_master_code);

      $codeCheck = $this->categoriesRepositories->findByCode($request->code);

      $check = isset($codeCheck->first()->id) ? $codeCheck->first()->id : $request->id;

      if ($check != $request->id) {
        return response()->json(resp(false, 200, "Promotion code already exist", []));
      }

      $response = $this->categoriesRepositories->update($param);
      if (!$response) {
        return response()->json(resp(false, 200, "store failed", $response));
      }

      return response()->json(resp(true, 200, "store success", []));
  }

  public function destroy( Request $request, $id )
  {
    $response = $this->categoriesRepositories->destroy( $id );

    if ($response < 1) {
      return response()->json(resp(false, 200, "destroy failed", [] ));
    }

    return response()->json(resp(true, 200, "destroy success", [] ));
  }
}
