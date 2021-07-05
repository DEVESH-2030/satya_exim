<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # initialize Address Types
        $credentials =  [
            'name'                  => 'Admin',
            'email'                 => 'admin@gmail.com',
            'password'              => Hash::make('admin@123'),
            'password_plain_text'   => 'admin@123',
        ];

        # Store Data to model
        #foreach ($credentials as $key => $credentials) {
            $admins = Admin::all();
            if($admins->isEmpty()) {
                Admin::create($credentials);
            } else {
                $admins->first()->update($credentials);
            }
        #}
    }
}
