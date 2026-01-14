<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 0. BUAT USER ADMIN
        // Cek dulu biar gak error duplicate
        if (User::where('email', 'admin@gmail.com')->doesntExist()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'),
                'is_admin' => true,
            ]);
        }

        // 1. BUAT KATEGORI
        $cats = [
            'sarapan' => Category::firstOrCreate(['slug' => 'sarapan'], ['name' => 'Sarapan']),
            'dessert' => Category::firstOrCreate(['slug' => 'dessert'], ['name' => 'Dessert']),
            'minuman' => Category::firstOrCreate(['slug' => 'minuman'], ['name' => 'Minuman']),
            'sehat'   => Category::firstOrCreate(['slug' => 'sehat'], ['name' => 'Sehat']),
            'asian'   => Category::firstOrCreate(['slug' => 'asian'], ['name' => 'Asian']),
            'review'  => Category::firstOrCreate(['slug' => 'review-makanan'], ['name' => 'Review Makanan']),
        ];

        // 2. DATA 50 RESEP UNIK
        // Kita petakan resep baru ke gambar yang sudah ada (nasi-goreng.jpg, rendang.jpg, dll)
        $recipes = [
            // --- KELOMPOK 1: NASI (Pakai nasi-goreng.jpg) ---
            [
                'name' => 'Nasi Goreng Spesial', 'cat' => 'sarapan', 'img' => 'nasi-goreng.jpg', 'vid' => 'q9X1-i4h8kw',
                'desc' => 'Nasi goreng kampung klasik dengan topping telur mata sapi.',
                'ing' => ['Nasi Putih', 'Bawang Merah & Putih', 'Kecap Manis', 'Telur', 'Cabai'],
                'step' => ['Tumis bumbu halus.', 'Masukkan nasi dan kecap.', 'Aduk rata hingga harum.', 'Sajikan dengan telur.']
            ],
            [
                'name' => 'Nasi Uduk Betawi', 'cat' => 'sarapan', 'img' => 'nasi-goreng.jpg', 'vid' => 'ylG2c5_tCco',
                'desc' => 'Nasi gurih dimasak dengan santan dan rempah, disajikan dengan semur tahu.',
                'ing' => ['Beras', 'Santan', 'Daun Salam', 'Serai', 'Bawang Goreng'],
                'step' => ['Masak beras dengan santan dan rempah di rice cooker.', 'Aduk saat setengah matang.', 'Sajikan dengan pelengkap.']
            ],
            [
                'name' => 'Nasi Kuning Tumpeng', 'cat' => 'sarapan', 'img' => 'nasi-goreng.jpg', 'vid' => 'Pj_t3aJqOqU',
                'desc' => 'Nasi kuning wangi kunyit dan pandan, cocok untuk perayaan.',
                'ing' => ['Beras', 'Kunyit Parut', 'Santan', 'Daun Pandan', 'Jeruk Nipis'],
                'step' => ['Campur santan dengan air kunyit.', 'Masak beras dengan larutan santan kuning.', 'Kukus hingga matang pulen.']
            ],
            [
                'name' => 'Nasi Liwet Sunda', 'cat' => 'asian', 'img' => 'nasi-goreng.jpg', 'vid' => 'Xy8W_P1qM2k',
                'desc' => 'Nasi liwet dimasak dalam kastrol dengan ikan teri dan pete.',
                'ing' => ['Beras', 'Ikan Teri Medan', 'Pete', 'Cabai Rawit Utuh', 'Bawang Merah Utuh'],
                'step' => ['Tumis teri dan bawang sebentar.', 'Masukkan beras dan air ke panci liwet.', 'Masak api kecil hingga air surut.', 'Masukkan pete dan cabai, tanak sebentar.']
            ],
            [
                'name' => 'Nasi Gila Jakarta', 'cat' => 'asian', 'img' => 'nasi-goreng.jpg', 'vid' => 'M7_s1k3jL4o',
                'desc' => 'Nasi putih dengan topping tumisan sosis, bakso, dan telur yang pedas gila.',
                'ing' => ['Nasi Putih', 'Sosis & Bakso', 'Telur', 'Saus Sambal', 'Kecap Inggris'],
                'step' => ['Tumis sosis dan bakso.', 'Masukkan telur orak-arik.', 'Beri saus sambal dan kecap.', 'Siram di atas nasi panas.']
            ],

            // --- KELOMPOK 2: DAGING SAPI (Pakai rendang.jpg) ---
            [
                'name' => 'Rendang Daging Sapi', 'cat' => 'asian', 'img' => 'rendang.jpg', 'vid' => 'DMcFqtm1lfY',
                'desc' => 'Masakan terlezat dunia, daging sapi dimasak lama dengan santan.',
                'ing' => ['Daging Sapi', 'Santan Kental', 'Dedak Rendang', 'Daun Kunyit', 'Cabai Giling'],
                'step' => ['Masak santan dan bumbu hingga berminyak.', 'Masukkan daging.', 'Masak api kecil 4 jam hingga kering hitam.']
            ],
            [
                'name' => 'Semur Daging Betawi', 'cat' => 'asian', 'img' => 'rendang.jpg', 'vid' => 'Hu4R_S5qK3s',
                'desc' => 'Daging sapi empuk dengan kuah kecap manis yang pekat dan berempah.',
                'ing' => ['Daging Sapi', 'Kecap Manis', 'Pala Bubuk', 'Cengkeh', 'Kayu Manis'],
                'step' => ['Tumis bumbu halus.', 'Masukkan daging hingga berubah warna.', 'Tuang air dan kecap.', 'Masak hingga kuah mengental.']
            ],
            [
                'name' => 'Empal Gentong Cirebon', 'cat' => 'asian', 'img' => 'rendang.jpg', 'vid' => 'Ty8k2_F1m4o',
                'desc' => 'Sup daging santan kuning yang dimasak dalam gentong tanah liat.',
                'ing' => ['Daging & Jeroan Sapi', 'Santan', 'Kunyit', 'Kucai', 'Cabai Bubuk'],
                'step' => ['Rebus daging hingga empuk.', 'Tumis bumbu kuning, masukkan ke kuah kaldu.', 'Tuang santan, aduk rata.', 'Sajikan dengan kucai.']
            ],
            [
                'name' => 'Dendeng Balado Padang', 'cat' => 'asian', 'img' => 'rendang.jpg', 'vid' => 'Rp5_q6_k12s',
                'desc' => 'Daging sapi iris tipis digoreng kering lalu disiram sambal merah kasar.',
                'ing' => ['Daging Sapi Iris', 'Cabai Merah Besar', 'Bawang Merah', 'Jeruk Nipis', 'Minyak'],
                'step' => ['Rebus daging lalu pipihkan dan goreng kering.', 'Tumis cabai merah kasar.', 'Beri perasan jeruk nipis.', 'Siram sambal ke daging.']
            ],
            [
                'name' => 'Gulai Cincang', 'cat' => 'asian', 'img' => 'rendang.jpg', 'vid' => 'Xq1_r3_k98s',
                'desc' => 'Daging tetelan berlemak dimasak gulai kental pedas ala Kapau.',
                'ing' => ['Tetelan Sapi', 'Santan', 'Bumbu Gulai Padang', 'Asam Kandis', 'Daun Ruku-ruku'],
                'step' => ['Tumis bumbu gulai hingga harum.', 'Masukkan tetelan, aduk rata.', 'Tuang santan, masak hingga daging empuk dan berminyak.']
            ],

            // --- KELOMPOK 3: SATE/AYAM (Pakai sate-ayam.jpg) ---
            [
                'name' => 'Sate Ayam Madura', 'cat' => 'asian', 'img' => 'sate-ayam.jpg', 'vid' => 'Vh__EYZzPwg',
                'desc' => 'Sate ayam dengan bumbu kacang kental dan kecap manis.',
                'ing' => ['Dada Ayam', 'Kacang Tanah', 'Kecap Manis', 'Jeruk Limau', 'Tusuk Sate'],
                'step' => ['Tusuk ayam, bakar setengah matang.', 'Celup bumbu kacang, bakar lagi hingga matang.', 'Sajikan dengan lontong.']
            ],
            [
                'name' => 'Sate Taichan Senayan', 'cat' => 'asian', 'img' => 'sate-ayam.jpg', 'vid' => 'Wk1_d8_j45k',
                'desc' => 'Sate ayam putih polos dengan sambal rawit super pedas dan jeruk nipis.',
                'ing' => ['Dada Ayam', 'Bawang Putih', 'Jeruk Nipis', 'Cabai Rawit Setan', 'Garam'],
                'step' => ['Marinasi ayam dengan bawang putih dan jeruk.', 'Bakar hingga matang putih.', 'Ulek sambal rawit mentah.', 'Sajikan.']
            ],
            [
                'name' => 'Sate Padang', 'cat' => 'asian', 'img' => 'sate-ayam.jpg', 'vid' => 'Po9_f7_h23k',
                'desc' => 'Sate lidah sapi dengan kuah kental kuning berempah jinten.',
                'ing' => ['Lidah Sapi', 'Tepung Beras (pengental)', 'Kunyit', 'Jinten', 'Ketumbar'],
                'step' => ['Rebus lidah dengan bumbu kuning.', 'Bakar sebentar.', 'Sisa kuah rebusan dikentalkan dengan tepung beras untuk saus.']
            ],
            [
                'name' => 'Ayam Bakar Taliwang', 'cat' => 'asian', 'img' => 'sate-ayam.jpg', 'vid' => 'Lk2_s9_d11s',
                'desc' => 'Ayam bakar pedas khas Lombok dengan aroma terasi bakar.',
                'ing' => ['Ayam Kampung Muda', 'Cabai Merah', 'Terasi Lombok', 'Kencur', 'Gula Merah'],
                'step' => ['Tumis bumbu halus super pedas.', 'Ungkep ayam dengan bumbu.', 'Bakar ayam sambil dioles sisa bumbu.']
            ],
            [
                'name' => 'Ayam Betutu Bali', 'cat' => 'asian', 'img' => 'sate-ayam.jpg', 'vid' => 'Mn5_a6_f22d',
                'desc' => 'Ayam utuh yang dibalur bumbu base genep khas Bali lalu dipanggang.',
                'ing' => ['Ayam Utuh', 'Bawang Merah & Putih', 'Cabai', 'Kencur', 'Minyak Kelapa'],
                'step' => ['Cincang kasar semua bumbu (base genep).', 'Balurkan ke seluruh ayam.', 'Bungkus daun pisang, kukus/panggang 3 jam.']
            ],

            // --- KELOMPOK 4: SOTO/SUP (Pakai soto-betawi.jpg) ---
            [
                'name' => 'Soto Betawi Asli', 'cat' => 'asian', 'img' => 'soto-betawi.jpg', 'vid' => 'siSG_AqdMn0',
                'desc' => 'Soto kuah susu dan minyak samin yang gurih creamy.',
                'ing' => ['Daging Sapi', 'Susu Cair', 'Minyak Samin', 'Kentang', 'Emping'],
                'step' => ['Rebus daging.', 'Tumis bumbu, masukkan ke kuah.', 'Tuang susu cair.', 'Sajikan dengan emping.']
            ],
            [
                'name' => 'Soto Ayam Lamongan', 'cat' => 'asian', 'img' => 'soto-betawi.jpg', 'vid' => 'Qr1_t2_y44k',
                'desc' => 'Soto ayam kuah kuning bening dengan taburan koya udang.',
                'ing' => ['Ayam Kampung', 'Kunyit', 'Kerupuk Udang (Koya)', 'Soun', 'Kol'],
                'step' => ['Rebus ayam dengan bumbu kuning.', 'Goreng kerupuk udang dan bawang putih, haluskan jadi Koya.', 'Sajikan soto dengan taburan koya.']
            ],
            [
                'name' => 'Rawon Surabaya', 'cat' => 'asian', 'img' => 'soto-betawi.jpg', 'vid' => 'Zp3_r8_u11s',
                'desc' => 'Sup daging sapi kuah hitam pekat dari buah kluwek.',
                'ing' => ['Daging Rawon', 'Kluwek (rendam air panas)', 'Tauge Pendek', 'Telur Asin', 'Kerupuk Udang'],
                'step' => ['Tumis bumbu halus dan kluwek.', 'Masukkan daging dan air.', 'Masak hingga daging empuk.', 'Sajikan dengan tauge pendek.']
            ],
            [
                'name' => 'Sop Buntut Borobudur', 'cat' => 'asian', 'img' => 'soto-betawi.jpg', 'vid' => 'Wm2_q9_p55l',
                'desc' => 'Sop buntut sapi bening dengan wortel dan kentang yang segar.',
                'ing' => ['Buntut Sapi', 'Wortel', 'Kentang', 'Pala', 'Daun Seledri'],
                'step' => ['Presto buntut hingga empuk.', 'Masukkan sayuran ke kuah kaldu.', 'Beri garam, merica, pala.', 'Taburi seledri.']
            ],
            [
                'name' => 'Sayur Asem Jakarta', 'cat' => 'sehat', 'img' => 'soto-betawi.jpg', 'vid' => 'Nn1_o2_m33p',
                'desc' => 'Sayur kuah asam segar dengan jagung, melinjo, dan kacang tanah.',
                'ing' => ['Jagung Manis', 'Labu Siam', 'Kacang Panjang', 'Melinjo', 'Asam Jawa'],
                'step' => ['Rebus air dengan bumbu halus dan asam jawa.', 'Masukkan sayuran keras (jagung) dulu.', 'Masukkan sayuran lunak daun melinjo.']
            ],

            // --- KELOMPOK 5: SAYURAN (Pakai gado-gado.jpg) ---
            [
                'name' => 'Gado-gado Jakarta', 'cat' => 'sehat', 'img' => 'gado-gado.jpg', 'vid' => 'NfkSkV-SatE',
                'desc' => 'Salad sayur dengan bumbu kacang ulek dadakan.',
                'ing' => ['Kangkung', 'Tauge', 'Tahu Tempe', 'Bumbu Kacang', 'Kerupuk'],
                'step' => ['Rebus sayuran.', 'Ulek kacang, cabai, gula merah.', 'Aduk sayuran dengan bumbu.']
            ],
            [
                'name' => 'Karedok Sunda', 'cat' => 'sehat', 'img' => 'gado-gado.jpg', 'vid' => 'Bk4_l8_k99o',
                'desc' => 'Sayuran mentah segar dengan bumbu kencur kacang yang wangi.',
                'ing' => ['Kacang Panjang Mentah', 'Kol Mentah', 'Kemangi', 'Kencur', 'Kacang Tanah'],
                'step' => ['Cuci bersih semua sayuran mentah.', 'Ulek bumbu kacang dengan kencur kuat.', 'Aduk rata sayuran mentah dengan bumbu.']
            ],
            [
                'name' => 'Pecel Madiun', 'cat' => 'sehat', 'img' => 'gado-gado.jpg', 'vid' => 'Vj5_h7_g66t',
                'desc' => 'Sayuran rebus disiram sambal pecel yang pedas manis dan rempeyek.',
                'ing' => ['Bayam', 'Kembang Turi', 'Sambal Pecel Instan', 'Rempeyek Kacang', 'Nasi'],
                'step' => ['Rebus sayuran.', 'Seduh bumbu pecel dengan air panas.', 'Siram ke atas sayuran.', 'Sajikan dengan rempeyek.']
            ],
            [
                'name' => 'Ketoprak Cirebon', 'cat' => 'sarapan', 'img' => 'gado-gado.jpg', 'vid' => 'Lm9_n2_b44r',
                'desc' => 'Tahu goreng, bihun, dan ketupat dengan bumbu bawang putih yang kuat.',
                'ing' => ['Tahu Putih Goreng', 'Bihun', 'Ketupat', 'Bawang Putih', 'Tauge'],
                'step' => ['Ulek bawang putih, cabai, dan kacang di piring.', 'Beri sedikit air.', 'Masukkan potongan ketupat, tahu, bihun.', 'Beri kecap manis.']
            ],
            [
                'name' => 'Lotek Bandung', 'cat' => 'sehat', 'img' => 'gado-gado.jpg', 'vid' => 'Xz1_p3_o22q',
                'desc' => 'Mirip gado-gado tapi bumbunya menggunakan kentang rebus agar creamy.',
                'ing' => ['Bayam', 'Labu Siam', 'Kentang Rebus (untuk bumbu)', 'Kencur', 'Kerupuk'],
                'step' => ['Ulek kentang rebus bersama bumbu kacang.', 'Masukkan sayuran rebus.', 'Aduk rata hingga bumbu menyelimuti sayur.']
            ],

            // --- KELOMPOK 6: MINUMAN DINGIN (Pakai es-cendol.jpg) ---
            [
                'name' => 'Es Cendol Dawet', 'cat' => 'minuman', 'img' => 'es-cendol.jpg', 'vid' => 'N50Vo9hEhSY',
                'desc' => 'Minuman santan gula merah dengan butiran tepung beras hijau.',
                'ing' => ['Cendol Hijau', 'Santan', 'Gula Merah Cair', 'Es Batu', 'Nangka'],
                'step' => ['Masak santan dengan pandan.', 'Cairkan gula merah.', 'Susun di gelas: Gula, Cendol, Santan, Es.']
            ],
            [
                'name' => 'Es Teler 77', 'cat' => 'minuman', 'img' => 'es-cendol.jpg', 'vid' => 'Po5_k2_j88h',
                'desc' => 'Koktail buah asli Indonesia dengan alpukat, kelapa muda, dan nangka.',
                'ing' => ['Alpukat', 'Kelapa Muda', 'Nangka', 'Susu Kental Manis', 'Es Serut'],
                'step' => ['Kerok alpukat dan kelapa.', 'Potong nangka.', 'Taruh di mangkuk, beri es serut dan susu kental manis melimpah.']
            ],
            [
                'name' => 'Es Pisang Ijo', 'cat' => 'dessert', 'img' => 'es-cendol.jpg', 'vid' => 'Mn3_b4_v55c',
                'desc' => 'Pisang dibalut adonan tepung hijau, disajikan dengan bubur sumsum.',
                'ing' => ['Pisang Raja', 'Tepung Beras', 'Sirup DHT (Merah)', 'Bubur Sumsum', 'Es Batu'],
                'step' => ['Balut pisang dengan adonan hijau, kukus.', 'Buat bubur sumsum.', 'Potong pisang, sajikan dengan bubur, es, dan sirup merah.']
            ],
            [
                'name' => 'Es Doger Bandung', 'cat' => 'minuman', 'img' => 'es-cendol.jpg', 'vid' => 'Lq2_w1_e33x',
                'desc' => 'Es santan beku warna pink dengan tape ketan dan roti tawar.',
                'ing' => ['Santan Pink Beku', 'Tape Ketan Hitam', 'Tape Singkong', 'Roti Tawar', 'Susu'],
                'step' => ['Serut es santan beku.', 'Masukkan tape dan roti ke gelas.', 'Tutup dengan es serut pink dan susu.']
            ],
            [
                'name' => 'Es Oyen Surabaya', 'cat' => 'minuman', 'img' => 'es-cendol.jpg', 'vid' => 'Za1_q2_w33s',
                'desc' => 'Mirip es campur tapi khas dengan pacar cina dan durian.',
                'ing' => ['Pacar Cina', 'Alpukat', 'Kelapa', 'Durian (Opsional)', 'Sirup Gula'],
                'step' => ['Rebus pacar cina.', 'Susun semua buah di mangkuk.', 'Beri es batu dan sirup gula simple.']
            ],

            // --- KELOMPOK 7: MARTABAK/DESSERT (Pakai martabak.jpg) ---
            [
                'name' => 'Martabak Manis', 'cat' => 'dessert', 'img' => 'martabak.jpg', 'vid' => 'Ui7lXa4uqI0',
                'desc' => 'Terang bulan tebal bersarang dengan topping coklat keju.',
                'ing' => ['Tepung Terigu', 'Telur', 'Soda Kue', 'Gula', 'Margarin'],
                'step' => ['Kocok adonan hingga berbuih.', 'Tuang ke teflon panas.', 'Taburi gula saat berlubang.', 'Oles mentega dan topping.']
            ],
            [
                'name' => 'Martabak Telur', 'cat' => 'asian', 'img' => 'martabak.jpg', 'vid' => 'Op2_l3_k44j',
                'desc' => 'Martabak asin renyah berisi daging cincang dan daun bawang.',
                'ing' => ['Kulit Lumpia/Martabak', 'Telur Bebek', 'Daging Cincang', 'Daun Bawang', 'Bawang Bombay'],
                'step' => ['Kocok telur, daging, daun bawang.', 'Lebarkan kulit di wajan.', 'Tuang isian, lipat amplop.', 'Goreng hingga crispy.']
            ],
            [
                'name' => 'Kue Cubit Lumer', 'cat' => 'dessert', 'img' => 'martabak.jpg', 'vid' => 'Mn4_b5_v66c',
                'desc' => 'Jajanan sekolah setengah matang yang lumer di mulut.',
                'ing' => ['Tepung Terigu', 'Telur', 'Gula', 'Susu Cair', 'Meises'],
                'step' => ['Campur adonan seperti pancake.', 'Tuang ke cetakan kue cubit.', 'Masak sebentar (jangan sampai kering atasnya).', 'Angkat.']
            ],
            [
                'name' => 'Serabi Solo', 'cat' => 'dessert', 'img' => 'martabak.jpg', 'vid' => 'Xy5_z6_a77q',
                'desc' => 'Serabi tipis renyah di pinggir, lembut di tengah, digulung daun pisang.',
                'ing' => ['Tepung Beras', 'Santan Kental', 'Gula', 'Ragi', 'Pandan'],
                'step' => ['Masak adonan di wajan kecil tanah liat.', 'Tekan tengahnya agar pinggiran krispi.', 'Beri santan kental (areh) di tengah.', 'Gulung.']
            ],
            [
                'name' => 'Roti Bakar Bandung', 'cat' => 'dessert', 'img' => 'martabak.jpg', 'vid' => 'Qw3_e4_r55t',
                'desc' => 'Roti kasino tebal dibakar arang dengan isian selai srikaya.',
                'ing' => ['Roti Kasino', 'Margarin', 'Selai Srikaya', 'Keju', 'Susu'],
                'step' => ['Belah roti, oles margarin.', 'Isi dengan selai.', 'Bakar di atas wajan datar hingga kecoklatan.']
            ],

            // --- KELOMPOK 8: JAJANAN PASAR (Pakai klepon.jpg) ---
            [
                'name' => 'Klepon Gula Merah', 'cat' => 'dessert', 'img' => 'klepon.jpg', 'vid' => 'MDMceqLPMVs',
                'desc' => 'Bola ketan pandan isi gula merah cair tabur kelapa.',
                'ing' => ['Tepung Ketan', 'Pandan', 'Gula Merah', 'Kelapa Parut'],
                'step' => ['Isi adonan dengan gula merah.', 'Rebus di air mendidih hingga mengapung.', 'Gulingkan di kelapa.']
            ],
            [
                'name' => 'Onde-onde Wijen', 'cat' => 'dessert', 'img' => 'klepon.jpg', 'vid' => 'Za2_x3_c44v',
                'desc' => 'Bola goreng tepung ketan berlapis wijen isi kacang hijau.',
                'ing' => ['Tepung Ketan', 'Wijen', 'Pasta Kacang Hijau', 'Gula', 'Minyak'],
                'step' => ['Isi adonan kulit dengan kacang hijau.', 'Celup air, gulingkan di wijen.', 'Goreng api kecil agar tidak meledak.']
            ],
            [
                'name' => 'Dadar Gulung', 'cat' => 'dessert', 'img' => 'klepon.jpg', 'vid' => 'Sd4_f5_g66b',
                'desc' => 'Pancake tipis hijau pandan berisi unti kelapa gula merah.',
                'ing' => ['Tepung Terigu', 'Santan', 'Pandan', 'Kelapa Parut', 'Gula Merah'],
                'step' => ['Buat dadar tipis di teflon.', 'Masak kelapa dengan gula merah (unti).', 'Isi dadar dengan unti, lipat gulung.']
            ],
            [
                'name' => 'Putu Ayu', 'cat' => 'dessert', 'img' => 'klepon.jpg', 'vid' => 'Nh7_j8_k99m',
                'desc' => 'Kue bolu kukus pandan dengan topping kelapa parut gurih.',
                'ing' => ['Tepung Terigu', 'Telur', 'SP (Emulsifier)', 'Pandan', 'Kelapa Parut'],
                'step' => ['Padatkan kelapa di dasar cetakan.', 'Tuang adonan bolu pandan di atasnya.', 'Kukus 15 menit.']
            ],
            [
                'name' => 'Lapis Legit', 'cat' => 'dessert', 'img' => 'klepon.jpg', 'vid' => 'Bg6_h7_j88n',
                'desc' => 'Kue lapis premium dengan ribuan lapisan dan aroma butter spekuk.',
                'ing' => ['Kuning Telur (Banyak)', 'Butter', 'Susu Kental Manis', 'Bumbu Spekuk', 'Tepung'],
                'step' => ['Kocok kuning telur dan butter terpisah.', 'Panggang selapis demi selapis dengan api atas.', 'Butuh kesabaran ekstra!']
            ],

            // --- KELOMPOK 9: JUS/MINUMAN SEHAT (Pakai jus-alpukat.jpg) ---
            [
                'name' => 'Jus Alpukat Kocok', 'cat' => 'minuman', 'img' => 'jus-alpukat.jpg', 'vid' => 'D-gtiTbMjxA',
                'desc' => 'Jus alpukat viral dengan topping milo dan susu coklat.',
                'ing' => ['Alpukat Mentega', 'Susu Coklat', 'Bubuk Milo', 'Es Batu', 'Gula'],
                'step' => ['Hancurkan alpukat kasar (jangan blender halus).', 'Beri es batu.', 'Tuang susu coklat dan tabur milo.']
            ],
            [
                'name' => 'Jus Mangga Thai', 'cat' => 'minuman', 'img' => 'jus-alpukat.jpg', 'vid' => 'Vf4_d3_s22a',
                'desc' => 'Smoothie mangga kental dengan whipped cream dan potongan mangga.',
                'ing' => ['Mangga Harum Manis', 'Whipped Cream', 'Yoghurt', 'Es Batu'],
                'step' => ['Blender mangga dan es hingga jadi smoothie.', 'Semprot whipped cream.', 'Beri potongan dadu mangga di atasnya.']
            ],
            [
                'name' => 'Es Kelapa Jeruk', 'cat' => 'minuman', 'img' => 'jus-alpukat.jpg', 'vid' => 'Cd3_f4_v55b',
                'desc' => 'Kesegaran air kelapa muda dicampur perasan jeruk murni.',
                'ing' => ['Kelapa Muda (Air & Daging)', 'Jeruk Peras (Pontianak/Medan)', 'Es Batu', 'Sirup Gula'],
                'step' => ['Kerok daging kelapa.', 'Peras jeruk.', 'Campur air kelapa, air jeruk, dan gula.', 'Sajikan dingin.']
            ],
            [
                'name' => 'Wedang Jahe', 'cat' => 'sehat', 'img' => 'jus-alpukat.jpg', 'vid' => 'Nh1_j2_k33l',
                'desc' => 'Minuman hangat sari jahe bakar untuk tolak angin.',
                'ing' => ['Jahe Emprit (Bakar)', 'Gula Merah', 'Serai', 'Kayu Manis', 'Air Panas'],
                'step' => ['Bakar jahe lalu geprek.', 'Rebus dengan gula merah dan rempah lain hingga mendidih.', 'Saring dan minum hangat.']
            ],
            [
                'name' => 'Jamu Kunyit Asam', 'cat' => 'sehat', 'img' => 'jus-alpukat.jpg', 'vid' => 'Mj5_k6_l77p',
                'desc' => 'Minuman herbal tradisional pelancar haid dan penyegar badan.',
                'ing' => ['Kunyit Biang', 'Asam Jawa', 'Gula Merah', 'Air', 'Sedikit Garam'],
                'step' => ['Parut kunyit, peras airnya.', 'Rebus air kunyit dengan asam jawa dan gula.', 'Saring dan dinginkan (bisa diminum dingin).']
            ],

            // --- KELOMPOK 10: CAPCAY/CHINESE FOOD (Pakai capcay.jpg) ---
            [
                'name' => 'Capcay Kuah Segar', 'cat' => 'sehat', 'img' => 'capcay.jpg', 'vid' => 'XeagIcUepgI',
                'desc' => 'Tumis 10 jenis sayuran dengan kuah kaldu kental.',
                'ing' => ['Wortel, Sawi, Brokoli', 'Bakso & Ayam', 'Bawang Putih', 'Saus Tiram', 'Maizena'],
                'step' => ['Tumis bawang putih dan ayam.', 'Masukkan sayuran keras dulu.', 'Beri air dan bumbu.', 'Kentalkan dengan maizena.']
            ],
            [
                'name' => 'Mie Goreng Jawa', 'cat' => 'asian', 'img' => 'capcay.jpg', 'vid' => 'Za3_x4_c55v',
                'desc' => 'Mie goreng nyemek manis gurih dimasak dengan anglo arang.',
                'ing' => ['Mie Telur', 'Kecap Manis', 'Kemiri', 'Telur Bebek', 'Ayam Suwir'],
                'step' => ['Tumis bumbu halus kemiri.', 'Masukkan telur dan mie.', 'Beri kecap manis agak banyak agar basah (nyemek).']
            ],
            [
                'name' => 'Kwetiau Siram Sapi', 'cat' => 'asian', 'img' => 'capcay.jpg', 'vid' => 'Sd5_f6_g77b',
                'desc' => 'Kwetiau lebar disiram kuah kental berisi daging sapi dan sawi.',
                'ing' => ['Kwetiau Basah', 'Daging Sapi Has', 'Telur Kocok', 'Maizena', 'Minyak Wijen'],
                'step' => ['Tumis kwetiau polos sebentar.', 'Buat kuah: tumis daging, beri air, kentalkan dengan maizena dan telur kocok.', 'Siram ke kwetiau.']
            ],
            [
                'name' => 'Fuyunghai Asam Manis', 'cat' => 'asian', 'img' => 'capcay.jpg', 'vid' => 'Nh8_j9_k00m',
                'desc' => 'Telur dadar tebal isi kepiting/ayam disiram saus merah kacang polong.',
                'ing' => ['Telur Bebek', 'Daging Kepiting/Ayam', 'Kol Iris', 'Saus Tomat', 'Kacang Polong'],
                'step' => ['Kocok telur dengan isian, goreng deep fry agar tebal.', 'Masak saus asam manis.', 'Siram saus ke atas telur.']
            ],
            [
                'name' => 'Ayam Koloke', 'cat' => 'asian', 'img' => 'capcay.jpg', 'vid' => 'Bg7_h8_j99n',
                'desc' => 'Ayam goreng tepung crispy disiram saus asam manis nanas.',
                'ing' => ['Ayam Fillet Tepung', 'Nanas', 'Paprika', 'Saus Tomat', 'Cuka'],
                'step' => ['Goreng ayam tepung hingga krispi.', 'Tumis nanas dan paprika dengan saus asam manis.', 'Aduk ayam dengan saus sebentar saja.']
            ],
        ];

        // 3. EKSEKUSI LOOPING
        foreach ($recipes as $data) {
            
            // Generate List Bahan (HTML)
            $ingList = '';
            foreach ($data['ing'] as $ing) {
                $ingList .= '<li class="flex items-start"><i class="ri-checkbox-circle-line text-primary mt-1 mr-2 flex-shrink-0"></i> <span>' . $ing . '</span></li>';
            }

            // Generate List Langkah (HTML)
            $stepList = '';
            foreach ($data['step'] as $idx => $step) {
                $num = $idx + 1;
                $stepList .= '
                <div class="relative pl-10 pb-6 border-l-2 border-primary/20 last:border-0">
                    <span class="absolute -left-[9px] top-0 w-5 h-5 bg-primary text-white text-xs font-bold flex items-center justify-center rounded-full">'.$num.'</span>
                    <h4 class="font-bold text-gray-900 mb-1 leading-none mt-0.5">Langkah '.$num.'</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">'.$step.'</p>
                </div>';
            }

            // Susun Konten HTML Lengkap
            $htmlContent = '
            <div class="mb-8">
                <p class="mb-8 text-lg text-gray-700 leading-relaxed font-light">'. $data['desc'] .'</p>
                <div class="grid md:grid-cols-2 gap-12">
                    <div class="bg-primary/5 p-6 rounded-xl h-fit">
                        <h3 class="text-2xl font-serif font-bold text-gray-900 mb-6 flex items-center"><i class="ri-basket-line mr-2"></i> Bahan-bahan</h3>
                        <ul class="space-y-4 text-gray-700">' . $ingList . '</ul>
                    </div>
                    <div>
                        <h3 class="text-2xl font-serif font-bold text-gray-900 mb-6 flex items-center"><i class="ri-fire-line mr-2"></i> Cara Membuat</h3>
                        <div class="space-y-2">' . $stepList . '</div>
                    </div>
                </div>
            </div>';

            // Simpan ke Database
            Recipe::create([
                'category_id' => $cats[$data['cat']]->id,
                'title'       => $data['name'],
                'slug'        => Str::slug($data['name']) . '-' . Str::random(5),
                'image'       => 'images/' . $data['img'], // Panggil gambar lokal yg sudah ada
                'video_url'   => $data['vid'],
                'description' => $data['desc'],
                'content'     => $htmlContent
            ]);
        }
    }
}