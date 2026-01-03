<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('is_admin', true)->first();
        
        // Get or create categories
        $pendidikan = Category::firstOrCreate(
            ['slug' => 'pendidikan'],
            ['name' => 'Pendidikan', 'description' => 'Berita seputar pendidikan']
        );
        
        $keagamaan = Category::firstOrCreate(
            ['slug' => 'keagamaan'],
            ['name' => 'Keagamaan', 'description' => 'Berita seputar keagamaan dan spiritual']
        );
        
        $budaya = Category::firstOrCreate(
            ['slug' => 'budaya'],
            ['name' => 'Budaya', 'description' => 'Berita seputar budaya dan tradisi']
        );

        $newsData = [
            [
                'category_id' => $pendidikan->id,
                'title' => 'Pesantren Modern: Mencetak Generasi Santri yang Kompetitif di Era Digital',
                'content' => 'Di era digital saat ini, pesantren modern terus bertransformasi untuk mencetak generasi santri yang tidak hanya menguasai ilmu agama, tetapi juga memiliki kemampuan teknologi yang mumpuni.

Banyak pesantren kini telah mengintegrasikan kurikulum teknologi informasi, bahasa asing, dan keterampilan kewirausahaan ke dalam sistem pendidikan mereka. Hal ini bertujuan agar para santri siap menghadapi tantangan zaman modern tanpa kehilangan akar tradisi keilmuan Islam.

"Kami ingin santri kami tidak hanya hafal Al-Quran dan menguasai kitab kuning, tetapi juga mampu bersaing di dunia global," ujar KH. Ahmad Fauzi, pengasuh salah satu pesantren modern di Jawa Timur.

Beberapa pesantren bahkan sudah memiliki laboratorium komputer, studio broadcasting, dan fasilitas modern lainnya. Para santri diajarkan coding, desain grafis, dan digital marketing sebagai bekal menghadapi dunia kerja.

Transformasi ini disambut positif oleh para wali santri yang menginginkan pendidikan holistik untuk anak-anak mereka. Kombinasi antara pendidikan agama yang kuat dengan keterampilan modern menjadi daya tarik tersendiri bagi calon santri.',
                'excerpt' => 'Pesantren modern terus bertransformasi untuk mencetak generasi santri yang kompetitif di era digital dengan memadukan ilmu agama dan teknologi.',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(1),
            ],
            [
                'category_id' => $keagamaan->id,
                'title' => 'Tradisi Khataman Quran di Pesantren: Momen Sakral Penuh Berkah',
                'content' => 'Tradisi khataman Al-Quran merupakan salah satu momen paling sakral dan dinantikan di lingkungan pesantren. Kegiatan ini menjadi bukti keberhasilan santri dalam menyelesaikan hafalan atau bacaan Al-Quran 30 juz.

Prosesi khataman biasanya dilaksanakan dengan khidmat dan penuh kegembiraan. Dimulai dengan pembacaan doa, tahlil, dan diakhiri dengan sambutan dari kyai pengasuh pesantren. Para santri yang khatam akan mendapatkan sertifikat dan doa restu dari para guru dan sesama santri.

"Khataman adalah pencapaian besar bagi santri. Ini bukan akhir, melainkan awal dari perjalanan mereka dalam mengamalkan isi Al-Quran," jelasnya Ustadz Hamid, salah seorang pengajar di Pesantren Darussalam.

Tradisi ini juga menjadi momentum untuk mengundang wali santri dan masyarakat sekitar. Biasanya, acara khataman diselenggarakan dengan meriah, termasuk pengajian akbar dan kenduri.

Banyak alumni pesantren yang mengakui bahwa momen khataman adalah salah satu memori terindah selama menimba ilmu di pesantren. Kebersamaan, perjuangan, dan rasa syukur menjadi nilai-nilai yang tertanam kuat dari tradisi ini.',
                'excerpt' => 'Khataman Al-Quran merupakan momen sakral di pesantren yang menandai keberhasilan santri dalam menyelesaikan hafalan Al-Quran.',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(2),
            ],
            [
                'category_id' => $pendidikan->id,
                'title' => 'Sistem Pendidikan Pesantren Salafiyah: Menjaga Tradisi di Tengah Modernisasi',
                'content' => 'Pesantren salafiyah atau tradisional tetap mempertahankan metode pengajaran klasik yang telah diwariskan selama berabad-abad. Sistem ini fokus pada kajian kitab kuning dengan metode sorogan dan bandongan.

Metode sorogan adalah sistem pengajaran individual di mana santri membaca kitab di hadapan kyai, kemudian kyai memberikan koreksi dan penjelasan. Sementara bandongan adalah sistem di mana kyai membaca dan menjelaskan kitab, sedangkan santri mendengarkan dan mencatat.

"Metode ini terbukti efektif dalam membentuk karakter santri yang sabar, tekun, dan mendalam dalam memahami ilmu," ujar Gus Yusuf, putra kyai di salah satu pesantren salafiyah tertua di Jawa.

Meski dianggap konservatif, sistem pendidikan pesantren salafiyah tetap relevan. Para alumni pesantren salafiyah banyak yang menjadi ulama, kyai, dan tokoh masyarakat yang dihormati.

Kelebihan pesantren salafiyah adalah kedekatan hubungan antara santri dan kyai. Santri tidak hanya belajar ilmu, tetapi juga adab dan akhlak langsung dari keteladanan sang guru.',
                'excerpt' => 'Pesantren salafiyah tetap mempertahankan metode pengajaran klasik sorogan dan bandongan yang efektif membentuk karakter santri.',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(3),
            ],
            [
                'category_id' => $budaya->id,
                'title' => 'Seni Hadrah dan Shalawat: Warisan Budaya Pesantren yang Tetap Lestari',
                'content' => 'Seni hadrah dan shalawat merupakan tradisi kesenian Islam yang berkembang pesat di lingkungan pesantren. Kesenian ini tidak hanya menjadi sarana hiburan, tetapi juga media dakwah yang efektif.

Hadrah adalah seni musik Islami yang menggunakan rebana atau terbang sebagai instrumen utama, diiringi dengan lantunan shalawat kepada Nabi Muhammad SAW. Setiap pesantren biasanya memiliki grup hadrah yang tampil di berbagai acara.

"Melalui hadrah, santri belajar mencintai Rasulullah dan melestarikan budaya Islam Indonesia," kata Ustadzah Fatimah, pembina grup hadrah di Pesantren Putri An-Nur.

Banyak grup hadrah dari pesantren yang berhasil meraih prestasi di tingkat nasional bahkan internasional. Festival shalawat dan hadrah rutin diselenggarakan sebagai ajang kompetisi sekaligus silaturahmi antar pesantren.

Generasi muda santri sangat antusias mengikuti kegiatan hadrah. Selain mengasah bakat seni, kegiatan ini juga mempererat ukhuwah islamiyah antar santri dari berbagai daerah.',
                'excerpt' => 'Seni hadrah dan shalawat merupakan warisan budaya pesantren yang terus dilestarikan sebagai media dakwah dan ekspresi cinta kepada Rasulullah.',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(4),
            ],
            [
                'category_id' => $keagamaan->id,
                'title' => 'Ramadhan di Pesantren: Pengalaman Spiritual yang Tak Terlupakan',
                'content' => 'Bulan Ramadhan di pesantren memiliki nuansa yang sangat berbeda dan istimewa. Para santri menjalani ibadah puasa dengan berbagai kegiatan spiritual yang padat dan bermakna.

Kegiatan dimulai dari sahur bersama, dilanjutkan dengan shalat subuh berjamaah dan tadarus Al-Quran. Sepanjang hari, santri mengikuti kajian kitab dan kultum (kuliah tujuh menit) sebelum berbuka puasa.

"Ramadhan di pesantren mengajarkan kita disiplin, kesabaran, dan kebersamaan. Pengalaman ini membentuk karakter yang kuat," ungkap Ahmad, santri kelas 3 Aliyah.

Setelah berbuka, santri melaksanakan shalat tarawih berjamaah yang biasanya 23 rakaat lengkap dengan witir. Sebagian pesantren juga mengadakan tadarus kilat untuk mengkhatamkan Al-Quran selama Ramadhan.

Menjelang akhir Ramadhan, pesantren mengadakan itikaf di sepuluh malam terakhir untuk mengejar Lailatul Qadar. Suasana spiritual yang kental menjadi bekal santri untuk mengamalkan nilai-nilai Ramadhan sepanjang tahun.',
                'excerpt' => 'Ramadhan di pesantren memberikan pengalaman spiritual yang tak terlupakan dengan berbagai kegiatan ibadah yang padat dan bermakna.',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'category_id' => $pendidikan->id,
                'title' => 'Pesantren Tahfidz: Mencetak Penghafal Al-Quran Berkualitas',
                'content' => 'Pesantren tahfidz semakin diminati oleh masyarakat Indonesia. Lembaga pendidikan ini fokus pada program menghafal Al-Quran dengan metode yang sistematis dan teruji.

Berbagai metode hafalan diterapkan, mulai dari metode talaqqi, tikrar (pengulangan), hingga metode modern menggunakan aplikasi digital. Target utamanya adalah santri mampu menghafal 30 juz dengan kualitas bacaan yang baik.

"Kami tidak hanya menargetkan kuantitas hafalan, tetapi juga kualitas tajwid dan pemahaman makna ayat," jelas Ustadz Hafidzullah, direktur program tahfidz.

Pesantren tahfidz biasanya memiliki jadwal yang ketat. Santri memulai hafalan setelah subuh, dilanjutkan dengan muraja\'ah (mengulang hafalan) di waktu-waktu tertentu. Evaluasi dilakukan secara berkala untuk memastikan hafalan tetap terjaga.

Banyak alumni pesantren tahfidz yang berhasil menjadi imam masjid, qari, dan pengajar Al-Quran. Beberapa di antaranya bahkan mewakili Indonesia di kompetisi hafalan Al-Quran internasional.',
                'excerpt' => 'Pesantren tahfidz semakin diminati untuk mencetak penghafal Al-Quran berkualitas dengan metode hafalan yang sistematis.',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(6),
            ],
            [
                'category_id' => $budaya->id,
                'title' => 'Kuliner Khas Pesantren: Sederhana Namun Penuh Berkah',
                'content' => 'Makanan di pesantren memang terkenal sederhana, namun memiliki nilai filosofis yang dalam. Menu seperti nasi, sayur, tempe, dan ikan asin menjadi sajian sehari-hari yang mengajarkan kesederhanaan.

Di balik kesederhanaannya, makanan pesantren diyakini penuh berkah karena dimasak dengan penuh keikhlasan dan didoakan oleh kyai. Para santri menyebutnya sebagai "berkah dalem" atau berkah dari kyai.

"Makan di pesantren mengajarkan kita untuk bersyukur dan tidak mubazir. Apapun makanannya, kita nikmati bersama," kata Siti, santriwati yang sudah 5 tahun di pesantren.

Beberapa pesantren juga memiliki menu khas yang menjadi favorit, seperti rawon santri, soto pesantren, atau jenang special yang hanya disajikan di acara tertentu. Tradisi makan bersama dalam satu nampan juga masih dipertahankan.

Setelah lulus, banyak alumni yang merindukan masakan pesantren. Rasa sederhana itu menyimpan memori kebersamaan dan perjuangan yang tak terlupakan.',
                'excerpt' => 'Kuliner pesantren yang sederhana menyimpan nilai filosofis tentang kesyukuran dan kebersamaan yang mendalam.',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(7),
            ],
            [
                'category_id' => $keagamaan->id,
                'title' => 'Haul Akbar: Mengenang Jasa Para Ulama Pendiri Pesantren',
                'content' => 'Haul akbar merupakan tradisi tahunan yang diselenggarakan pesantren untuk memperingati wafatnya kyai pendiri atau ulama besar yang berjasa. Acara ini menjadi momentum untuk mendoakan dan mengenang jasa-jasa beliau.

Rangkaian acara haul biasanya berlangsung beberapa hari, meliputi pembacaan tahlil, khataman Al-Quran, pengajian akbar, dan doa bersama. Ribuan santri, alumni, dan masyarakat hadir untuk mengikuti acara ini.

"Haul adalah bentuk penghormatan kita kepada para guru yang telah berjuang menyebarkan ilmu agama. Kita berdoa agar amal beliau diterima Allah," ujar KH. Mahfudz, pemangku haul.

Tradisi haul juga menjadi ajang silaturahmi alumni dari berbagai penjuru. Banyak yang rela menempuh perjalanan jauh untuk hadir dan bertemu kembali dengan teman-teman seperjuangan.

Selain bernilai spiritual, haul juga menggerakkan ekonomi masyarakat sekitar. Pedagang, penginapan, dan jasa transportasi mendapat rezeki dari ramainya pengunjung haul.',
                'excerpt' => 'Haul akbar adalah tradisi tahunan pesantren untuk mengenang dan mendoakan ulama pendiri yang telah berjasa.',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(8),
            ],
        ];

        foreach ($newsData as $news) {
            News::create([
                'category_id' => $news['category_id'],
                'user_id' => $admin->id,
                'title' => $news['title'],
                'slug' => Str::slug($news['title']) . '-' . time(),
                'excerpt' => $news['excerpt'],
                'content' => $news['content'],
                'is_published' => $news['is_published'],
                'published_at' => $news['published_at'],
            ]);
        }
    }
}
