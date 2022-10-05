<?php

namespace App\Repositories\Database;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class OauthClientRepositories
{

    protected $table = 'oauth_clients';

    public function get()
    {
      try {

        $response = DB::table($this->table)->get();

        return $response;

      } catch (\Exception $e) {

        return $e;
      }

    }

    public function findByName($id)
    {
      try {

        $response = DB::table($this->table)
              ->where('name',$id)
              ->get();

        return $response;

      } catch (\Exception $e) {

        return $e;
      }

    }

}
