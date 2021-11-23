<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Post::create([
            'user_id' => 1,
            'category_id' => 1,
            'type_id' => 2,
            'title' => 'FlipaFlip looking for investor',
            'body' => '<div>FlipaFlip pada dasarnya adalah mainan untuk para penyandang kekurangan gejala anxiety.<br>Namun, FlipaFlip dapat menjadi sebuah mangkuk ataupun origami yang bebas dari mikroplastik sehingga tidak menghasilkan mikropartikel bila ditekuk-tekuk.<br>Tujuan FlipaFlip adalah:<br>1. Dapat menjadi inovasi tempat makanan baru bagi anak-anak<br>2. Dapat menjadi mainan baru untuk anak-anak yang memiliki anxiety<br><br>Prototipe FlipaFlip belum jadi dan masih dalam proses pencobaan; namun, proyek kami membutuhkan dana dari seorang investor maupun sekelompok investor yang percaya terhadap produk kami.<br>Dana yang dibutuhkan berkisar sekitar Rp250.000.000,00<br>Kontak perusahaan kami:<br>Email: flipaflipfinance@flipaflip.com<br>WA: 081123123223</div>',
            'excerpt' => Str::limit(strip_tags('<div>FlipaFlip pada dasarnya adalah mainan untuk para penyandang kekurangan gejala anxiety.<br>Namun, FlipaFlip dapat menjadi sebuah mangkuk ataupun origami yang bebas dari mikroplastik sehingga tidak menghasilkan mikropartikel bila ditekuk-tekuk.<br>Tujuan FlipaFlip adalah:<br>1. Dapat menjadi inovasi tempat makanan baru bagi anak-anak<br>2. Dapat menjadi mainan baru untuk anak-anak yang memiliki anxiety<br><br>Prototipe FlipaFlip belum jadi dan masih dalam proses pencobaan; namun, proyek kami membutuhkan dana dari seorang investor maupun sekelompok investor yang percaya terhadap produk kami.<br>Dana yang dibutuhkan berkisar sekitar Rp250.000.000,00<br>Kontak perusahaan kami:<br>Email: flipaflipfinance@flipaflip.com<br>WA: 081123123223</div>'), 100),
            'slug' => 'flipa-flip-looking-for-investor',
            'thumbnail_path' => 'https://drive.google.com/uc?id=11BFGNnl0fawAlzq84ZtBszy_fzHhHK_N',
            'views' => mt_rand(500, 1000),
            'upvote' => mt_rand(200, 500),
            'downvote' => mt_rand(50, 100)
        ]);

        Post::create([
            'user_id' => 2,
            'category_id' => 2,
            'type_id' => 2,
            'title' => 'SmartGlasses looking for investor',
            'body' => '<div>SmartGlasses adalah kacamata yang memiliki fitur-fitur utama futuristis:<br>1. Mengkalibrasi myopia dan hipermetropi dalam mata secara otomatis dan membuat lensa secara otomatis.<br>2. Memberi notifikasi istirahat mata melalui jam internal.<br>3. Mendeteksi proyeksi yang menuju mata dan menutup kacamata dengan lapisan anti peluru.<br><br>Prototipe SmartGlasses telah selesai dibuat dengan kapabilitas yang mencukupi untuk seluruh fitur tersebut; namun, proyek kami membutuhkan investor individu maupun berkelompok.&nbsp;<br><br>Dana yang dibutuhkan berkisaran Rp1.000.000.000,00<br>Kontak saya:<br>LINE: @j1j1<br>Email: j1@ji.com</div>',
            'excerpt' => Str::limit(strip_tags('<div>SmartGlasses adalah kacamata yang memiliki fitur-fitur utama futuristis:<br>1. Mengkalibrasi myopia dan hipermetropi dalam mata secara otomatis dan membuat lensa secara otomatis.<br>2. Memberi notifikasi istirahat mata melalui jam internal.<br>3. Mendeteksi proyeksi yang menuju mata dan menutup kacamata dengan lapisan anti peluru.<br><br>Prototipe SmartGlasses telah selesai dibuat dengan kapabilitas yang mencukupi untuk seluruh fitur tersebut; namun, proyek kami membutuhkan investor individu maupun berkelompok.&nbsp;<br><br>Dana yang dibutuhkan berkisaran Rp1.000.000.000,00<br>Kontak saya:<br>LINE: @j1j1<br>Email: j1@ji.com</div>'), 100),
            'slug' => 'smart-glasses-looking-for-investor',
            'thumbnail_path' => 'https://drive.google.com/uc?id=16VjZM3a3Gr72mQDcE4eQPPtWPLHdARTb',
            'views' => mt_rand(500, 1000),
            'upvote' => mt_rand(200, 500),
            'downvote' => mt_rand(50, 100)
        ]);

        Post::create([
            'user_id' => 3,
            'category_id' => 3,
            'type_id' => 2,
            'title' => 'ShareDong looking for investor',
            'body' => '<div>ShareDong adalah komunitas nonprofit yang ingin membagi terhadap warga-warga yang kurang beruntung.<br><br>Situs ShareDong telah aktif: sharedong.co.id<br>Cara kerja ShareDong akan diberikan terhadap investor yang ingin memberikan dana terhadap server ShareDong.<br>Karena ShareDong tidak meraup untung, ShareDong hanya akan menyala setara dengan dana yang diberikan oleh investor dengan kontrak yang harus dibuat oleh investor untuk jalannya ShareDong.<br><br>ShareDong tidak memiliki kisaran dana. Investor berkelompok maupun individu dipersilahkan<br>Kontak kami:<br>finance@sharedong.com<br>abel@sharedong.com&nbsp;<br>rodric@sharedong.com&nbsp;<br>ella@sharedong.com<br><br>Kami berharap agar email dapat dikirimkan ke tiga-tiga anggota ShareDong agar lebih mudah untuk diproses. Terima kasih banyak.</div>',
            'excerpt' => Str::limit(strip_tags('<div>ShareDong adalah komunitas nonprofit yang ingin membagi terhadap warga-warga yang kurang beruntung.<br><br>Situs ShareDong telah aktif: sharedong.co.id<br>Cara kerja ShareDong akan diberikan terhadap investor yang ingin memberikan dana terhadap server ShareDong.<br>Karena ShareDong tidak meraup untung, ShareDong hanya akan menyala setara dengan dana yang diberikan oleh investor dengan kontrak yang harus dibuat oleh investor untuk jalannya ShareDong.<br><br>ShareDong tidak memiliki kisaran dana. Investor berkelompok maupun individu dipersilahkan<br>Kontak kami:<br>finance@sharedong.com<br>abel@sharedong.com&nbsp;<br>rodric@sharedong.com&nbsp;<br>ella@sharedong.com<br><br>Kami berharap agar email dapat dikirimkan ke tiga-tiga anggota ShareDong agar lebih mudah untuk diproses. Terima kasih banyak.</div>'), 100),
            'slug' => 'share-dong-looking-for-investor',
            'thumbnail_path' => 'https://drive.google.com/uc?id=1Mf98pMCwFIKI-yCVqyc6gUjOchftXyQX',
            'views' => mt_rand(500, 1000),
            'upvote' => mt_rand(200, 500),
            'downvote' => mt_rand(50, 100)
        ]);

        Post::create([
            'user_id' => 4,
            'category_id' => 4,
            'type_id' => 2,
            'title' => 'Musik Bersama Indonesia looking for investor',
            'body' => '<div>Musik Bersama Indonesia adalah usaha swasta kursus musik yang dijalankan oleh satu tim yang memiliki pengalaman internasional maupun secara nasional di Indonesia.<br>Musik Bersama Indonesia ingin memberikan Indonesia prestasi sebaik mungkin dalam alat musik piano, gitar, drum, dan biola.&nbsp;<br>Musik Bersama Indonesia terdiri dari 5 anggota dimana setiap anggotanya memiliki spesialisasi dalam satu alat musik: Reynaldi Kindarto, Albert Hwachung, Usha Ziccoto, Diamond Hulbert, dan Albert James.<br><br>CV serta biodata setiap anggota dapat ditemukan di musikbersamaindonesia.co.id.<br><br>Namun, Musik Bersama Indonesia membutuhkan dana dari investor yang tentu akan dibagi menjadi bagian saham dari investor tersebut. Kontrak dapat diperbincangkan dengan seluruh tim.<br><br>Dana yang dibutuhkan berkisaran Rp2.500.000.000,00<br>Kontak kami:<br>finance@musikbersamaindonesia.com<br><br>Kami akan membalas surel anda dalam 1-3 hari kerja, terima kasih banyak.</div>',
            'excerpt' => Str::limit(strip_tags('<div>Musik Bersama Indonesia adalah usaha swasta kursus musik yang dijalankan oleh satu tim yang memiliki pengalaman internasional maupun secara nasional di Indonesia.<br>Musik Bersama Indonesia ingin memberikan Indonesia prestasi sebaik mungkin dalam alat musik piano, gitar, drum, dan biola.&nbsp;<br>Musik Bersama Indonesia terdiri dari 5 anggota dimana setiap anggotanya memiliki spesialisasi dalam satu alat musik: Reynaldi Kindarto, Albert Hwachung, Usha Ziccoto, Diamond Hulbert, dan Albert James.<br><br>CV serta biodata setiap anggota dapat ditemukan di musikbersamaindonesia.co.id.<br><br>Namun, Musik Bersama Indonesia membutuhkan dana dari investor yang tentu akan dibagi menjadi bagian saham dari investor tersebut. Kontrak dapat diperbincangkan dengan seluruh tim.<br><br>Dana yang dibutuhkan berkisaran Rp2.500.000.000,00<br>Kontak kami:<br>finance@musikbersamaindonesia.com<br><br>Kami akan membalas surel anda dalam 1-3 hari kerja, terima kasih banyak.</div>'), 100),
            'slug' => 'musik-bersama-indonesia-looking-for-investor',
            'thumbnail_path' => 'https://drive.google.com/uc?id=1qUYUcNt7dTrw48H1OFCJKZdPtaubhBHt',
            'views' => mt_rand(500, 1000),
            'upvote' => mt_rand(200, 500),
            'downvote' => mt_rand(50, 100)
        ]);

        Post::create([
            'user_id' => 5,
            'category_id' => 5,
            'type_id' => 2,
            'title' => 'MaxGuard looking for investor',
            'body' => '<div>MaxGuard adalah usaha swasta yang menjamin perlindungan dalam pakaian maupun kendaraan.<br>MaxGuard memiliki produk sebagai berikut yang telah dibuat prototipenya:<br>1. Lite Vest - Rompi yang dapat menangkal tusukan pisau.<br>2. Ballistic - Rompi yang dapat menangkal peluru kecil serta tusukan pisau.<br>3. Heavy Vest - Rompi yang dapat menangkal peluru besar, peluru kecil, serta tusukan pisau.<br>4. Lite Glass - Kaca Mobil yang dapat menangkal pukulan.<br>5. Premium Glass - Kaca Mobil yang dapat menangkal peluru apapun kecuali ledakan yang besar.<br>6. Premium+ Glass - Kaca Mobil yang dapat menangkal proyektil beserta ledakan.<br><br>Tujuan MaxGuard membutuhkan investor adalah agar MaxGuard memiliki keberlangsungan yang lebih lama.<br><br>Dana yang dibutuhkan berkisaran Rp1.500.000.000,00<br>Kontak kami:<br>finance_admin@maxguard.com<br><br>Tim kami akan membalas surel anda dalam 2-4 hari kerja, terima kasih banyak.</div>',
            'excerpt' => Str::limit(strip_tags('<div>MaxGuard adalah usaha swasta yang menjamin perlindungan dalam pakaian maupun kendaraan.<br>MaxGuard memiliki produk sebagai berikut yang telah dibuat prototipenya:<br>1. Lite Vest - Rompi yang dapat menangkal tusukan pisau.<br>2. Ballistic - Rompi yang dapat menangkal peluru kecil serta tusukan pisau.<br>3. Heavy Vest - Rompi yang dapat menangkal peluru besar, peluru kecil, serta tusukan pisau.<br>4. Lite Glass - Kaca Mobil yang dapat menangkal pukulan.<br>5. Premium Glass - Kaca Mobil yang dapat menangkal peluru apapun kecuali ledakan yang besar.<br>6. Premium+ Glass - Kaca Mobil yang dapat menangkal proyektil beserta ledakan.<br><br>Tujuan MaxGuard membutuhkan investor adalah agar MaxGuard memiliki keberlangsungan yang lebih lama.<br><br>Dana yang dibutuhkan berkisaran Rp1.500.000.000,00<br>Kontak kami:<br>finance_admin@maxguard.com<br><br>Tim kami akan membalas surel anda dalam 2-4 hari kerja, terima kasih banyak.</div>'), 100),
            'slug' => 'max-guard-looking-for-investor',
            'thumbnail_path' => 'https://drive.google.com/uc?id=1UfgnLBq2AImPi05tBJfNRIZCv55EYx9u',
            'views' => mt_rand(500, 1000),
            'upvote' => mt_rand(200, 500),
            'downvote' => mt_rand(50, 100)
        ]);

        Post::create([
            'user_id' => 6,
            'category_id' => 6,
            'type_id' => 1,
            'title' => 'MakNyus',
            'body' => '<div>MakNyus adalah restoran lokal yang menyediakan makanan murah terutama untuk para pekerja yang memiliki gaji setara dengan UMR.<br>Sehingga, MakNyus membutuhkan kolaborasi dengan pabrik suppllier atau pengusaha yang dapat menyediakan bahan baku dibawah harga seharusnya:<br>- Nasi (&lt;Rp10.000,00/250gr)<br>- Mi (&lt;Rp17.500,00/300gr)<br>- Cabe (&lt;Rp12.500,00/400gr)<br>- Garam (&lt;Rp15.000,00/500gr)<br>- Lada (&lt;Rp15.000,00/500gr)<br><br>Kontak MakNyus adalah hanya melalui surel: collab@maknyus.com<br>Tim kami akan membalas surel anda dalam 1-2 hari kerja, terima kasih banyak.</div>',
            'excerpt' => Str::limit(strip_tags('<div>MakNyus adalah restoran lokal yang menyediakan makanan murah terutama untuk para pekerja yang memiliki gaji setara dengan UMR.<br>Sehingga, MakNyus membutuhkan kolaborasi dengan pabrik suppllier atau pengusaha yang dapat menyediakan bahan baku dibawah harga seharusnya:<br>- Nasi (&lt;Rp10.000,00/250gr)<br>- Mi (&lt;Rp17.500,00/300gr)<br>- Cabe (&lt;Rp12.500,00/400gr)<br>- Garam (&lt;Rp15.000,00/500gr)<br>- Lada (&lt;Rp15.000,00/500gr)<br><br>Kontak MakNyus adalah hanya melalui surel: collab@maknyus.com<br>Tim kami akan membalas surel anda dalam 1-2 hari kerja, terima kasih banyak.</div>'), 100),
            'slug' => 'maknyus',
            'thumbnail_path' => 'https://drive.google.com/uc?id=1JnH3vDi3G2ACsVYaFvk0QodEPpUKFwWs',
            'views' => mt_rand(500, 1000),
            'upvote' => mt_rand(200, 500),
            'downvote' => mt_rand(50, 100)
        ]);

        Post::create([
            'user_id' => 7,
            'category_id' => 7,
            'type_id' => 1,
            'title' => 'Mebel Bersama Indonesia',
            'body' => '<div>Mebel Bersama Indonesia adalah usaha mebel kayu yang menyediakan mebel berkualitas tinggi untuk jangka waktu yang lama.<br>Sehingga, MebelBersama tentu membutuhkan kolaborasi dengan pabrik supplier atau pengusaha supplier yang dapat menyediakan bahan baku dibawah harga biasanya:<br>- Kayu Jati (&lt;Rp100.000.000,00/50kg)<br>- Kayu Mahogani (&lt;Rp70.000.000,00/50kg)<br>- Kayu Trembesi (&lt;Rp50.000.000,00/50kg)<br>- Kayu Sungkai (&lt;Rp50.000.000,00/50kg)<br><br>Kontak Mebel Bersama Indonesia dapat ditemukan di management@mbi.com<br>TIm kami akan membalas surel anda dalam 1-3 hari kerja, terima kasih banyak</div>',
            'excerpt' => Str::limit(strip_tags('<div>Mebel Bersama Indonesia adalah usaha mebel kayu yang menyediakan mebel berkualitas tinggi untuk jangka waktu yang lama.<br>Sehingga, MebelBersama tentu membutuhkan kolaborasi dengan pabrik supplier atau pengusaha supplier yang dapat menyediakan bahan baku dibawah harga biasanya:<br>- Kayu Jati (&lt;Rp100.000.000,00/50kg)<br>- Kayu Mahogani (&lt;Rp70.000.000,00/50kg)<br>- Kayu Trembesi (&lt;Rp50.000.000,00/50kg)<br>- Kayu Sungkai (&lt;Rp50.000.000,00/50kg)<br><br>Kontak Mebel Bersama Indonesia dapat ditemukan di management@mbi.com<br>TIm kami akan membalas surel anda dalam 1-3 hari kerja, terima kasih banyak</div>'), 100),
            'slug' => 'mebel-bersama-indonesia',
            'thumbnail_path' => 'https://drive.google.com/uc?id=1UxiLBCNh-SqO_z-BvMIHO6KAXluxNZOx',
            'views' => mt_rand(500, 1000),
            'upvote' => mt_rand(200, 500),
            'downvote' => mt_rand(50, 100)
        ]);

        Post::create([
            'user_id' => 8,
            'category_id' => 2,
            'type_id' => 1,
            'title' => 'Hope',
            'body' => '<div>Hope adalah aplikasi harapan yang dapat memberi motivasi terhadap orang-orang yang kurang bahagia dalam hidupnya.<br>Hope kekurangan supply server, sehingga Hope ingin kolaborasi dengan penyedia server yang ada disekitar Indonesia maupun Singapore.<br><br>Hubungi kami di collab@hope.com<br>Tim kami akan membalas surel anda dalam 1-4 hari kerja, terima kasih banyak.</div>',
            'excerpt' => Str::limit(strip_tags('<div>Hope adalah aplikasi harapan yang dapat memberi motivasi terhadap orang-orang yang kurang bahagia dalam hidupnya.<br>Hope kekurangan supply server, sehingga Hope ingin kolaborasi dengan penyedia server yang ada disekitar Indonesia maupun Singapore.<br><br>Hubungi kami di collab@hope.com<br>Tim kami akan membalas surel anda dalam 1-4 hari kerja, terima kasih banyak.</div>'), 100),
            'slug' => 'hope',
            'thumbnail_path' => 'https://drive.google.com/uc?id=13lr9zJ-oSKv4yZNdjWMgo-vsEhnErz_i',
            'views' => mt_rand(500, 1000),
            'upvote' => mt_rand(200, 500),
            'downvote' => mt_rand(50, 100)
        ]);

        Post::create([
            'user_id' => 9,
            'category_id' => 6,
            'type_id' => 1,
            'title' => 'GlegGleg',
            'body' => '<div>GlegGleg adalah usaha konsumsi minuman yang bertujuan untuk menambah produktivitas serta tenaga seseorang dengan rentang harga yang murah.<br>Namun, GlegGleg membutuhkan kolaborasi dengan pabrik supplier atau pengusaha supplier yang dapat menyediakan bahan baku dibawah harga biasanya:<br>- Ginseng (&lt;Rp2.000,00/100gr)<br>- Soda (&lt;Rp6.000,00/250gr)<br>- Mulberry (&lt;Rp35.000,00/150gr)<br><br>Kontak GlegGleg dapat ditemukan di kerjasama@gleggleg.com<br>Tim kami akan membalas surel anda dalam 1-4 hari kerja, terima kasih banyak.</div>',
            'excerpt' => Str::limit(strip_tags('<div>GlegGleg adalah usaha konsumsi minuman yang bertujuan untuk menambah produktivitas serta tenaga seseorang dengan rentang harga yang murah.<br>Namun, GlegGleg membutuhkan kolaborasi dengan pabrik supplier atau pengusaha supplier yang dapat menyediakan bahan baku dibawah harga biasanya:<br>- Ginseng (&lt;Rp2.000,00/100gr)<br>- Soda (&lt;Rp6.000,00/250gr)<br>- Mulberry (&lt;Rp35.000,00/150gr)<br><br>Kontak GlegGleg dapat ditemukan di kerjasama@gleggleg.com<br>Tim kami akan membalas surel anda dalam 1-4 hari kerja, terima kasih banyak.</div>'), 100),
            'slug' => 'gleg-gleg',
            'thumbnail_path' => 'https://drive.google.com/uc?id=1qtj7iTZjqCmHk4hg9N-Y897jYNaIvD-t',
            'views' => mt_rand(500, 1000),
            'upvote' => mt_rand(200, 500),
            'downvote' => mt_rand(50, 100)
        ]);

        Post::create([
            'user_id' => 10,
            'category_id' => 8,
            'type_id' => 1,
            'title' => 'Power!',
            'body' => '<div>Power! adalah usaha swasta raket bulutangkis yang menjamin raket yang berkualitas dalam jangka harga yang murah.<br>Namun, Power! membutuhkan kolaborasi dengan pabrik atau pengusaha yang dapat menyediakan serbuk titanium dan plastik berkualitas.<br>Jangka harga yang ingin saya capai adalah Rp250.000,00/5gr untuk serbuk titanium dan Rp100.000,00/200gr untuk plastik.<br><br>Power! dapat dihubungi di fight@power.com<br>Tim kami akan membalas surel anda dalam 2-4 hari kerja, terima kasih banyak.</div>',
            'excerpt' => Str::limit(strip_tags('<div>Power! adalah usaha swasta raket bulutangkis yang menjamin raket yang berkualitas dalam jangka harga yang murah.<br>Namun, Power! membutuhkan kolaborasi dengan pabrik atau pengusaha yang dapat menyediakan serbuk titanium dan plastik berkualitas.<br>Jangka harga yang ingin saya capai adalah Rp250.000,00/5gr untuk serbuk titanium dan Rp100.000,00/200gr untuk plastik.<br><br>Power! dapat dihubungi di fight@power.com<br>Tim kami akan membalas surel anda dalam 2-4 hari kerja, terima kasih banyak.</div>'), 100),
            'slug' => 'power',
            'thumbnail_path' => 'https://drive.google.com/uc?id=1Vr8a-zVOlRXV84e9G28t6ZIMyoL-GO12',
            'views' => mt_rand(500, 1000),
            'upvote' => mt_rand(200, 500),
            'downvote' => mt_rand(50, 100)
        ]);
    }
}
