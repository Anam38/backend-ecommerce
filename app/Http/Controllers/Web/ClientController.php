<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Repositories\Database\ClientRepositories;
use App\Network\Builder\ClientsBuilder;

use Carbon\Carbon;

class ClientController extends Controller
{
  protected $clientRepositories;

  public function __construct()
  {
    $this->clientRepositories = new ClientRepositories;
  }

  public function load(Request $request)
  {
    $response = collect($this->clientRepositories->get())->all();

    return response()->json(resp(true, 200, "get client success", $response));
  }

  public function store(Request $request)
  {
      $request->validate([
          'username' => 'required',
          'email' => 'required|email',
          'password' => 'required',
          'phone_number' => 'required',
          'birth' => 'required',
          'gender' => 'required',
      ]);

      $birth = Carbon::parse($request->birth)->toDateString();
      $birth = Carbon::createFromFormat('Y-m-d', $birth)->format('d-m-Y');

      $param = (new ClientsBuilder())
          ->setUsername($request->username)
          ->setEmail($request->email)
          ->setPassword(Hash::make($request->password))
          ->setPhone($request->phone_number)
          ->setBirth($birth)
          ->setGender($request->gender);

      $response = $this->clientRepositories->store($param);
      if (!$response) {
        return response()->json(resp(false, 200, "store failed", $response));
      }

      return response()->json(resp(true, 200, "store success", []));
  }


  public function find( $id )
  {
    $response = $this->clientRepositories->findById( $id );

    return response()->json(resp(true, 200, "find success", $response ));
  }

  public function update(Request $request)
  {
      $isaddress = (is_string($request->address) && $request->address) ? true : false;

      if (!$isaddress && $request->address) {
        Validator::make($request->address[array_key_last($request->address)],[
              'receiver_label' => 'required',
              'receiver' => 'required',
              'phone_number' => 'required',
              'city' => 'required',
              'pos_code' => 'required',
              'address' => 'required',
          ])->validate();
      }

      $request->validate([
          'username' => 'required',
          'email' => 'required|email',
          'phone_number' => 'required',
          'date_of_birth' => 'required',
          'gender' => 'required',
      ]);

      $birth = Carbon::parse($request->date_of_birth)->toDateString();
      $birth = Carbon::createFromFormat('Y-m-d', $birth)->format('d-m-Y');
      $address = $request->address;
      $password = $request->new_password;

      if (!$isaddress && $request->address){
        $address = json_encode($request->address);
      }

      if ($password) {
        $password = Hash::make($password);
      }else {
        $password = $request->password;
      }

      $param = (new ClientsBuilder())
          ->setId($request->id)
          ->setUsername($request->username)
          ->setEmail($request->email)
          ->setPassword($password)
          ->setPhone($request->phone_number)
          ->setBirth($birth)
          ->setGender($request->gender)
          ->setAddress($address);

      $response = $this->clientRepositories->update($param);

      if (!$response) {
        return response()->json(resp(false, 200, "update failed", $response));
      }

      return response()->json(resp(true, 200, "update success", []));
  }

  public function destroy( $id )
  {
    $response = $this->clientRepositories->destroy( $id );

    if ($response < 1) {
      return response()->json(resp(false, 200, "destroy failed", [] ));
    }

    return response()->json(resp(true, 200, "destroy success", [] ));
  }
}
