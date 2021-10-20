<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'user_id' => 1,
            'category_id' => 1,
            'type_id' => 2,
            'title' => 'FlipaFlip looking for investor',
            'body' => 'FlipaFlip pada dasarnya adalah mainan untuk para penyandang kekurangan gejala anxiety.
            Namun, FlipaFlip dapat menjadi sebuah mangkuk ataupun origami yang bebas dari mikroplastik sehingga tidak menghasilkan mikropartikel bila ditekuk-tekuk.
            Tujuan FlipaFlip adalah:
            1. Dapat menjadi inovasi tempat makanan baru bagi anak-anak
            2. Dapat menjadi mainan baru untuk anak-anak yang memiliki anxiety
            
            Prototipe FlipaFlip belum jadi dan masih dalam proses pencobaan; namun, proyek kami membutuhkan dana dari seorang investor maupun sekelompok investor yang percaya terhadap produk kami.
            Dana yang dibutuhkan berkisar sekitar Rp250.000.000,00
            Kontak perusahaan kami:
            Email: flipaflipfinance@flipaflip.com
            WA: 081123123223',
            'excerpt' => Str::limit('FlipaFlip pada dasarnya adalah mainan untuk para penyandang kekurangan gejala anxiety.
            Namun, FlipaFlip dapat menjadi sebuah mangkuk ataupun origami yang bebas dari mikroplastik sehingga tidak menghasilkan mikropartikel bila ditekuk-tekuk.
            Tujuan FlipaFlip adalah:
            1. Dapat menjadi inovasi tempat makanan baru bagi anak-anak
            2. Dapat menjadi mainan baru untuk anak-anak yang memiliki anxiety
            
            Prototipe FlipaFlip belum jadi dan masih dalam proses pencobaan; namun, proyek kami membutuhkan dana dari seorang investor maupun sekelompok investor yang percaya terhadap produk kami.
            Dana yang dibutuhkan berkisar sekitar Rp250.000.000,00
            Kontak perusahaan kami:
            Email: flipaflipfinance@flipaflip.com
            WA: 081123123223', 100),
            'slug' => 'flipa-flip-looking-for-investor',
            'thumbnail_path' => 'a'
        ]);
    }
}
