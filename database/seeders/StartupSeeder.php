<?php

namespace Database\Seeders;

use App\Models\Startup;
use Illuminate\Database\Seeder;

class StartupSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Startup::create([
            'category_id' => 1,
            'owner_id' => 1,
            'logo_path' => 'https://drive.google.com/uc?id=1R89jlcOsyY9Om0lVB0uHKRMIRGMOYXZ1',
            'about' => 'Kami adalah perusahaan rintisan FlipaFlip',
            'name' => 'FlipaFlip',
            'address' => 'Jakarta Pusat',
            'contact' => '081123123223'
        ]);

        Startup::create([
            'category_id' => 2,
            'owner_id' => 2,
            'logo_path' => 'https://drive.google.com/uc?id=1OLI2hk3RWCPGhnviHAcIaTHe3TetwGvh',
            'about' => 'Kami adalah perusahaan rintisan SmartGlasses',
            'name' => 'SmartGlasses',
            'address' => 'Jakarta Pusat',
            'contact' => '@j1j1',
        ]);

        Startup::create([
            'category_id' => 3,
            'owner_id' => 3,
            'logo_path' => 'https://drive.google.com/uc?id=1UWUtraD-GV4uybOCbfGhSp2Kr-ay7qZM',
            'about' => 'Kami adalah perusahaan rintisan ShareDong',
            'name' => 'ShareDong',
            'address' => 'Semarang',
            'contact' => 'finance@sharedong.com'
        ]);

        Startup::create([
            'category_id' => 4,
            'owner_id' => 4,
            'logo_path' => 'https://drive.google.com/uc?id=1D5cYKerauURHOudsdwF_afuhRSs-Rm8H',
            'about' => 'Kami adalah perusahaan rintisan Musik Bersama',
            'name' => 'Musik Bersama',
            'address' => 'Surabaya',
            'contact' => 'finance@musikbersamaindonesia.com'
        ]);

        Startup::create([
            'category_id' => 5,
            'owner_id' => 5,
            'logo_path' => 'https://drive.google.com/uc?id=1KUgd0smvwUEccFEdWNFbkRWVTKFa15fw',
            'about' => 'Kami adalah perusahaan rintisan MaxGuard',
            'name' => 'MaxGuard',
            'address' => 'Surabaya',
            'contact' => 'finance.admin@maxguard.com'
        ]);

        Startup::create([
            'category_id' => 6,
            'owner_id' => 6,
            'logo_path' => 'https://drive.google.com/uc?id=1SN07JiFQmX01rvLdVoVE_r4LCl6t-y2_',
            'about' => 'Kami adalah perusahaan rintisan MakNyus',
            'name' => 'MakNyus',
            'address' => 'Malang',
            'contact' => 'collab@maknyus.com'
        ]);

        Startup::create([
            'category_id' => 7,
            'owner_id' => 7,
            'logo_path' => 'https://drive.google.com/uc?id=1ME1G9MLW67IQXX7whYSekcq5WYC2tMiU',
            'about' => 'Kami adalah perusahaan rintisan Mebel Bersama Indonesia',
            'name' => 'Mebel Bersama Indonesia',
            'address' => 'Bogor',
            'contact' => 'management@mbi.com'
        ]);

        Startup::create([
            'category_id' => 8,
            'owner_id' => 8,
            'logo_path' => 'https://drive.google.com/uc?id=1zds8Lb1F54DGKr4r-azBdpLScJYH3XjW',
            'about' => 'Kami adalah perusahaan rintisan Power!',
            'name' => 'Power!',
            'address' => 'Tuban',
            'contact' => 'fight@power.com'
        ]);

        Startup::create([
            'category_id' => 2,
            'owner_id' => 9,
            'logo_path' => 'https://drive.google.com/uc?id=1iYYAHE6Qre0GT7Le9d283ElcZwAbd53k',
            'about' => 'Kami adalah perusahaan rintisan Hope',
            'name' => 'Hope',
            'address' => 'Jakarta Utara',
            'contact' => 'collab@hope.com'
        ]);

        Startup::create([
            'category_id' => 6,
            'owner_id' => 10,
            'logo_path' => 'https://drive.google.com/uc?id=19jZdYAjZuLnlqKrc-opfpzmjEef-xvKr',
            'about' => 'Kami adalah perusahaan rintisan GlegGleg',
            'name' => 'GlegGleg',
            'address' => 'Jakarta Utara',
            'contact' => 'kerjasama@gleggleg.com'
        ]);
    }
}
