-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Des 2024 pada 07.52
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_klinik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kiat_news`
--

CREATE TABLE `kiat_news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `news_date` date NOT NULL,
  `date_uploaded` timestamp NOT NULL DEFAULT current_timestamp(),
  `views` int(11) DEFAULT 0,
  `source_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kiat_news`
--

INSERT INTO `kiat_news` (`id`, `title`, `description`, `news_date`, `date_uploaded`, `views`, `source_link`) VALUES
(7, 'Manfaat Rutin Memeriksakan Kesehatan', 'Kenapa Pemeriksaan Kesehatan Rutin Itu Penting?\r\n\r\nPemeriksaan kesehatan rutin merupakan langkah penting untuk menjaga kesehatan tubuh Anda. Berikut beberapa alasan mengapa pemeriksaan rutin sangat dianjurkan:\r\n1. Deteksi Dini Penyakit Pemeriksaan kesehatan dapat membantu mendeteksi penyakit sejak dini, sebelum gejala muncul. Ini memungkinkan penanganan yang lebih cepat dan efektif.\r\n\r\n2. Menjaga Kesehatan Secara Menyeluruh Selain memeriksa kondisi tubuh secara umum, pemeriksaan rutin juga dapat mencakup pengecekan kesehatan gigi, mata, dan organ penting lainnya.\r\n\r\n3. Memantau Perkembangan Kesehatan Bagi yang memiliki riwayat penyakit tertentu, pemeriksaan rutin membantu memantau perkembangan dan efektivitas pengobatan.\r\n\r\n4. Membantu Merencanakan Pola Hidup Sehat Setelah pemeriksaan, Anda akan mendapatkan saran tentang pola hidup sehat yang sesuai dengan kondisi tubuh Anda.\r\n\r\n', '2024-11-22', '2024-11-22 16:58:03', 3, NULL),
(8, 'Pentingnya Vaksinasi untuk Semua Usia', 'Mengapa Vaksinasi Itu Penting?\r\n\r\nVaksinasi adalah langkah pencegahan yang penting untuk menjaga kesehatan tubuh dari berbagai penyakit menular. Berikut beberapa alasan mengapa vaksinasi diperlukan untuk semua usia:\r\n\r\n1. Mencegah Penyakit Menular Vaksinasi membantu tubuh Anda membentuk kekebalan terhadap penyakit tertentu, mengurangi risiko terinfeksi penyakit yang dapat berbahaya.\r\n\r\n2. Melindungi Orang Sekitar Vaksinasi tidak hanya melindungi diri sendiri, tetapi juga orang lain, terutama mereka yang memiliki sistem kekebalan tubuh lemah, seperti bayi, lansia, atau orang dengan penyakit tertentu.\r\n\r\n3. Menurunkan Risiko Komplikasi Beberapa penyakit dapat menyebabkan komplikasi serius jika tidak divaksinasi. Dengan vaksinasi, risiko terkena komplikasi tersebut dapat diminimalkan.\r\n\r\n4. Menjaga Kesehatan Komunitas Semakin banyak orang yang divaksinasi, semakin kecil peluang penyakit menyebar dalam masyarakat. Ini berkontribusi pada terciptanya kekebalan kelompok yang melindungi semua orang.\r\n\r\n5. Vaksin untuk Semua Usia Vaksinasi tidak hanya untuk anak-anak, tetapi juga penting untuk remaja, orang dewasa, dan lansia. Vaksin untuk flu, pneumonia, dan penyakit lainnya penting untuk diperoleh sesuai usia dan kondisi kesehatan.', '2024-11-30', '2024-11-22 16:59:58', 4, NULL),
(9, 'Mata Katarak: Penyebab, Gejala, dan Cara Mengobati', 'Katarak adalah penyebab utama kebutaan di dunia dan Indonesia. Data WHO 2002 menunjukkan 47,8% dari 37 juta orang buta menderita katarak, dengan jumlah penderita mencapai 94 juta pada 2020. Di Indonesia, 1,6 juta dari 8 juta orang dengan gangguan penglihatan pada 2017 mengalami kebutaan akibat katarak. Oleh karena itu penting untuk memahami gejala, penyebab, serta cara pengobatan dan pencegahan katarak.\r\nApa Itu Mata Katarak ?\r\nKatarak adalah penyebab utama kebutaan di Indonesia dan dunia, disebabkan oleh kekeruhan pada lensa mata yang menyebabkan penurunan ketajaman penglihatan. Berbeda dengan kelainan refraksi yang bisa dikoreksi dengan kacamata atau LASIK, mata katarak hanya bisa diatasi dengan operasi untuk mengganti lensa mata yang keruh. Gejala pada mata katarak meliputi penglihatan kabur seperti melihat melalui kabut, dan obat atau ramuan herbal belum terbukti efektif menyembuhkan kondisi ini.\r\n\r\nBagaimana dengan obat baik farmasi maupun ramuan herbal? Hingga saat ini belum ada bukti ilmiah katarak bisa sembuh dengan obat atau ramuan herbal.\r\nApa Penyebabnya ?\r\nKatarak termasuk penyakit mata yang memiliki penyebab multifaktorial. Artinya, penyebabnya tidak hanya satu. Ada banyak faktor yang mempengaruhi timbunya kekeruhan pada lensa mata.\r\n\r\nPenuaan\r\nFator yang paling utama adalah penuaan. Seiring usia yang bertambah tua, lensa mata akan semakin berat dan tebal serta mengalami penurunan daya akomodasi.\r\n\r\nLensa mata terdiri dari air dan protein. Protein tersusun sedemikian rupa sehingga lensa mata berwarna jernih (transparan). Semakin tua usia seseorang, protein dan sel-sel mati akan menumpuk membentuk gumpalan pada lensa. Lama kelamaan, gumpalan ini membentuk awan keruh yang menutupi lensa dan menghalangi masuknya cahaya.\r\n\r\nSemakin luas awan keruh menutupi lensa, semakin cahaya sulit masuk, semakin kabur penglihatan seseorang. Mata Katarak pun menjadi semakin parah.\r\n\r\nKelainan bawaan\r\nPenyebab mata katarak berikutnya adalah kelainan bawaan. Gangguan proses perkembangan embrio saat berada dalam kandungan atau kelainan pada kromosom dapat menyebabkan kekeruhan lensa saat lahir. Seiring bertambahkan usia, kekeruhan ini semakin parah.\r\n\r\nJika katarak akibat penuaan memiliki nama age-related catarcat atau katarak senilis, katarak yang terjadi sejak bayi akibat kelainan bawaan ini memiliki nama katarak kongenital.\r\n\r\nTrauma\r\nPenyakit mata ini juga bisa terjadi akibat trauma yang mengganggu struktur lensa mata baik secara makroskopis maupun mikroskopis. Perubahan struktur lensa dan gangguan keseimbangan metobolisme lensa menyebabkan terbentuknya mata katarak baik terjadi dalam waktu singkat atau justru bertahun-tahun setelah cedera.\r\n\r\nPenyakit sistemik dan penyakit lainnya\r\nFaktor – fator penyakit sistemik atau penyakit lainnya, seperti diabetes mellitus. Akumulasi sorbitol dalam lensa akan menarik air ke dalam lensa sehingga terjadi hidrasi lensa yang menyebabkan penurunan kejernihan lensa. Lensa mata pun menjadi keruh.\r\n\r\nSelain itu, ada pula penyakit lain yang menjadi faktor penyebab. Antara lain glukoma dan uveitis yang mengganggu keseimbangan elektrolit sehingga menyebabkan kekeruhan lensa.\r\n\r\nKebiasaan merokok\r\nSebuah penelitian menunjukkan semakin sering seseorang merokok, semakin besar risikonya mengalami penyakit penyebab kebutaan nomor 1 dunia. Pasalnya, merokok bisa menyebabkan cadangan antioksidan pada mata berkurang, sehingga terjadi oksidasi pada lensa mata.\r\n\r\nSelain itu, merokok juga bisa menyebabkan penumpukan molekul berpigmen 3-hydroxy kyneurine dan chromophores yang menyebabkan warna lensa menjadi kekuningan, tidak lagi jernih. Pada akhirnya, kedua hal ini menjadi penyebab lebih cepat timbulnya mata katarak.\r\nKetahui Gejalanya\r\nKatarak bisa dicegah atau diperlambat dengan menghindari faktor risiko seperti merokok, menjaga pola makan sehat, dan memeriksakan mata secara rutin. Penanganan dini oleh dokter mata juga penting untuk mengurangi risiko komplikasi.\r\n\r\nKenali gejala katarak berikut untuk langkah pencegahan :\r\n\r\nPandangan kabur seperti berkabut\r\nPandangan kabur seperti berkabut atau berasap. Pandangan serasa berkabut ini terjadi pada keseluruhan baik jarak pendek maupun jarak jauh. Ini berbeda dengan kelainan refraksi yang kaburnya pada jarak tertentu. Misalnya pada rabun jauh (miopia), yang tampak buram hanya objek jarak jauh. Sebaliknya, pada rabun dekat (hipermetropi), yang tampak buram hanya objek jarak dekat.\r\n\r\nWarna di sekitar terlihat memudar\r\nJika astigmatisme membuat pandangan menjadi samar dan berbayang, mata katarak selain membuat pandangan berbayang- juga membuat warna tampak memudar.\r\n\r\nTentu gejala ini mengganggu. Sebab mata tidak bisa lagi melihat warna seindah aslinya. Terutama untuk warna terang yang memudar jadi menguning.\r\n\r\nFotofobia (mata mudah silau)\r\nGejala berikutnya adalah mata menjadi mudah silau. Terutama saat melihat lampu mobil, matahari, atau lampu. Istilah untuk gejala ini adalah fotofobia. Mata sensitif terhadap cahaya dan sulit untuk melihat di malam hari.\r\n\r\nPandangan ganda\r\nSelain pandangan berbayang, katarak juga membentuk pandangan ganda. Penderita penyakit mata ini akan melihat satu benda tampak seperti memiliki kembarannya. Tentu keluhan ini juga membuat tidak nyaman.\r\n\r\nMelihat lingkaran di sekeliling cahaya\r\nGejala berikutnya lagi adalah tampaknya lingkaran di sekeliling cahaya. Misalnya pada bola lampu yang pada mata normal terlihat biasa saja, pada penderita katarak akan tampak di sekeliling lampu tersebut tampak terdapat lingkaran.\r\n\r\nBaca juga: Ciri-Ciri Mata Katarak\r\n\r\nTahapan Katarak\r\nKatarak, khususnya karena faktor usia, akan mengalami tiga tahapan:\r\n\r\nKatarak imatur\r\nKatarak matur\r\nKatarak hipermatur\r\nSeiring waktu, protein pada lensa mata mengeras, dan pada tahap katarak hipermatur, protein menjadi keras atau mencair di sekitarnya. Jika tidak diobati, ini dapat meningkatkan tekanan mata, mengganggu saraf, dan berpotensi menyebabkan kebutaan permanen. Meskipun katarak dapat diatasi, kerusakan saraf yang menyebabkan kebutaan tidak bisa diperbaiki.\r\n\r\nApa Saja Bahayanya ?\r\nSelain risiko terbesar berupa kebutaan permanen ketika syaraf mata sudah kena, katarak yang tidak tertangani dengan tepat juga bisa mengakibatkan risiko sosial sebagai berikut:\r\n\r\nKehilangan pekerjaan : Mata yang kabur atau berkabut membuat penderita katarak tidak mendapatkan pekerjaan yang layak. Karena indeks penglihatan 83% sumber olah informasi pada manusia. Jika sudah bekerja, ia terancam mengalami PHK.\r\nKesehatan menurun : Orang yang Katarak yang memiliki tingkat keparahan penyakit cukup tinggi, ia tidak bisa beraktivitas normal sehingga lebih banyak diam. Karena diam dan tidak banyak bergerak, ia bisa terkena penyakit yang lain. Risiko kematian juga naik menjadi 2,6 kali lebih tinggi.\r\nRisiko kecelakaan meningkat :Pandangan kabur dan berkabut akibat katarak bisa mengakibatkan kecelakaan. Terutama jika menyetir kendaraan bermotor sendiri atau menyeberang jalan. Menurut hasil studi, katarak meningkatkan kecelakaan lalu lintas 2,5 kali lebih tinggi.\r\nCara Menyembuhkan Katarak\r\nSeperti penjelasan di atas, katarak tidak bisa sembuh dengan obat-obatan baik farmasi maupun herbal. Hingga saat ini, katarak hanya bisa disebuhkan dengan operasi katarak. Yakni mengganti lensa mata yang keruh dengan lensa buatan yang jernih dan transparan.\r\nKarena katarak adalah keruhnya lensa, ia juga tidak bisa dikoreksi dengan kacamata sebagaimana kelainan refraksi. Kalaupun pada staidum awal pandangan bisa terbantu dengan kacamata, setelah beberapa lama, kacamata itu tidak lagi bisa membantu.\r\n\r\nSatu-satunya cara menyembuhkan katarak adalah dengan mengganti lensa mata melalui operasi katarak. Untuk saat ini, setidaknya ada tiga pilihan teknik operasi katarak sebagai berikut:\r\n\r\nECCE (Extra Capsular Cataract Extraction)\r\nECCE ini merupakan teknik operasi katarak konvensional. Pada operasi katarak ini, lensa dikeluarkan melalui sayatan selebar 8—10 mm. Teknik operasi ini membutuhkan waktu penyembuhan dan pemulihan yang cukup lama.\r\n\r\nSICS (Small Incision Cataract Surgery)\r\nTeknik operasi SICS lebih canggih. Ia menggunakan jahitan dengan sayatan 6—10 mm. Proses operasinya juga lebih singkat, sekitar 15-30 menit.\r\n\r\nPhacoemulsification\r\nOperasi katarak dengan teknik phacoemulsification adalah metode tanpa jahitan yang lebih canggih, memakan waktu sekitar 10-15 menit dan menawarkan pemulihan yang cepat. Pasien dapat pulang langsung setelah prosedur, dengan penyembuhan yang biasanya memerlukan waktu 2 minggu hingga 1 bulan.\r\n\r\nBaca juga: Operasi Katarak Gratis\r\n\r\nCara Mencegahnya\r\nMeski penuaan tidak bisa dihindari, kita dapat mencegah katarak dengan menghindari faktor penyebab dan menjaga kesehatan mata. Beberapa orang lanjut usia masih memiliki penglihatan yang baik.\r\n\r\nNah, berikut ini beberapa cara mencegah katarak yang bisa kita optimalkan. antara lain :\r\n\r\nHindari merokok\r\nKebiasaan merokok merupakan salah satu penyebab percepatan katarak. Jika belum bisa meninggalkan secara langsung, mulai kurangi secara bertahap hingga nanti bisa berhenti sepenuhnya untuk tidak merokok.\r\n\r\nJaga pola makan dan gaya hidup\r\nJaga pola makan dan gaya hidup agar tetap sehat agar kadar gula tetap normal. Tidak sampai terkena diabetes mellitus yang merupakan penyakit sistemik penyebab katarak.\r\n\r\nKonsumsi makanan yang kaya antioksidan dan vitamin A untuk menjaga kesehatan mata. Juga menjaga berat badan tubuh agar tetap ideal.\r\n\r\nPeriksa mata secara rutin\r\nPeriksakan mata secara rutin ke dokter dan lakukan konsultasi dokter mata. Ketika diagnosis menunjukkan ada gangguan mata, termasuk gejala katarak, dokter akan sedini mungkin mengambil tindakan yang tepat.\r\n\r\nJaga dan lindungi mata\r\nLindungi mata agar tidak terbentur, tidak terjadi trauma. Juga lindungi mata dari paparan matahari secara langsung.', '2024-12-10', '2024-12-09 19:23:28', 19, 'https://kmu.id/mata-katarak-penyebab-gejala/');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kiat_news`
--
ALTER TABLE `kiat_news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kiat_news`
--
ALTER TABLE `kiat_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
