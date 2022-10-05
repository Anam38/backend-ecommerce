<?php

namespace App\Http\Controllers\Api;

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

  public function registration(Request $request)
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
}
