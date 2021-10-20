<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = bcrypt('foundeR123');
        
        User::create([
            'name' => 'Justin Jap',
            'username' => 'justinJap',
            'email' => 'jjap@gmail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'typeable_id' => '1',
            'typeable_type' => 'App\Models\Startup',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Kenny Jinhiro',
            'username' => 'kennyJinhiro',
            'email' => 'kenj@gmail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'typeable_id' => '2',
            'typeable_type' => 'App\Models\Startup',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Nathanael Abel',
            'username' => 'nathanaelAbel',
            'email' => 'nabel@gmail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'typeable_id' => '3',
            'typeable_type' => 'App\Models\Startup',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Reynaldi Kindarto',
            'username' => 'reynaldiKindarto',
            'email' => 'reynaldi@gmail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'typeable_id' => '4',
            'typeable_type' => 'App\Models\Startup',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Michael Eko',
            'username' => 'michaelEko',
            'email' => 'mikeeko@gmail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'typeable_id' => '5',
            'typeable_type' => 'App\Models\Startup',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Albert Jung',
            'username' => 'albertJung',
            'email' => 'albertj@gmail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'typeable_id' => '6',
            'typeable_type' => 'App\Models\Startup',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Robert Ang',
            'username' => 'robertAng',
            'email' => 'robertang@gmail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'typeable_id' => '7',
            'typeable_type' => 'App\Models\Startup',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Wu Chen',
            'username' => 'wuChen',
            'email' => 'wuchen@gmail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'typeable_id' => '8',
            'typeable_type' => 'App\Models\Startup',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Kane Woffman',
            'username' => 'kaneWoffman',
            'email' => 'kanew@gmail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'typeable_id' => '9',
            'typeable_type' => 'App\Models\Startup',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Nicholas Wong',
            'username' => 'nicholasWong',
            'email' => 'nicholasw@gmail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'typeable_id' => '10',
            'typeable_type' => 'App\Models\Startup',
            'remember_token' => Str::random(10),
        ]);
    }
}
