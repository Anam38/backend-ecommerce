<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Repositories\Database\UserRepositories;
use App\Network\Builder\UsersBuilder;

use App\Models\User;
use DataTables;

class UserController extends Controller
{

    protected $userRepositories;

    public function __construct()
    {
      $this->userRepositories = new UserRepositories;
    }

    public function load(Request $request)
    {
      $response = collect($this->userRepositories->get())->all();

      return response()->json(resp(true, 200, "get user success", $response));
      // return datatables($response)
                // ->addColumn('action', function($item){
                //   $button = '<a href="/" class="btn btn-sm btn-warning btn-icon-text" title="edit data">
                //     <i class="ti-pencil-alt"></i>
                //   </a>
                //   <button @click="openModal(1)" class="btn btn-sm btn-danger btn-icon-text" title="delete data">
                //     <i class="ti-trash"></i>
                //   </button>';
                //
                //   return $button;
                // })
                // ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $param = (new UsersBuilder())
            ->setName($request->name)
            ->setEmail($request->email)
            ->setPassword(Hash::make($request->password));

        $response = $this->userRepositories->store($param);
        // if ($response) {
        //   // code...
        // }

        return response()->json(resp(true, 200, "store success", []));
    }

    public function find( $id )
    {
      $response = $this->userRepositories->findById( $id );

      return response()->json(resp(true, 200, "find success", $response ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if ($request->old_password || $request->new_password) {
          $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
          ]);

          $find = $this->userRepositories->findById( $request->id );
          $user = collect($find)->first();
          $passwordValidate = Hash::check($request->old_password, $user->password);

          if (!$passwordValidate) {

            return response()->json(resp(false, 200, "wrong old password", []));

          }
        }


        $param = (new UsersBuilder())
            ->setId($request->id)
            ->setName($request->name)
            ->setEmail($request->email)
            ->setPassword(Hash::make($request->new_password));

        $response = $this->userRepositories->update($param);
        // if ($response) {
        //   // code...
        // }

        return response()->json(resp(true, 200, "update success", []));
    }

    public function destroy( $id )
    {
      $response = $this->userRepositories->destroy( $id );

      if ($response < 1) {
        return response()->json(resp(false, 200, "destroy failed", [] ));
      }

      return response()->json(resp(true, 200, "destroy success", [] ));
    }
}
