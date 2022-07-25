<?php

namespace App\Http\Controllers\Web;

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

  public function store(Request $request)
  {
    $request->validate([
        'name' => 'required',
        'category' => 'required',
        'weight' => 'required',
        'stock' => 'required',
        'price' => 'required',
        'imgs.*' => 'required|image|mimes:png,jpg,jpeg,jpe,webp|max:2560',
    ]);

    $imgs = collect();

    if($request->hasfile('imgs')) {
        $imgFile = $request->file('imgs');
        foreach($imgFile as $file){
          $name = $file->getClientOriginalName();
          $extension = $file->extension();
          $path = $file->storeAs('public/images/product',time().rand(0, 1000).".". $extension);
          $imgs->push($path);
        }
    }else {
      return response()->json(resp(false, 200, "img Doesn't exist", []));
    }

    $param = (new ProductsBuilder())
          ->setName($request->name)
          ->setCategoryCode($request->category)
          ->setImg(json_encode($imgs))
          ->setWeight($request->weight)
          ->setStock($request->stock)
          ->setSize(json_encode($request->sizes))
          ->setVariant(json_encode($request->variants))
          ->setPrice($request->price)
          ->setDescription($request->description);

    $response = $this->productRepositories->store($param);
    if ($response != true) {
      return response()->json(resp(false, 200, "store failed", $response));
    }

    return response()->json(resp(true, 200, "store success", []));
  }

  public function find($id)
  {
    $response = $this->productRepositories->findById($id)->first();

    return response()->json(resp(true, 200, "get product success", $response));
  }

  public function update(Request $request)
  {
    $validator = \Validator::make($request->all(), [
        'name' => 'required',
        'category_code' => 'required',
        'weight' => 'required',
        'stock' => 'required',
        'price' => 'required',
    ]);

    $validator->sometimes(['old_img', 'new_img'], 'required', function ($input) {
        return !$input->old_img && !$input->new_img;
    })->validate();

    // remove file
    if ($request->delete_img) {
      foreach($request->delete_img as $file){
        if(\Storage::exists($file)){
          \Storage::delete($file);
        }
      }
    }

    $new_img = collect($request->old_img);

    if ($request->new_img) {
      if($request->hasfile('new_img')) {
          $imgFile = $request->file('new_img');
          foreach($imgFile as $file){
            $mimetype = explode('/',$file->getClientMimeType());
            $allowedMimeTypes = ['jpeg','png','webp','jpg','jpe'];

            if(! in_array($mimetype[1], $allowedMimeTypes) ){
              return response()->json(resp(false, 200, "please input image file", []));
            }elseif ($file->getSize() > '2560000') {
              return response()->json(resp(false, 200, "img ".$file->getClientOriginalName()." Size too large", []));
            }

            $name = $file->getClientOriginalName();
            $extension = $file->extension();
            $path = $file->storeAs('public/images/product',time().rand(0, 1000).".". $extension);
            $new_img->push($path);
          }
      }else {
        return response()->json(resp(false, 200, "img Doesn't exist", []));
      }
    }

    $param = (new ProductsBuilder())
          ->setId($request->id)
          ->setName($request->name)
          ->setCategoryCode($request->category_code)
          ->setImg(json_encode($new_img->toArray()))
          ->setWeight($request->weight)
          ->setStock($request->stock)
          ->setSize(json_encode($request->sizes))
          ->setVariant(json_encode($request->variants))
          ->setPrice($request->price)
          ->setDescription($request->description);

    $response = $this->productRepositories->update($param);
    if ($response != true) {
      return response()->json(resp(false, 200, "update failed", $response));
    }

    return response()->json(resp(true, 200, "update success", []));
  }

  public function destroy( Request $request, $id )
  {
    // remove file
    if ($request->img) {
      foreach(json_decode($request->img) as $file){
        if(\Storage::exists($file)){
          \Storage::delete($file);
        }
      }
    }

    $response = $this->productRepositories->destroy( $id );

    if ($response < 1) {
      return response()->json(resp(false, 200, "destroy failed", [] ));
    }

    return response()->json(resp(true, 200, "destroy success", [] ));
  }
}
