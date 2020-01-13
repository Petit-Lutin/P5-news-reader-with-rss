<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FirstUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {echo 'user';
        \App\User::create(['name'=>'demo', 'email'=>'demo@demo.fr', 'password'=>Hash::make('demo')]);
    }
}
