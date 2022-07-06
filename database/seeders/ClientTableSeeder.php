<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dummy_address = array( 'receiver_label' => 'Home', 'receiver' => 'Xample', 'phone_number' => '123456789', 'city' => 'xample', 'address' => 'jl.xample no 00');

        DB::table('clients')->insert([
            'username' => 'xample',
            'email' => 'xample@gmail.com',
            'password' => Hash::make('xample'),
            'gender' => 'm',
            'phone_number' => '123456789',
            'date_of_birth' => '19-09-1990',
            'address' => json_encode(array($dummy_address)),
        ]);
    }
}
