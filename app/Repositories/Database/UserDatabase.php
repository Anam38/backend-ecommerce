<?php

namespace App\Repositories\Database;

use Illuminate\Support\Facades\DB;
use App\Models\User;

use Carbon\Carbon;

use App\Network\Builder\UsersBuilder;

class UserDatabase
{

    protected $users = 'users';

    public function get()
    {
      try {

        $response = DB::table($this->users)->get();

        return $response;

      } catch (\Exception $e) {

        return $e;
      }

    }

    public function findById($id)
    {
      try {

        $response = DB::table($this->users)
              ->where('id',$id)
              ->get();

        return $response;

      } catch (\Exception $e) {

        return $e;
      }

    }

    public function store(UsersBuilder $users)
    {
      try {
          $response = DB::table($this->users)->insert([
            'name' => $users->getName(),
            'email' => $users->getEmail(),
            'password'  => $users->getPassword(),
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
          ]);

        return $response;

      } catch (\Exception $e) {
          return $e;
      }
    }

    public function update(UsersBuilder $users)
    {
      try {
          $response = DB::table($this->users)
              ->where('id', $users->getId())
              ->update([
                'name' => $users->getName(),
                'email' => $users->getEmail(),
                'password'  => $users->getPassword(),
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
          $response = DB::table($this->users)
              ->where('id', $id)
              ->delete();

        return $response;

      } catch (\Exception $e) {
          return $e;
      }
    }

}
