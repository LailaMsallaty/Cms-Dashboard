<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // $users = User::all();
        $user = DB::table('users')->where('email','lailamsallaty607@gmail.com')->first();

        if (!$user) {
          User::create([

            'name'=> 'laila' ,
            'email'=> 'lailamsallaty607@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin'

          ]);
        }
    }
}
