<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Tips Menjaga Kesehatan Ibu Hamil',
                'content' => '<p>Kehamilan adalah periode yang sangat penting bagi ibu dan bayi. Berikut beberapa tips untuk menjaga kesehatan selama kehamilan:</p>
                <h3>1. Nutrisi yang Seimbang</h3>
                <p>Konsumsi makanan bergizi seimbang yang mengandung protein, karbohidrat, lemak sehat, vitamin, dan mineral. Pastikan asupan asam folat, zat besi, dan kalsium tercukupi.</p>
                <h3>2. Pemeriksaan Rutin</h3>
                <p>Lakukan pemeriksaan kehamilan secara rutin ke dokter atau bidan untuk memantau perkembangan janin dan kesehatan ibu.</p>
                <h3>3. Istirahat Cukup</h3>
                <p>Tidur yang cukup sangat penting untuk ibu hamil. Usahakan tidur 7-9 jam per hari.</p>',
                'author' => 'Admin Posyandu',
                'status' => 'published',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'title' => 'Jadwal Imunisasi Bayi yang Wajib Diketahui',
                'content' => '<p>Imunisasi adalah hal yang sangat penting untuk melindungi bayi dari berbagai penyakit berbahaya. Berikut jadwal imunisasi yang harus dipatuhi:</p>
                <h3>Imunisasi Dasar</h3>
                <ul>
                <li><strong>0-7 hari:</strong> Hepatitis B dan BCG</li>
                <li><strong>2 bulan:</strong> DPT-HB-Hib 1, Polio 1, PCV 1, Rotavirus 1</li>
                <li><strong>3 bulan:</strong> DPT-HB-Hib 2, Polio 2</li>
                <li><strong>4 bulan:</strong> DPT-HB-Hib 3, Polio 3, PCV 2, Rotavirus 2</li>
                </ul>
                <p>Pastikan untuk mengikuti jadwal imunisasi di Posyandu terdekat.</p>',
                'author' => 'Dr. Siti Nurhaliza',
                'status' => 'published',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'title' => 'Pentingnya Penimbangan Rutin untuk Balita',
                'content' => '<p>Penimbangan rutin adalah salah satu cara terbaik untuk memantau pertumbuhan dan perkembangan balita. Mari kita bahas mengapa hal ini penting:</p>
                <h3>Manfaat Penimbangan Rutin</h3>
                <p>Penimbangan membantu mendeteksi dini masalah gizi pada anak, seperti gizi kurang atau gizi berlebih.</p>
                <h3>Kapan Harus Menimbang?</h3>
                <p>Balita sebaiknya ditimbang setiap bulan di Posyandu untuk memantau kurva pertumbuhannya.</p>
                <h3>Yang Perlu Diperhatikan</h3>
                <p>Jika berat badan anak tidak sesuai dengan standar pertumbuhan, segera konsultasikan dengan petugas kesehatan.</p>',
                'author' => 'Bidan Maria',
                'status' => 'published',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'title' => 'Draft: Panduan Perawatan Lansia',
                'content' => '<p>Artikel ini masih dalam tahap draft dan akan segera dipublikasikan. Berisi panduan perawatan kesehatan untuk lansia.</p>',
                'author' => 'Admin Posyandu',
                'status' => 'draft',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
