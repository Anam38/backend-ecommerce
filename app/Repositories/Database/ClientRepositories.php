<?php

namespace App\Repositories\Database;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Network\Builder\ClientsBuilder;

class ClientRepositories
{

    protected $client = 'clients';

    public function get()
    {
      try {

        $response = DB::table($this->client)->get();

        return $response;

      } catch (\Exception $e) {

        return $e;
      }

    }

    public function findById($id)
    {
      try {

        $response = DB::table($this->client)
              ->where('id',$id)
              ->get();

        return $response;

      } catch (\Exception $e) {

        return $e;
      }

    }

    public function store(ClientsBuilder $client)
    {
      try {
          $response = DB::table($this->client)->insert([
            'username' => $client->getUsername(),
            'email' => $client->getEmail(),
            'password'  => $client->getPassword(),
            'phone_number'  => $client->getphone(),
            'gender'  => $client->getGender(),
            'date_of_birth'  => $client->getBirth(),
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
          ]);

        return $response;

      } catch (\Exception $e) {
          return $e;
      }
    }

    public function update(ClientsBuilder $client)
    {
      try {
          $response = DB::table($this->client)
              ->where('id', $client->getId())
              ->update([
                'username' => $client->getUsername(),
                'email' => $client->getEmail(),
                'password'  => $client->getPassword(),
                'phone_number'  => $client->getphone(),
                'gender'  => $client->getGender(),
                'date_of_birth'  => $client->getBirth(),
                'address'  => $client->getAddress(),
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
          $response = DB::table($this->client)
              ->where('id', $id)
              ->delete();

        return $response;

      } catch (\Exception $e) {
          return $e;
      }
    }

}
