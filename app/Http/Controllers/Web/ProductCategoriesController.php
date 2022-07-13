<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Database\ProductCategoriesRepositories;
use App\Network\Builder\ProductCategoriesBuilder;

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

    return response()->json(resp(true, 200, "get user success", $response));
  }

  public function store(Request $request)
  {
      $request->validate([
          'name' => 'required',
          'code' => 'required',
      ]);

      $img = null;

      if ($request->img) {
        $request->validate([
            'img' => 'required|image|mimes:png,jpg,jpeg,jpe,webp|max:2560',
        ]);

        $imgFile = $request->file('img');
        $name = $imgFile->getClientOriginalName();
        $extension = $imgFile->extension();
        $path = $imgFile->storeAs('public/images/product',time(). ".". $extension);
        $img = $path;
      }

      $param = (new ProductCategoriesBuilder())
          ->setName($request->name)
          ->setCode($request->code)
          ->setImg($img);

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

  public function update(Request $request)
  {
      $request->validate([
          'name' => 'required',
          'code' => 'required',
      ]);

      $new_img = $request->img;

      if ($request->new_img) {
        $request->validate([
            'new_img' => 'required|image|mimes:png,jpg,jpeg,jpe,webp|max:2560',
        ]);

        if(\Storage::exists($request->img)){
          \Storage::delete($request->img);
        }

        $imgFile = $request->file('new_img');
        $name = $imgFile->getClientOriginalName();
        $extension = $imgFile->extension();
        $path = $imgFile->storeAs('public/images/product',time(). ".". $extension);
        $new_img = $path;
      }

      $param = (new ProductCategoriesBuilder())
          ->setId($request->id)
          ->setName($request->name)
          ->setCode($request->code)
          ->setImg($new_img);

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
    if(\Storage::exists($request->img)){
      \Storage::delete($request->img);
    }

    $response = $this->categoriesRepositories->destroy( $id );

    if ($response < 1) {
      return response()->json(resp(false, 200, "destroy failed", [] ));
    }

    return response()->json(resp(true, 200, "destroy success", [] ));
  }
}
