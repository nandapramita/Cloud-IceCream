##CLOUD-ICECREAM##
-
Repository ini disusun oleh Putu Putri Nanda Pramita, seorang mahasiswi jurusan Sistem Informasi di ITB STIKOM Bali dengan Nomor Induk Mahasiswa 220030661.

Repository Cloud-IceCream dibuat sebagai bagian dari persiapan Ujian Akhir Semester (UAS) ganjil 2024 untuk mata kuliah Pemrograman Web.

-- Deskripsi Proyek --
-
Cloud Ice Cream adalah perusahaan yang menghadirkan es krim berkualitas tinggi dalam setiap menu mereka. Keistimewaan dari es krim mereka terletak pada tampilan awan yang ringan, lembut, dan menyegarkan. Website ini dibuat untuk mencerminkan identitas Cloud Ice Cream, dengan desain yang mengusung warna biru langit muda dan tampilan yang ceria.

-- Harapan pengalaman pengguna --
-
Website Cloud Ice Cream dirancang dengan berbagai fitur untuk memberikan pengalaman pengguna yang memuaskan dan menyenangkan. Beberapa harapan pengalaman pengguna yang diintegrasikan dalam desain website ini meliputi:

a) Navigasi Intuitif: Dengan header yang jelas dan menu yang terstruktur, diharapkan pengguna dapat dengan mudah menavigasi antara halaman-halaman utama. Fitur pencarian pada halaman "Latest Products" dirancang untuk membantu pengguna menemukan menu yang diinginkan dengan cepat.

b) Tampilan Visual Menarik: Desain cerah, ceria, dan ringan diharapkan memberikan kesan positif kepada pengguna. Pengguna dapat menikmati tampilan awan yang ringan dan gambar produk yang menggugah selera.

c) Responsif dan Cepat: Website ini dirancang responsif untuk memastikan pengalaman pengguna yang konsisten, baik pada perangkat desktop maupun mobile. Kecepatan loading halaman dioptimalkan untuk menjaga kenyamanan pengguna selama berinteraksi dengan situs.

d) Informasi yang Mudah Diakses: Informasi penting, seperti menu, harga, diskon, dan ulasan pelanggan, disajikan dengan cara yang mudah dipahami. Halaman "About Us" memberikan wawasan lebih dalam tentang visi dan misi Cloud Ice Cream.

-- Fitur Utama --
-
Proyek pengembangan web ini terbagi menjadi tiga bagian utama: header, konten dan footer. Kemudian terdapat pula halaman login dan signup serta halaman untuk Admin (Admin Dashboard). Seluruh web dirancang dengan menggunakan HTML, CSS, JavaScript,dan PHP. Adapun lebih rinci sebagai berikut;

a) Halaman Utama ("Home"): Pengguna dapat merasakan kesan awan yang lembut melalui desain tampilan utama. Informasi singkat tentang Cloud Ice Cream dan daya tarik produk mereka disajikan pada halaman ini.

b) Tentang Kami ("About Us"): Pengguna dapat mengenal lebih dekat dengan perusahaan melalui halaman "About Us". Desain halaman ini mengusung suasana yang menyenangkan dan informatif.

c) Daftar Menu ("Latest Products"): Daftar menu es krim beserta harganya dapat ditemukan dengan mudah. Fitur pencarian sudah tersedia guna memudahkan pengguna untuk menemukan menu yang diinginkan.

d) Ulasan Pelanggan ("Review"): Pengguna dapat membaca ulasan dari pelanggan Cloud Ice Cream dan memberikan feedback mereka. Halaman ini membangun kepercayaan melalui pengalaman positif pelanggan sebelumnya.

e) Halaman Login & Signup: Pengguna yang belum memiliki akun dapat mendaftar dengan mengisi formulir pendaftaran. Informasi yang diperlukan mencakup nama, alamat email, dan kata sandi.Sementara bagi pengguna yang sudah memiliki akun dapat masuk ke platform dengan menggunakan kombinasi alamat email dan kata sandi. Sistem autentikasi yang aman dan terenkripsi digunakan untuk melindungi informasi pengguna.

f) Halaman Pemesanan: Pengguna dapat melakukan pemesanan produk Cloud Ice Cream melalui halaman ini apabila telah melakukan login, tahapan tersebut diharuskan untuk membantu sistem mendapatkan informasi pribadi pengguna tanpa harus menuliskannya kembali di form (menghindari redudansi).

g) Halaman Admin (Admin Dashboard): Halaman ini tersedia untuk membantu Admin dalam memanajemen pesanan yang masuk dari pengguna, memanajemen produk seperti pembaruan harga dan stok, dan mengetahui informasi User. Admin diharuskan login terlebih dahulu agar dapat menggunakan halaman ini. 

-- Struktur Folder --
-
- Website Cloud Ice Cream memiliki struktur folder sebagai berikut;
  
/cloud-icecream
├── /Main                      : Folder Utama

    ├── /pic                   : Folder menangani gambar-gambar
    
        ├── cloud.png          : Gambar ikon di title
        
        ├── ice-a.png          : Gambar ice cream sorbet
        
        ├── ice-b.png          : Gambar ice cream frozen
        ├── ice-c.png          : Gambar ice cream highpro
        ├── ice-d.png          : Gambar ice cream yogurt
        ├── ice-e.png          : Gambar ice cream gelato
        ├── ice-f.png          : Gambar ice cream regular
        ├── ice1.jpg           : Gambar background home
        ├── ice01.jpg          : Gambar reviewer 1
        ├── ice02.jpg          : Gambar reviewer 2
        ├── ice2.mp4           : Video about
    ├── /script                : Folder menangani script main
        ├── dbconfig.php       : File menangani koneksi ke localhost
        ├── index.html         : File utama web Cloud Ice Cream
        ├── script.js          : File menangani pencarian dan perhitungan
        ├── style.css          : File menangani css main
├── /Pesanan                   : Folder menangani proses pemesanan
    ├── /css                   : Folder menangani css pesanan.php
        ├── style.css          : File menangani css pesanan
        ├── store.png          : Gambar background pesanan
        ├── cloud.png          : Gambar ikon di title
    ├── /misc                  : Folder menangani sql tabel pesanan
        ├── createdb.sql       : File menangani sql tabel pesanan
    ├── db.config.php          : File menangani koneksi ke localhost
    ├── form_handler.php       : File menangani method
    ├── pesanan.php            : File utama pesanan
    ├── process.php            : File menangani respon method
├── /User                      : Folder menangani kepentingan User
    ├── /css                   : Folder menangani css login.php dan signup.php
        ├── style.css          : File menangani css login.php dan signup.php
        ├── store.png          : Gambar background login.php dan signup.php
        ├── cloud.png          : Gambar ikon di title
    ├── data-query.sql         : File menangani sql tabel user
    ├── dbconfig.php           : File menangani koneksi ke localhost
    ├── login.php              : File utama login
    ├── login_formhandler.php  : File menangani method
    ├── logout.php             : File utama logout
    ├── process.php            : File menangani proses login dan logout
    ├── signup.php             : File utama signup
    ├── signup_formhandler.php : File menangani method
├── /Admin                     : Folder menangani proses manajemen oleh Admin
    ├── /admin                     : File menangani proses login dan logout Admin
        ├── /css                   : Folder menangani css login.php dan signup.php Admin
            ├── style.css          : File menangani css login.php dan signup.php Admin
            ├── cloud.png          : Gambar ikon di title
        ├── data-query.sql         : File menangani sql tabel Admin
        ├── dbconfig.php           : File menangani koneksi ke localhost
        ├── login.php              : File utama login Admin
        ├── login_formhandler.php  : File menangani method
        ├── logout.php             : File utama logout Admin
        ├── process.php            : File menangani proses login dan logout Admin
        ├── signup.php             : File utama signup Admin
        ├── signup_formhandler.php : File menangani method
    ├── /css                   : File menangani proses login dan logout
    ├── /misc                  : File menangani proses login dan logout
    ├── add_product.php        : File menangani proses penambahan product
    ├── admin.php              : File utama Admin
    ├── dbconfig.pgp.php       : File menangani koneksi ke localhost
    ├── dl_pesanan.php         : File menangani proses delete pesanan
    ├── dl_product.php         : File menangani proses delete dan update product
    ├── pesanan.php            : File menangani utama pesanan (admin)
    ├── product.php            : File menangani utama product (admin)
    ├── user.php               : File menangani utama user (user)
    ├── welcome.php            : File menangani tampilan default
├── /Designsystem              : Folder menangani proses sistem design
    ├── systemdesign.pdf       : File menangani desain sistem
├── /Screenshotsystem          : Folder menangani tangkapan layar sistem
    ├── ss01.png               : Gambar home
    ├── ss02.png               : Gambar about
    ├── ss03.png               : Gambar product
    ├── ss04.png               : Gambar review
    ├── ss05.png               : Gambar footer
    ├── ss06.png               : Gambar pesanan
    ├── ss07.png               : Gambar login
    ├── ss08.png               : Gambar signup
    ├── ss09.png               : Gambar login (admin)
    ├── ss10.png               : Gambar user (admin)
    ├── ss11.png               : Gambar product (admin)
    ├── ss12.png               : Gambar pesanan (admin)

-- Tautan Hidup --
-
Tautan Proyek
Cara Menjalankan Proyek:
Klik tautan proyek yang telah disediakan.
Atau buka browser, disarankan menggunakan Chrome atau Microsoft Edge.
Ketikkan tautan proyek di atas, dan halaman web siap ditampilkan.

-- Screenshot Halaman Web Cloud Ice Cream --
-
![Screenshot Home](https://github.com/nandapramita/uts-webpro/blob/master/Screenshotsystem/ss01.png)
![Screenshot About Us](https://github.com/nandapramita/uts-webpro/blob/master/Screenshotsystem/ss02.png)
![Screenshot Latest Products](https://github.com/nandapramita/uts-webpro/blob/master/Screenshotsystem/ss03.png)
![Screenshot Review](https://github.com/nandapramita/uts-webpro/blob/master/Screenshotsystem/ss04.png)
![Screenshot Footer](https://github.com/nandapramita/uts-webpro/blob/master/Screenshotsystem/ss05.png)
