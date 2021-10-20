<?php

namespace Database\Seeders;

use App\Models\Startup;
use Illuminate\Database\Seeder;

class StartupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Startup::create([
            'category_id' => 1,
            'name' => 'FlipaFlip',
            'address' => 'Jakarta Pusat',
            'contact' => '081123123223'
        ]);

        Startup::create([
            'category_id' => 2,
            'name' => 'SmartGlasses',
            'address' => 'Jakarta Pusat',
            'contact' => '@j1j1',
        ]);

        Startup::create([
            'category_id' => 3,
            'name' => 'ShareDong',
            'address' => 'Semarang',
            'contact' => 'finance@sharedong.com'
        ]);

        Startup::create([
            'category_id' => 4,
            'name' => 'Musik Bersama',
            'address' => 'Surabaya',
            'contact' => 'finance@musikbersamaindonesia.com'
        ]);

        Startup::create([
            'category_id' => 5,
            'name' => 'MaxGuard',
            'address' => 'Surabaya',
            'contact' => 'finance.admin@maxguard.com'
        ]);

        Startup::create([
            'category_id' => 6,
            'name' => 'MakNyus',
            'address' => 'Malang',
            'contact' => 'collab@maknyus.com'
        ]);

        Startup::create([
            'category_id' => 7,
            'name' => 'Mebel Bersama Indonesia',
            'address' => 'Bogor',
            'contact' => 'management@mbi.com'
        ]);

        Startup::create([
            'category_id' => 8,
            'name' => 'Power!',
            'address' => 'Tuban',
            'contact' => 'fight@power.com'
        ]);

        Startup::create([
            'category_id' => 9,
            'name' => 'Hope',
            'address' => 'Jakarta Utara',
            'contact' => 'collab@hope.com'
        ]);

        Startup::create([
            'category_id' => 2,
            'name' => 'Hope',
            'address' => 'Jakarta Utara',
            'contact' => 'collab@hope.com'
        ]);

        Startup::create([
            'category_id' => 6,
            'name' => 'GlegGleg',
            'address' => 'Jakarta Utara',
            'contact' => 'kerjasama@gleggleg.com'
        ]);

    }
}
