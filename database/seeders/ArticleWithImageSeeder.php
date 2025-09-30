<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ArticleWithImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus artikel lama
        Article::truncate();

        // Copy gambar dari public/img/news ke storage/app/public/articles
        $sourceDir = public_path('img/news');
        $destDir = storage_path('app/public/articles');
        
        // Buat folder articles jika belum ada
        if (!File::exists($destDir)) {
            File::makeDirectory($destDir, 0755, true);
        }

        $articles = [
            [
                'title' => 'Tips Menjaga Kesehatan Ibu Hamil di Masa Pandemi',
                'content' => '<h3>Pentingnya Menjaga Kesehatan Ibu Hamil</h3>
                <p>Kehamilan adalah periode yang sangat penting bagi ibu dan bayi. Di masa pandemi ini, ibu hamil perlu ekstra perhatian dalam menjaga kesehatan. Berikut beberapa tips yang dapat diterapkan:</p>
                
                <h4>1. Nutrisi yang Seimbang</h4>
                <p>Konsumsi makanan bergizi seimbang yang mengandung:</p>
                <ul>
                    <li>Protein (daging, ikan, telur, kacang-kacangan)</li>
                    <li>Karbohidrat kompleks (nasi merah, roti gandum)</li>
                    <li>Sayuran hijau (bayam, kangkung, brokoli)</li>
                    <li>Buah-buahan segar (jeruk, apel, pisang)</li>
                    <li>Susu dan produk olahan susu</li>
                </ul>
                
                <h4>2. Pemeriksaan Rutin</h4>
                <p>Lakukan pemeriksaan kehamilan secara rutin sesuai jadwal yang ditetapkan dokter atau bidan. Pemeriksaan ini penting untuk memantau:</p>
                <ul>
                    <li>Perkembangan janin</li>
                    <li>Kesehatan ibu</li>
                    <li>Deteksi dini komplikasi</li>
                </ul>
                
                <h4>3. Istirahat yang Cukup</h4>
                <p>Tidur yang cukup sangat penting untuk ibu hamil. Usahakan tidur 7-9 jam per hari dan hindari begadang.</p>',
                'author' => 'Dr. Siti Nurhaliza',
                'image' => 'img01.jpg',
                'status' => 'published',
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
            [
                'title' => 'Jadwal Imunisasi Bayi yang Wajib Diketahui Orang Tua',
                'content' => '<h3>Mengapa Imunisasi Penting?</h3>
                <p>Imunisasi adalah hal yang sangat penting untuk melindungi bayi dari berbagai penyakit berbahaya. Program imunisasi di Indonesia telah terbukti menurunkan angka kesakitan dan kematian bayi secara signifikan.</p>
                
                <h4>Jadwal Imunisasi Dasar Lengkap</h4>
                <table border="1" style="width: 100%; border-collapse: collapse; margin: 20px 0;">
                    <tr style="background-color: #f8f9fa;">
                        <th style="padding: 10px;">Umur</th>
                        <th style="padding: 10px;">Jenis Vaksin</th>
                        <th style="padding: 10px;">Penyakit yang Dicegah</th>
                    </tr>
                    <tr>
                        <td style="padding: 8px;">0-7 hari</td>
                        <td style="padding: 8px;">Hepatitis B, BCG</td>
                        <td style="padding: 8px;">Hepatitis B, TBC</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px;">2 bulan</td>
                        <td style="padding: 8px;">DPT-HB-Hib 1, Polio 1</td>
                        <td style="padding: 8px;">Difteri, Pertusis, Tetanus, Hepatitis B, Haemophilus influenzae, Polio</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px;">3 bulan</td>
                        <td style="padding: 8px;">DPT-HB-Hib 2, Polio 2</td>
                        <td style="padding: 8px;">Lanjutan imunisasi dasar</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px;">4 bulan</td>
                        <td style="padding: 8px;">DPT-HB-Hib 3, Polio 3</td>
                        <td style="padding: 8px;">Lanjutan imunisasi dasar</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px;">9 bulan</td>
                        <td style="padding: 8px;">Campak</td>
                        <td style="padding: 8px;">Campak</td>
                    </tr>
                </table>
                
                <h4>Tips untuk Orang Tua</h4>
                <p>Pastikan untuk mengikuti jadwal imunisasi di Posyandu terdekat dan simpan buku KIA (Kesehatan Ibu dan Anak) dengan baik sebagai catatan riwayat imunisasi.</p>',
                'author' => 'Bidan Maria Sari',
                'image' => 'img02.jpg',
                'status' => 'published',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'title' => 'Pentingnya Penimbangan Rutin untuk Memantau Pertumbuhan Balita',
                'content' => '<h3>Mengapa Penimbangan Rutin Penting?</h3>
                <p>Penimbangan rutin adalah salah satu cara terbaik untuk memantau pertumbuhan dan perkembangan balita. Melalui penimbangan yang dilakukan secara berkala, kita dapat mendeteksi dini berbagai masalah kesehatan pada anak.</p>
                
                <h4>Manfaat Penimbangan Rutin</h4>
                <ul>
                    <li><strong>Deteksi Dini Gizi Kurang:</strong> Dapat mengidentifikasi anak yang mengalami gizi kurang atau gizi buruk</li>
                    <li><strong>Monitoring Pertumbuhan:</strong> Memantau apakah pertumbuhan anak sesuai dengan standar WHO</li>
                    <li><strong>Pencegahan Stunting:</strong> Deteksi dini risiko stunting pada anak</li>
                    <li><strong>Evaluasi Program Gizi:</strong> Menilai efektivitas program pemberian makanan tambahan</li>
                </ul>
                
                <h4>Kapan Harus Menimbang?</h4>
                <p>Balita sebaiknya ditimbang setiap bulan di Posyandu. Jadwal penimbangan yang konsisten akan memberikan data yang akurat tentang pertumbuhan anak.</p>
                
                <h4>Interpretasi Hasil Penimbangan</h4>
                <p>Hasil penimbangan akan diplotkan dalam grafik pertumbuhan (KMS - Kartu Menuju Sehat). Ada beberapa kategori:</p>
                <ul>
                    <li><strong>Naik (N):</strong> Berat badan anak naik mengikuti garis pertumbuhan</li>
                    <li><strong>Tidak Naik (T):</strong> Berat badan anak tidak naik atau naik tapi tidak mencukupi</li>
                </ul>
                
                <h4>Tindak Lanjut</h4>
                <p>Jika berat badan anak tidak sesuai dengan standar pertumbuhan, segera konsultasikan dengan petugas kesehatan di Posyandu untuk mendapatkan penanganan yang tepat.</p>',
                'author' => 'Kader Posyandu Sari',
                'image' => 'img03.jpg',
                'status' => 'published',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'title' => 'Panduan Lengkap Perawatan Kesehatan Lansia di Rumah',
                'content' => '<h3>Pentingnya Perhatian Khusus untuk Lansia</h3>
                <p>Lansia memerlukan perhatian khusus dalam hal perawatan kesehatan. Dengan bertambahnya usia, sistem kekebalan tubuh menurun dan risiko berbagai penyakit meningkat. Oleh karena itu, perawatan yang tepat sangat penting untuk menjaga kualitas hidup lansia.</p>
                
                <h4>Aspek-Aspek Perawatan Lansia</h4>
                
                <h5>1. Nutrisi yang Tepat</h5>
                <ul>
                    <li>Berikan makanan yang mudah dicerna</li>
                    <li>Pastikan asupan protein yang cukup</li>
                    <li>Batasi garam dan gula</li>
                    <li>Perbanyak konsumsi sayur dan buah</li>
                    <li>Pastikan hidrasi yang cukup</li>
                </ul>
                
                <h5>2. Aktivitas Fisik</h5>
                <ul>
                    <li>Olahraga ringan seperti jalan kaki</li>
                    <li>Senam lansia secara rutin</li>
                    <li>Latihan keseimbangan untuk mencegah jatuh</li>
                    <li>Fisioterapi jika diperlukan</li>
                </ul>
                
                <h5>3. Pemeriksaan Kesehatan Rutin</h5>
                <ul>
                    <li>Cek tekanan darah secara berkala</li>
                    <li>Pemeriksaan gula darah</li>
                    <li>Kontrol rutin ke dokter</li>
                    <li>Pemeriksaan mata dan pendengaran</li>
                </ul>
                
                <h5>4. Kesehatan Mental</h5>
                <ul>
                    <li>Berikan perhatian dan kasih sayang</li>
                    <li>Libatkan dalam aktivitas sosial</li>
                    <li>Stimulasi kognitif dengan permainan atau bacaan</li>
                    <li>Dengarkan keluh kesah mereka</li>
                </ul>
                
                <h4>Tanda-Tanda yang Perlu Diwaspadai</h4>
                <p>Segera hubungi petugas kesehatan jika lansia mengalami:</p>
                <ul>
                    <li>Penurunan nafsu makan yang drastis</li>
                    <li>Kesulitan bernapas</li>
                    <li>Nyeri dada</li>
                    <li>Pusing atau pingsan</li>
                    <li>Perubahan perilaku yang signifikan</li>
                </ul>',
                'author' => 'Dr. Ahmad Wijaya',
                'image' => 'img04.jpg',
                'status' => 'published',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'title' => 'Cara Mencegah dan Menangani Diare pada Balita',
                'content' => '<h3>Diare pada Balita: Penyebab dan Pencegahan</h3>
                <p>Diare adalah salah satu masalah kesehatan yang sering dialami balita. Kondisi ini dapat berbahaya jika tidak ditangani dengan tepat, karena dapat menyebabkan dehidrasi yang mengancam nyawa.</p>
                
                <h4>Penyebab Diare pada Balita</h4>
                <ul>
                    <li><strong>Infeksi virus:</strong> Rotavirus, norovirus</li>
                    <li><strong>Infeksi bakteri:</strong> E. coli, Salmonella</li>
                    <li><strong>Parasit:</strong> Giardia</li>
                    <li><strong>Keracunan makanan:</strong> Makanan yang terkontaminasi</li>
                    <li><strong>Intoleransi makanan:</strong> Laktosa, gluten</li>
                    <li><strong>Efek samping obat:</strong> Antibiotik</li>
                </ul>
                
                <h4>Gejala yang Perlu Diwaspadai</h4>
                <ul>
                    <li>BAB cair lebih dari 3 kali sehari</li>
                    <li>Demam tinggi</li>
                    <li>Muntah-muntah</li>
                    <li>Tanda-tanda dehidrasi (mata cekung, mulut kering, rewel)</li>
                    <li>BAB berdarah atau berlendir</li>
                </ul>
                
                <h4>Cara Pencegahan</h4>
                <ol>
                    <li><strong>Menjaga Kebersihan:</strong>
                        <ul>
                            <li>Cuci tangan dengan sabun secara teratur</li>
                            <li>Bersihkan mainan anak secara rutin</li>
                            <li>Jaga kebersihan lingkungan rumah</li>
                        </ul>
                    </li>
                    <li><strong>Keamanan Makanan:</strong>
                        <ul>
                            <li>Berikan ASI eksklusif hingga 6 bulan</li>
                            <li>Masak makanan hingga matang</li>
                            <li>Hindari makanan yang sudah basi</li>
                            <li>Gunakan air bersih untuk minum dan memasak</li>
                        </ul>
                    </li>
                </ol>
                
                <h4>Penanganan di Rumah</h4>
                <ul>
                    <li><strong>Berikan oralit:</strong> Untuk mengganti cairan dan elektrolit yang hilang</li>
                    <li><strong>Tetap berikan ASI:</strong> Jika masih menyusui</li>
                    <li><strong>Berikan makanan lunak:</strong> Bubur, pisang, roti tawar</li>
                    <li><strong>Hindari:</strong> Susu sapi, makanan pedas, minuman berkafein</li>
                </ul>
                
                <h4>Kapan Harus ke Dokter</h4>
                <p>Segera bawa anak ke fasilitas kesehatan jika:</p>
                <ul>
                    <li>Diare tidak membaik setelah 2 hari</li>
                    <li>Anak menunjukkan tanda dehidrasi berat</li>
                    <li>Demam tinggi (>38°C)</li>
                    <li>BAB berdarah</li>
                    <li>Anak tampak sangat lemas</li>
                </ul>',
                'author' => 'Dr. Rina Sari',
                'image' => 'img05.jpg',
                'status' => 'published',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'title' => 'Manfaat ASI Eksklusif untuk Bayi dan Ibu',
                'content' => '<h3>ASI Eksklusif: Nutrisi Terbaik untuk Bayi</h3>
                <p>ASI (Air Susu Ibu) eksklusif adalah pemberian ASI saja kepada bayi sejak lahir hingga usia 6 bulan tanpa tambahan makanan atau minuman lain, kecuali obat-obatan dan vitamin.</p>
                
                <h4>Manfaat ASI untuk Bayi</h4>
                <ul>
                    <li><strong>Nutrisi Lengkap:</strong> ASI mengandung semua nutrisi yang dibutuhkan bayi dalam 6 bulan pertama</li>
                    <li><strong>Mudah Dicerna:</strong> Protein dalam ASI lebih mudah dicerna dibanding susu formula</li>
                    <li><strong>Meningkatkan Imunitas:</strong> Mengandung antibodi yang melindungi dari infeksi</li>
                    <li><strong>Mencegah Alergi:</strong> Menurunkan risiko alergi makanan dan asma</li>
                    <li><strong>Perkembangan Otak:</strong> DHA dan ARA penting untuk perkembangan otak</li>
                    <li><strong>Mencegah Obesitas:</strong> Bayi ASI cenderung memiliki berat badan ideal</li>
                </ul>
                
                <h4>Manfaat ASI untuk Ibu</h4>
                <ul>
                    <li><strong>Pemulihan Pasca Melahirkan:</strong> Membantu rahim kembali ke ukuran normal</li>
                    <li><strong>Menurunkan Berat Badan:</strong> Membakar kalori ekstra</li>
                    <li><strong>Kontrasepsi Alami:</strong> Menunda ovulasi (LAM - Lactational Amenorrhea Method)</li>
                    <li><strong>Menurunkan Risiko Kanker:</strong> Kanker payudara dan ovarium</li>
                    <li><strong>Ekonomis:</strong> Menghemat biaya susu formula</li>
                    <li><strong>Bonding:</strong> Memperkuat ikatan emosional ibu dan bayi</li>
                </ul>
                
                <h4>Tips Sukses Menyusui</h4>
                <ol>
                    <li><strong>Inisiasi Menyusu Dini (IMD):</strong> Dalam 1 jam setelah lahir</li>
                    <li><strong>Posisi yang Benar:</strong> Pastikan bayi menempel dengan baik ke payudara</li>
                    <li><strong>Frekuensi Menyusui:</strong> Sesering mungkin, minimal 8-12 kali sehari</li>
                    <li><strong>Nutrisi Ibu:</strong> Konsumsi makanan bergizi dan minum air yang cukup</li>
                    <li><strong>Istirahat Cukup:</strong> Tidur saat bayi tidur</li>
                    <li><strong>Dukungan Keluarga:</strong> Peran suami dan keluarga sangat penting</li>
                </ol>
                
                <h4>Tanda Bayi Cukup ASI</h4>
                <ul>
                    <li>Berat badan naik sesuai kurva pertumbuhan</li>
                    <li>BAK minimal 6 kali sehari dengan warna urin jernih</li>
                    <li>Bayi tampak puas setelah menyusu</li>
                    <li>Tidur nyenyak di antara waktu menyusu</li>
                    <li>Responsif dan aktif saat bangun</li>
                </ul>
                
                <h4>Mengatasi Kendala Menyusui</h4>
                <ul>
                    <li><strong>Puting Lecet:</strong> Perbaiki posisi menyusui, gunakan salep lanolin</li>
                    <li><strong>Payudara Bengkak:</strong> Kompres dingin, sering menyusui</li>
                    <li><strong>ASI Sedikit:</strong> Tingkatkan frekuensi menyusui, makan bergizi</li>
                    <li><strong>Mastitis:</strong> Kompres hangat, tetap menyusui, konsultasi dokter</li>
                </ul>',
                'author' => 'Bidan Dewi Kartika',
                'image' => 'img06.jpg',
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Draft: Persiapan Program Posyandu Tahun 2026',
                'content' => '<p>Artikel ini masih dalam tahap perencanaan dan akan membahas program-program Posyandu untuk tahun 2026, termasuk inovasi pelayanan dan peningkatan fasilitas.</p>
                <h4>Rencana Program:</h4>
                <ul>
                    <li>Digitalisasi pencatatan kesehatan</li>
                    <li>Pelatihan kader posyandu</li>
                    <li>Perbaikan fasilitas</li>
                    <li>Program gizi lanjutan</li>
                </ul>',
                'author' => 'Tim Admin Posyandu',
                'image' => 'img07.jpg',
                'status' => 'draft',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($articles as $article) {
            // Copy gambar dari public ke storage
            $sourceFile = $sourceDir . '/' . $article['image'];
            $destFile = $destDir . '/' . $article['image'];
            
            if (File::exists($sourceFile)) {
                File::copy($sourceFile, $destFile);
                // Update path untuk database
                $article['image'] = 'articles/' . $article['image'];
            } else {
                // Jika file tidak ada, hilangkan image
                unset($article['image']);
            }
            
            Article::create($article);
        }
        
        echo "✅ Created " . count($articles) . " articles with images\n";
        echo "📁 Images copied to storage/app/public/articles/\n";
    }
}
