-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 07:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `hour` varchar(50) NOT NULL,
  `keluhan` text NOT NULL,
  `poly` varchar(50) NOT NULL,
  `dokter` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `pdf` varchar(50) NOT NULL,
  `visit` varchar(50) DEFAULT NULL,
  `no_antrian` int(11) NOT NULL,
  `saran` varchar(500) DEFAULT NULL,
  `pemeriksaan` date DEFAULT NULL,
  `obat` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id`, `username`, `fullname`, `date`, `hour`, `keluhan`, `poly`, `dokter`, `status`, `pdf`, `visit`, `no_antrian`, `saran`, `pemeriksaan`, `obat`) VALUES
(31, 'Fatimah', 'Fatimah Azzahra ', '2024-06-01', '11:00 AM', 'sakit kepala', 'General', 'Janneth William', 'completed', 'visitReport.pdf', 'sudah', 1, 'jaga kesehatan', '2024-12-21', '5,'),
(32, 'Fatimah', 'Fatimah Azzahra ', '2024-07-06', '11:00 AM', 'sakit kaki', 'General', 'Reinath Salsa', 'completed', 'visitReport.pdf', NULL, 1, NULL, NULL, NULL),
(35, 'yasmin', 'Yasmin azzahra', '2024-07-15', '10:30 AM', 'agak pusing pilek panas', 'General', 'Reinath Salsa', 'upcoming', '', NULL, 1, NULL, NULL, NULL),
(36, 'yasmin', 'Yasmin azzahra', '2024-08-24', '14:30 PM', 'telinga agak berdengung', 'Otology', 'Janneth William', 'upcoming', '', NULL, 1, NULL, NULL, NULL),
(37, 'Dew', 'Dewi Massitoh', '2024-06-30', '14:00 PM', 'lambung sakit', 'Gastroenteritis', 'Edith Farith', 'upcoming', '', NULL, 1, NULL, NULL, NULL),
(38, 'wiwik', 'Wiwik Ainun Janah', '2005-07-11', '10:30 AM', 'sakit kepala', 'General', 'William Smith', 'upcoming', '', NULL, 1, NULL, NULL, NULL),
(39, 'khoir', 'siti khoirul muzaroah', '2024-07-07', '09:30 AM', 'sakit', 'Gastroenteritis', 'Reinath Salsa', 'completed', '', NULL, 1, NULL, NULL, NULL),
(40, 'Fatimah', 'Fatimah Azzahra ', '2024-07-16', '09:30 AM', 'sakit boyok', 'General', 'William Smith', 'upcoming', '', NULL, 1, NULL, NULL, NULL),
(41, 'ciawra', 'w', '2024-07-01', '09:30 AM', 'sakit mata', 'General', 'William Smith', 'upcoming', '', NULL, 1, NULL, NULL, NULL),
(42, 'wiwik', 'Wiwik Ainun Janah', '0033-03-12', '09:30 AM', 'sakit', 'General', 'William Smith', 'upcoming', '', NULL, 1, NULL, NULL, NULL),
(43, 'fatimah', 'Fatimah Azzahra ', '2004-06-12', '10:00 AM', 'sakit', 'General', 'William Smith', 'upcoming', '', NULL, 1, NULL, NULL, NULL),
(45, 'maharani', 'a', '2024-07-01', '09:30 AM', 'sakit', 'General', 'Janneth William', 'upcoming', '', NULL, 1, NULL, NULL, NULL),
(46, 'khoir', 'siti khoirul muzaroah', '2024-12-07', '15:00 PM', 'sakittt', 'General', 'Janneth William', 'upcoming', '', NULL, 1, NULL, NULL, NULL),
(49, 'yasmin', 'Yasmin azzahra', '2024-12-13', '11:00 AM', 'awww', 'Cardiologist', 'Edith Farith', 'upcoming', '', NULL, 1, NULL, NULL, NULL),
(59, 'Fatimah', 'Fatimah Azzahra ', '0000-00-00', '11:00 AM', 'sakit kepala', 'General', 'Janneth William', 'completed', '', NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(50) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `poli` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `username`, `email`, `password`, `fullname`, `dob`, `phone`, `gender`, `gambar`, `poli`) VALUES
(1, 'Edith Farith', 'edith@gmail.com', 'edith', 'Dr Edith Farith', '1995-02-10', '086543776572', 'male', 'doctor674ee6ba2e1f1.png', 'Gastroenteritis'),
(2, 'Janneth William', 'janneth@gmail.com', 'janneth', 'Janneth William', '1992-05-03', '085433277746', 'female', '675487045d16e.png', 'General'),
(3, 'Reinath Salsa', 'reinath@gmail.com', 'reinath', 'Reinath Salsa', '2000-02-04', '08993339888', 'female', '6754878560bbd.png', 'Cardiologist'),
(4, 'William Smith', 'william@gmail.com', 'william', 'William Smith', '1996-11-14', '0832747583912', 'male', '675487def0bae.png', 'Gastroenteritis'),
(5, 'Budi Rejani', 'budi@gmail.com', 'budi', 'Budi Rejani', '1995-10-17', '083847563928', 'male', '67548b5738818.png', 'Otology'),
(6, 'Samira Renata', 'samira@gmail.com', 'samira', 'Samira Renata', '2001-07-11', '08374628161', 'female', '67548ba57bcaf.jpg', 'General'),
(7, 'Ade Teguh Pradigara', 'adeteguh@gmail.com', 'adeteguh', 'Ade Teguh Pradigara', '1994-06-07', '089474625122', 'male', '67548c02f195e.jpg', 'Dentist'),
(8, 'Ana Maria', 'ana@gmail.com', 'ana', 'Ana Maria', '1995-09-11', '084759385746', 'female', '67548c5a42051.jpg', 'Cardiologist'),
(9, 'Yusfian Brahmantio', 'yusfian@gmail.com', 'yusfian', 'Yusfian Brahmantio', '1999-10-27', '084756382938', 'male', '67548cad9d027.jpg', 'Otology'),
(10, 'Diana Salsabila', 'diana@gmail.com', 'diana', 'Diana Salsabila', '2001-08-30', '083645273832', 'female', '67548cfd53f88.jpg', 'General'),
(11, 'Liam Hermawan', 'liam@gmail.com', 'liam', 'Liam Hermawan', '1993-09-02', '084758392847', 'male', '67548d45b58bf.webp', 'Orthopaedic'),
(12, 'Reihan Firmansyah', 'reihan@gmail.com', 'reihan', 'Reihan Firmansyah', '1996-01-19', '083474628211', 'male', '67548d995c577.jpg', 'Orthopaedic'),
(13, 'Dwi Puspita', 'dwipuspita@gmail.com ', 'dwipuspita', 'Dwi Puspita', '1999-03-09', '08376647282', 'female', '67548ddebf85e.jpg', 'Dentist');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mcu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `mcu_id`) VALUES
(25, 0, 4),
(26, 0, 21),
(27, 0, 32),
(21, 77, 6),
(22, 77, 21);

-- --------------------------------------------------------

--
-- Table structure for table `favorites_dokter`
--

CREATE TABLE `favorites_dokter` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `dokter_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites_dokter`
--

INSERT INTO `favorites_dokter` (`id`, `username`, `dokter_id`) VALUES
(2, 'ELVITA', 2),
(5, 'yasmin', 2),
(6, 'yasmin', 3),
(7, 'yasmin', 8),
(8, 'yasmin', 6);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_dokter`
--

CREATE TABLE `jadwal_dokter` (
  `id_jadwal` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `hari_praktik` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `jam_praktik` varchar(20) NOT NULL,
  `status` enum('Available','Unavailable') NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_dokter`
--

INSERT INTO `jadwal_dokter` (`id_jadwal`, `id_dokter`, `hari_praktik`, `jam_praktik`, `status`) VALUES
(1, 1, 'Monday', '08:00 AM - 12:00 PM', 'Available'),
(2, 1, 'Wednesday', '08:00 AM - 12:00 PM', 'Unavailable'),
(3, 1, 'Friday', '08:00 AM - 12:00 PM', 'Unavailable'),
(4, 2, 'Tuesday', '09:00 AM - 01:00 PM', 'Available'),
(5, 2, 'Thursday', '09:00 AM - 01:00 PM', 'Unavailable'),
(6, 2, 'Saturday', '09:00 AM - 01:00 PM', 'Available'),
(7, 3, 'Monday', '10:00 AM - 02:00 PM', 'Available'),
(8, 3, 'Wednesday', '10:00 AM - 02:00 PM', 'Available'),
(9, 3, 'Friday', '10:00 AM - 02:00 PM', 'Available'),
(10, 4, 'Monday', '01:00 PM - 05:00 PM', 'Available'),
(11, 4, 'Thursday', '01:00 PM - 05:00 PM', 'Available'),
(12, 4, 'Saturday', '01:00 PM - 05:00 PM', 'Unavailable'),
(13, 5, 'Tuesday', '08:00 AM - 12:00 PM', 'Available'),
(14, 5, 'Thursday', '08:00 AM - 12:00 PM', 'Available'),
(15, 5, 'Saturday', '08:00 AM - 12:00 PM', 'Available'),
(16, 6, 'Monday', '09:00 AM - 01:00 PM', 'Available'),
(17, 6, 'Wednesday', '09:00 AM - 01:00 PM', 'Available'),
(18, 6, 'Friday', '09:00 AM - 01:00 PM', 'Available'),
(19, 7, 'Monday', '02:00 PM - 06:00 PM', 'Available'),
(20, 7, 'Wednesday', '02:00 PM - 06:00 PM', 'Available'),
(21, 7, 'Friday', '02:00 PM - 06:00 PM', 'Available'),
(22, 8, 'Tuesday', '08:00 AM - 12:00 PM', 'Available'),
(23, 8, 'Thursday', '08:00 AM - 12:00 PM', 'Available'),
(24, 8, 'Saturday', '08:00 AM - 12:00 PM', 'Available'),
(25, 9, 'Monday', '10:00 AM - 02:00 PM', 'Available'),
(26, 9, 'Wednesday', '10:00 AM - 02:00 PM', ''),
(27, 9, 'Friday', '10:00 AM - 02:00 PM', ''),
(28, 10, 'Tuesday', '09:00 AM - 01:00 PM', ''),
(29, 10, 'Thursday', '09:00 AM - 01:00 PM', ''),
(30, 10, 'Saturday', '09:00 AM - 01:00 PM', ''),
(31, 11, 'Monday', '01:00 PM - 05:00 PM', ''),
(32, 11, 'Wednesday', '01:00 PM - 05:00 PM', ''),
(33, 11, 'Friday', '01:00 PM - 05:00 PM', ''),
(34, 12, 'Tuesday', '10:00 AM - 02:00 PM', ''),
(35, 12, 'Thursday', '10:00 AM - 02:00 PM', ''),
(36, 12, 'Saturday', '10:00 AM - 02:00 PM', ''),
(37, 13, 'Monday', '08:00 AM - 12:00 PM', ''),
(38, 13, 'Wednesday', '08:00 AM - 12:00 PM', ''),
(39, 13, 'Friday', '08:00 AM - 12:00 PM', '');

-- --------------------------------------------------------

--
-- Table structure for table `kiat_news`
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
-- Dumping data for table `kiat_news`
--

INSERT INTO `kiat_news` (`id`, `title`, `description`, `news_date`, `date_uploaded`, `views`, `source_link`) VALUES
(7, 'Manfaat Rutin Memeriksakan Kesehatan', 'Kenapa Pemeriksaan Kesehatan Rutin Itu Penting?\r\n\r\nPemeriksaan kesehatan rutin merupakan langkah penting untuk menjaga kesehatan tubuh Anda. Berikut beberapa alasan mengapa pemeriksaan rutin sangat dianjurkan:\r\n1. Deteksi Dini Penyakit Pemeriksaan kesehatan dapat membantu mendeteksi penyakit sejak dini, sebelum gejala muncul. Ini memungkinkan penanganan yang lebih cepat dan efektif.\r\n\r\n2. Menjaga Kesehatan Secara Menyeluruh Selain memeriksa kondisi tubuh secara umum, pemeriksaan rutin juga dapat mencakup pengecekan kesehatan gigi, mata, dan organ penting lainnya.\r\n\r\n3. Memantau Perkembangan Kesehatan Bagi yang memiliki riwayat penyakit tertentu, pemeriksaan rutin membantu memantau perkembangan dan efektivitas pengobatan.\r\n\r\n4. Membantu Merencanakan Pola Hidup Sehat Setelah pemeriksaan, Anda akan mendapatkan saran tentang pola hidup sehat yang sesuai dengan kondisi tubuh Anda.\r\n\r\n', '2024-11-22', '2024-11-22 16:58:03', 3, NULL),
(8, 'Pentingnya Vaksinasi untuk Semua Usia', 'Mengapa Vaksinasi Itu Penting?\r\n\r\nVaksinasi adalah langkah pencegahan yang penting untuk menjaga kesehatan tubuh dari berbagai penyakit menular. Berikut beberapa alasan mengapa vaksinasi diperlukan untuk semua usia:\r\n\r\n1. Mencegah Penyakit Menular Vaksinasi membantu tubuh Anda membentuk kekebalan terhadap penyakit tertentu, mengurangi risiko terinfeksi penyakit yang dapat berbahaya.\r\n\r\n2. Melindungi Orang Sekitar Vaksinasi tidak hanya melindungi diri sendiri, tetapi juga orang lain, terutama mereka yang memiliki sistem kekebalan tubuh lemah, seperti bayi, lansia, atau orang dengan penyakit tertentu.\r\n\r\n3. Menurunkan Risiko Komplikasi Beberapa penyakit dapat menyebabkan komplikasi serius jika tidak divaksinasi. Dengan vaksinasi, risiko terkena komplikasi tersebut dapat diminimalkan.\r\n\r\n4. Menjaga Kesehatan Komunitas Semakin banyak orang yang divaksinasi, semakin kecil peluang penyakit menyebar dalam masyarakat. Ini berkontribusi pada terciptanya kekebalan kelompok yang melindungi semua orang.\r\n\r\n5. Vaksin untuk Semua Usia Vaksinasi tidak hanya untuk anak-anak, tetapi juga penting untuk remaja, orang dewasa, dan lansia. Vaksin untuk flu, pneumonia, dan penyakit lainnya penting untuk diperoleh sesuai usia dan kondisi kesehatan.', '2024-11-30', '2024-11-22 16:59:58', 4, NULL),
(9, 'Mata Katarak: Penyebab, Gejala, dan Cara Mengobati', 'Katarak adalah penyebab utama kebutaan di dunia dan Indonesia. Data WHO 2002 menunjukkan 47,8% dari 37 juta orang buta menderita katarak, dengan jumlah penderita mencapai 94 juta pada 2020. Di Indonesia, 1,6 juta dari 8 juta orang dengan gangguan penglihatan pada 2017 mengalami kebutaan akibat katarak. Oleh karena itu penting untuk memahami gejala, penyebab, serta cara pengobatan dan pencegahan katarak.\r\nApa Itu Mata Katarak ?\r\nKatarak adalah penyebab utama kebutaan di Indonesia dan dunia, disebabkan oleh kekeruhan pada lensa mata yang menyebabkan penurunan ketajaman penglihatan. Berbeda dengan kelainan refraksi yang bisa dikoreksi dengan kacamata atau LASIK, mata katarak hanya bisa diatasi dengan operasi untuk mengganti lensa mata yang keruh. Gejala pada mata katarak meliputi penglihatan kabur seperti melihat melalui kabut, dan obat atau ramuan herbal belum terbukti efektif menyembuhkan kondisi ini.\r\n\r\nBagaimana dengan obat baik farmasi maupun ramuan herbal? Hingga saat ini belum ada bukti ilmiah katarak bisa sembuh dengan obat atau ramuan herbal.\r\nApa Penyebabnya ?\r\nKatarak termasuk penyakit mata yang memiliki penyebab multifaktorial. Artinya, penyebabnya tidak hanya satu. Ada banyak faktor yang mempengaruhi timbunya kekeruhan pada lensa mata.\r\n\r\nPenuaan\r\nFator yang paling utama adalah penuaan. Seiring usia yang bertambah tua, lensa mata akan semakin berat dan tebal serta mengalami penurunan daya akomodasi.\r\n\r\nLensa mata terdiri dari air dan protein. Protein tersusun sedemikian rupa sehingga lensa mata berwarna jernih (transparan). Semakin tua usia seseorang, protein dan sel-sel mati akan menumpuk membentuk gumpalan pada lensa. Lama kelamaan, gumpalan ini membentuk awan keruh yang menutupi lensa dan menghalangi masuknya cahaya.\r\n\r\nSemakin luas awan keruh menutupi lensa, semakin cahaya sulit masuk, semakin kabur penglihatan seseorang. Mata Katarak pun menjadi semakin parah.\r\n\r\nKelainan bawaan\r\nPenyebab mata katarak berikutnya adalah kelainan bawaan. Gangguan proses perkembangan embrio saat berada dalam kandungan atau kelainan pada kromosom dapat menyebabkan kekeruhan lensa saat lahir. Seiring bertambahkan usia, kekeruhan ini semakin parah.\r\n\r\nJika katarak akibat penuaan memiliki nama age-related catarcat atau katarak senilis, katarak yang terjadi sejak bayi akibat kelainan bawaan ini memiliki nama katarak kongenital.\r\n\r\nTrauma\r\nPenyakit mata ini juga bisa terjadi akibat trauma yang mengganggu struktur lensa mata baik secara makroskopis maupun mikroskopis. Perubahan struktur lensa dan gangguan keseimbangan metobolisme lensa menyebabkan terbentuknya mata katarak baik terjadi dalam waktu singkat atau justru bertahun-tahun setelah cedera.\r\n\r\nPenyakit sistemik dan penyakit lainnya\r\nFaktor – fator penyakit sistemik atau penyakit lainnya, seperti diabetes mellitus. Akumulasi sorbitol dalam lensa akan menarik air ke dalam lensa sehingga terjadi hidrasi lensa yang menyebabkan penurunan kejernihan lensa. Lensa mata pun menjadi keruh.\r\n\r\nSelain itu, ada pula penyakit lain yang menjadi faktor penyebab. Antara lain glukoma dan uveitis yang mengganggu keseimbangan elektrolit sehingga menyebabkan kekeruhan lensa.\r\n\r\nKebiasaan merokok\r\nSebuah penelitian menunjukkan semakin sering seseorang merokok, semakin besar risikonya mengalami penyakit penyebab kebutaan nomor 1 dunia. Pasalnya, merokok bisa menyebabkan cadangan antioksidan pada mata berkurang, sehingga terjadi oksidasi pada lensa mata.\r\n\r\nSelain itu, merokok juga bisa menyebabkan penumpukan molekul berpigmen 3-hydroxy kyneurine dan chromophores yang menyebabkan warna lensa menjadi kekuningan, tidak lagi jernih. Pada akhirnya, kedua hal ini menjadi penyebab lebih cepat timbulnya mata katarak.\r\nKetahui Gejalanya\r\nKatarak bisa dicegah atau diperlambat dengan menghindari faktor risiko seperti merokok, menjaga pola makan sehat, dan memeriksakan mata secara rutin. Penanganan dini oleh dokter mata juga penting untuk mengurangi risiko komplikasi.\r\n\r\nKenali gejala katarak berikut untuk langkah pencegahan :\r\n\r\nPandangan kabur seperti berkabut\r\nPandangan kabur seperti berkabut atau berasap. Pandangan serasa berkabut ini terjadi pada keseluruhan baik jarak pendek maupun jarak jauh. Ini berbeda dengan kelainan refraksi yang kaburnya pada jarak tertentu. Misalnya pada rabun jauh (miopia), yang tampak buram hanya objek jarak jauh. Sebaliknya, pada rabun dekat (hipermetropi), yang tampak buram hanya objek jarak dekat.\r\n\r\nWarna di sekitar terlihat memudar\r\nJika astigmatisme membuat pandangan menjadi samar dan berbayang, mata katarak selain membuat pandangan berbayang- juga membuat warna tampak memudar.\r\n\r\nTentu gejala ini mengganggu. Sebab mata tidak bisa lagi melihat warna seindah aslinya. Terutama untuk warna terang yang memudar jadi menguning.\r\n\r\nFotofobia (mata mudah silau)\r\nGejala berikutnya adalah mata menjadi mudah silau. Terutama saat melihat lampu mobil, matahari, atau lampu. Istilah untuk gejala ini adalah fotofobia. Mata sensitif terhadap cahaya dan sulit untuk melihat di malam hari.\r\n\r\nPandangan ganda\r\nSelain pandangan berbayang, katarak juga membentuk pandangan ganda. Penderita penyakit mata ini akan melihat satu benda tampak seperti memiliki kembarannya. Tentu keluhan ini juga membuat tidak nyaman.\r\n\r\nMelihat lingkaran di sekeliling cahaya\r\nGejala berikutnya lagi adalah tampaknya lingkaran di sekeliling cahaya. Misalnya pada bola lampu yang pada mata normal terlihat biasa saja, pada penderita katarak akan tampak di sekeliling lampu tersebut tampak terdapat lingkaran.\r\n\r\nBaca juga: Ciri-Ciri Mata Katarak\r\n\r\nTahapan Katarak\r\nKatarak, khususnya karena faktor usia, akan mengalami tiga tahapan:\r\n\r\nKatarak imatur\r\nKatarak matur\r\nKatarak hipermatur\r\nSeiring waktu, protein pada lensa mata mengeras, dan pada tahap katarak hipermatur, protein menjadi keras atau mencair di sekitarnya. Jika tidak diobati, ini dapat meningkatkan tekanan mata, mengganggu saraf, dan berpotensi menyebabkan kebutaan permanen. Meskipun katarak dapat diatasi, kerusakan saraf yang menyebabkan kebutaan tidak bisa diperbaiki.\r\n\r\nApa Saja Bahayanya ?\r\nSelain risiko terbesar berupa kebutaan permanen ketika syaraf mata sudah kena, katarak yang tidak tertangani dengan tepat juga bisa mengakibatkan risiko sosial sebagai berikut:\r\n\r\nKehilangan pekerjaan : Mata yang kabur atau berkabut membuat penderita katarak tidak mendapatkan pekerjaan yang layak. Karena indeks penglihatan 83% sumber olah informasi pada manusia. Jika sudah bekerja, ia terancam mengalami PHK.\r\nKesehatan menurun : Orang yang Katarak yang memiliki tingkat keparahan penyakit cukup tinggi, ia tidak bisa beraktivitas normal sehingga lebih banyak diam. Karena diam dan tidak banyak bergerak, ia bisa terkena penyakit yang lain. Risiko kematian juga naik menjadi 2,6 kali lebih tinggi.\r\nRisiko kecelakaan meningkat :Pandangan kabur dan berkabut akibat katarak bisa mengakibatkan kecelakaan. Terutama jika menyetir kendaraan bermotor sendiri atau menyeberang jalan. Menurut hasil studi, katarak meningkatkan kecelakaan lalu lintas 2,5 kali lebih tinggi.\r\nCara Menyembuhkan Katarak\r\nSeperti penjelasan di atas, katarak tidak bisa sembuh dengan obat-obatan baik farmasi maupun herbal. Hingga saat ini, katarak hanya bisa disebuhkan dengan operasi katarak. Yakni mengganti lensa mata yang keruh dengan lensa buatan yang jernih dan transparan.\r\nKarena katarak adalah keruhnya lensa, ia juga tidak bisa dikoreksi dengan kacamata sebagaimana kelainan refraksi. Kalaupun pada staidum awal pandangan bisa terbantu dengan kacamata, setelah beberapa lama, kacamata itu tidak lagi bisa membantu.\r\n\r\nSatu-satunya cara menyembuhkan katarak adalah dengan mengganti lensa mata melalui operasi katarak. Untuk saat ini, setidaknya ada tiga pilihan teknik operasi katarak sebagai berikut:\r\n\r\nECCE (Extra Capsular Cataract Extraction)\r\nECCE ini merupakan teknik operasi katarak konvensional. Pada operasi katarak ini, lensa dikeluarkan melalui sayatan selebar 8—10 mm. Teknik operasi ini membutuhkan waktu penyembuhan dan pemulihan yang cukup lama.\r\n\r\nSICS (Small Incision Cataract Surgery)\r\nTeknik operasi SICS lebih canggih. Ia menggunakan jahitan dengan sayatan 6—10 mm. Proses operasinya juga lebih singkat, sekitar 15-30 menit.\r\n\r\nPhacoemulsification\r\nOperasi katarak dengan teknik phacoemulsification adalah metode tanpa jahitan yang lebih canggih, memakan waktu sekitar 10-15 menit dan menawarkan pemulihan yang cepat. Pasien dapat pulang langsung setelah prosedur, dengan penyembuhan yang biasanya memerlukan waktu 2 minggu hingga 1 bulan.\r\n\r\nBaca juga: Operasi Katarak Gratis\r\n\r\nCara Mencegahnya\r\nMeski penuaan tidak bisa dihindari, kita dapat mencegah katarak dengan menghindari faktor penyebab dan menjaga kesehatan mata. Beberapa orang lanjut usia masih memiliki penglihatan yang baik.\r\n\r\nNah, berikut ini beberapa cara mencegah katarak yang bisa kita optimalkan. antara lain :\r\n\r\nHindari merokok\r\nKebiasaan merokok merupakan salah satu penyebab percepatan katarak. Jika belum bisa meninggalkan secara langsung, mulai kurangi secara bertahap hingga nanti bisa berhenti sepenuhnya untuk tidak merokok.\r\n\r\nJaga pola makan dan gaya hidup\r\nJaga pola makan dan gaya hidup agar tetap sehat agar kadar gula tetap normal. Tidak sampai terkena diabetes mellitus yang merupakan penyakit sistemik penyebab katarak.\r\n\r\nKonsumsi makanan yang kaya antioksidan dan vitamin A untuk menjaga kesehatan mata. Juga menjaga berat badan tubuh agar tetap ideal.\r\n\r\nPeriksa mata secara rutin\r\nPeriksakan mata secara rutin ke dokter dan lakukan konsultasi dokter mata. Ketika diagnosis menunjukkan ada gangguan mata, termasuk gejala katarak, dokter akan sedini mungkin mengambil tindakan yang tepat.\r\n\r\nJaga dan lindungi mata\r\nLindungi mata agar tidak terbentur, tidak terjadi trauma. Juga lindungi mata dari paparan matahari secara langsung.', '2024-12-10', '2024-12-09 19:23:28', 19, 'https://kmu.id/mata-katarak-penyebab-gejala/');

-- --------------------------------------------------------

--
-- Table structure for table `laboratory`
--

CREATE TABLE `laboratory` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `no_antrian` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `saran` varchar(500) DEFAULT NULL,
  `visit` varchar(500) DEFAULT NULL,
  `obat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laboratory`
--

INSERT INTO `laboratory` (`id`, `username`, `fullname`, `title`, `harga`, `date`, `no_antrian`, `status`, `saran`, `visit`, `obat`) VALUES
(7, 'Dew', 'Dewi Massitoh', 'Blood Paket 1', '510000', '2024-12-18 15:46:47', 1, 'unpaid', NULL, NULL, NULL),
(8, 'Dew', 'Dewi Massitoh', 'Blood Paket 2', '750000', '2024-12-18 15:46:47', 1, 'unpaid', NULL, NULL, NULL),
(9, 'wiwik', 'Wiwik Ainun Janah', 'KULTUR / RESISTEN', '510000', '2024-12-18 15:46:47', 1, 'unpaid', NULL, NULL, NULL),
(10, 'khoir', 'siti khoirul muzaroah', 'Biomolekuler Paket 2', '750000', '2024-12-18 15:46:47', 1, 'unpaid', NULL, NULL, NULL),
(19, 'yasmin', 'Yasmin azzahra', 'Biomolekuler Paket 1', '510000', '2024-12-18 02:30:00', 2, 'upcoming', NULL, NULL, NULL),
(24, 'Fatimah', 'Fatimah Azzahra ', 'Mikrobiologi Kultur / Resisten', '510000', '2024-12-20 02:30:00', 1, 'completed', 'Jaga Kesehatan', 'sudah', 'Indomie'),
(25, 'Fatimah', 'Fatimah Azzahra ', 'Mikrobiologi Kultur / Resisten', '510000', '2024-12-20 02:30:00', 2, 'completed', 'sering ke lab', 'sudah', 'html'),
(26, 'Fatimah', 'Fatimah Azzahra ', 'Mikrobiologi Kultur / Resisten', '510000', '2024-12-20 02:30:00', 2, 'completed', 'jaga', 'sudah', '5,6,'),
(30, 'Fatimah', 'Fatimah Azzahra ', 'Mikrobiologi Kultur / Resisten', '510000', '2024-12-20 02:30:00', 3, 'completed', 'ayo ke lab', 'sudah', '11,4,6,');

-- --------------------------------------------------------

--
-- Table structure for table `lab_data`
--

CREATE TABLE `lab_data` (
  `id` int(11) NOT NULL,
  `paket` varchar(50) NOT NULL,
  `deskripsi` varchar(250) NOT NULL,
  `kategori` enum('Mikrobiologi','Anatomy','Blood','Biomolekuler','Patology','Parasitology') NOT NULL,
  `harga` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lab_data`
--

INSERT INTO `lab_data` (`id`, `paket`, `deskripsi`, `kategori`, `harga`) VALUES
(1, 'Paket 1', 'Sitologi cairan tubuh / papsmear, FNA thyroid/struma', 'Anatomy', 510000),
(2, 'Paket 2', 'Histopatologi, Potong beku, Imunohistokimia', 'Anatomy', 750000),
(4, 'Paket 1', 'Hematologi, Kimia Darah, Mimunologi, Serologi', 'Biomolekuler', 510000),
(5, 'Paket 2', 'Curinalisa, MTinja, Mikrobiologi, Parasitologi', 'Biomolekuler', 750000),
(6, 'Paket 1', 'Uji Faal Hati, Uji Faal Jantung, Uji Faal Ginjal', 'Blood', 510000),
(7, 'Paket 2', 'Lemak Darah, Kadar Gula Darah, Elekrolit Darah, Nalisa Gas darah', 'Blood', 750000),
(8, 'Kultur / Resisten', 'Hematologi Lengkap (DL), Urine, Feeces, CS F, Sputum', 'Mikrobiologi', 510000),
(9, 'Paket 2', 'Gram, Diphateriae, BTA, Trichomonas, Gonorhoe, Jamur / spora', 'Mikrobiologi', 750000),
(10, 'Taksonomi', 'Stool Tests, Blood Tests, Skin Tests', 'Parasitology', 500000),
(11, 'Morflogy', 'Stool Tests, Blood Tests, Urine Tests, Nail and Skin Tests, Body Fluid Tests', 'Parasitology', 550000),
(14, 'Paket 1', 'Uji Faal Hati, Uji Faal Jantung, Uji Faal Ginjal', 'Patology', 500000),
(15, 'Paket 2', 'Lemak Darah, Kadar Gula Darah, Elekrolit Darah, Nalisa Gas darah', 'Patology', 750000),
(17, 'Paket 8', 'hdsmkxl', 'Mikrobiologi', 499000);

-- --------------------------------------------------------

--
-- Table structure for table `mcu`
--

CREATE TABLE `mcu` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `no_antrian` int(11) NOT NULL,
  `saran` varchar(500) DEFAULT NULL,
  `visit` varchar(500) DEFAULT NULL,
  `obat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mcu`
--

INSERT INTO `mcu` (`id`, `username`, `fullname`, `title`, `harga`, `status`, `date`, `no_antrian`, `saran`, `visit`, `obat`) VALUES
(171, 'Dew', 'Dewi Massitoh', 'School Age', '750000', 'upcoming', '2024-12-18 14:40:12', 1, NULL, NULL, NULL),
(173, 'wiwik', 'Wiwik Ainun Janah', 'Basic Screening', '499000', 'upcoming', '2024-12-18 13:40:12', 1, NULL, NULL, NULL),
(174, 'wiwik', 'Wiwik Ainun Janah', 'Basic Screening', '499000', 'upcoming', '2024-12-18 14:40:15', 2, NULL, NULL, NULL),
(175, 'khoir', 'siti khoirul muzaroah', 'Basic Screening', '499000', 'upcoming', '2024-12-19 14:40:20', 1, NULL, NULL, NULL),
(184, 'Fatimah', 'Fatimah Azzahra ', 'Heart Risk Factors 1', '500000', 'completed', '2024-12-20 02:30:00', 1, 'Lebih banyak istirahat', 'sudah', 'Antangin'),
(185, 'Fatimah', 'Fatimah Azzahra ', 'Heart Risk Factors 1', '500000', 'completed', '2024-12-20 02:30:00', 2, 'makan yang banyak', 'sudah', 'energen'),
(186, 'Fatimah', 'Fatimah Azzahra ', 'Heart Risk Factors 1', '500000', 'completed', '2024-12-20 02:30:00', 2, 'ppppp', 'sudah', '5,3,');

-- --------------------------------------------------------

--
-- Table structure for table `mcu_data`
--

CREATE TABLE `mcu_data` (
  `id` int(11) NOT NULL,
  `paket` varchar(50) NOT NULL,
  `deskripsi` varchar(250) NOT NULL,
  `kategori` enum('Heart','Children','Eldery','Travelling','Pre-Wedding','General MCU') NOT NULL,
  `harga` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mcu_data`
--

INSERT INTO `mcu_data` (`id`, `paket`, `deskripsi`, `kategori`, `harga`) VALUES
(4, 'Heart Risk Factors 1', 'MCU General Practitioner Consultation, Complete Blood, Urea, Gout, Total cholesterol, Triglycerides, LDL Cholesterol, HDL Cholesterol, Fasting Blood Sugar, EKG Specialist Doctor, SARS CoV-2 antigen, Creatinine, PP Blood Sugar', 'Heart', '500000'),
(5, 'Heart Risk Factors 2', 'Complete Blood, Urea, Gout, Total cholesterol, Triglycerides, LDL Cholesterol, HDL Cholesterol, Fasting Blood Sugar, Treadmill Test, SARS CoV-2 antigen, Cardiac Specialist Examination, Creatinine, PP Blood Sugar', 'Heart', '650000'),
(6, 'Basic Screening', 'MCU General Practitioner Consultation, Complete Blood, HBsAg, Hepatitis, Thorax AP/PA, Complete Urine', 'General MCU', '499000'),
(7, 'MCU For Nanny', 'MCU General Practitioner Consultation, Complete Blood, Thorax AP/PA, Complete urine, Fasting Blood Glucose, EIA Pregnancy', 'General MCU', '400000'),
(8, 'MCU For Driver', 'MCU General Practitioner Consultation, Complete Blood, EKG Specialist Doctor, Thorax AP/PA, Complete urine, Fasting Blood Glucose', 'General MCU', '600000'),
(9, 'Foodhandler Typhoid Vaccine Booster Package', 'MCU General Practitioner Consultation, Medical Devices, Typhoid Vaccine', 'General MCU', '499000'),
(10, 'Hepatitis A Foodhandler Booster Vaccine Package', 'MCU General Practitioner Consultation, Medical Devices, Hepatitis A Vaccine', 'General MCU', '599000'),
(11, 'Foodhandler Complete Vaccine Package', 'MCU General Practitioner Consultation, Hepatitis A and Typhoid Vaccine, Medical Devices', 'General MCU', '799000'),
(12, 'MCU Drugs', 'MCU General Practitioner Consultation, Opiates/Morphine, Cannabis/THC/Marijuana, Amphetamine', 'General MCU', '435000'),
(13, 'Foodhandler Complete Vaccine Package', 'MCU General Practitioner Consultation, Hepatitis A and Typhoid Vaccine, Medical Devices', 'General MCU', '799000'),
(14, 'MCU Drugs', 'MCU General Practitioner Consultation, Opiates/Morphine, Cannabis/THC/Marijuana, Amphetamine', 'General MCU', '435000'),
(21, 'Pre School', 'Thorax X-ray, Complete Blood, Complete Urine, Morning Snack and Lunch, General Practitioner Examination', 'Children', '510000'),
(22, 'School Age', 'Thorax X-ray, Complete Blood, Complete Urine, Morning Snack and Lunch, Eye Specialist Examination, General Practitioner Examination', 'Children', '750000'),
(23, 'School Children Package (Basic)', 'Complete Blood, HBA1C, Total Cholesterol, Complete urine, MCU doctor consultation', 'Children', '500000'),
(24, 'School Children Package (Silver)', 'Complete Blood, General Practitioner EKG, HBA1C, Total Cholesterol, Complete urine, MCU Specialist Doctor Consultation (DENTAL), MCU doctor consultation', 'Children', '750000'),
(25, 'School Children Package (Platinum)', 'Complete Blood, General Practitioner EKG, HBA1C, Thorax AP/PA, Total Cholesterol, Complete urine, MCU doctor consultation', 'Children', '1000000'),
(27, 'Senior Citizen (Male)', 'Complete Blood, Complete Urine, SGPT, SGOT, Urea, Creatinine, Gout, Total Cholesterol, Triglycerides, PSAs, Physical Examination, Internal Medicine Specialist Examination, HBA1c, Whole Abdomen Ultrasound, HBsAG, Thorax X-ray, HDL, LDL, Morning Snack ', 'Eldery', '3000000'),
(31, 'Pre Marital', 'Complete Blood, Complete Urine, EKG Specialist Doctor, HBsAg, Blood Type / Rhesus, VDRL, Anti HIV 3 Methods, MCU General Practitioner Consultation, Thorax AP/PA', 'Pre-Wedding', '1250000'),
(32, 'Men\'s Pre-Marriage', 'Thorax X-ray, Abdominal Ultrasound, VDRL, Physical Examination, Complete Urine, HBsAG, Blood Type / Rhesus, Morning Snack and Lunch', 'Pre-Wedding', '1250000'),
(33, 'Women\'s Pre-Marriage', 'Thorax X-ray, Complete Urine, Obstetrician Ultrasound, VDRL, Physical Examination, HBsAG, Blood Type / Rhesus, Morning Snack and Lunch, Consultation from Sp.OG', 'Pre-Wedding', '1250000');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` int(11) NOT NULL,
  `medname` varchar(100) NOT NULL,
  `category` enum('Pills','Syrup','External Medications') NOT NULL,
  `stock` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `medgambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `medname`, `category`, `stock`, `deskripsi`, `harga`, `medgambar`) VALUES
(3, 'Panadol Extra 10 Kaplet', 'Pills', 20, 'PANADOL EXTRA merupakan obat dengan kandungan Paracetamol dan Caffeine. Obat ini dapat digunakan untuk meringankan sakit kepala dan sakit gigi. Paracetamol sebagai analgetik, bekerja dengan meningkatkan ambang rasa sakit dan Caffeine bekerja dengan mengha', '15500', 'panadol.png'),
(4, 'Hansaplast Salep Luka 20g', 'External Medications', 30, ' Hansaplast Salep Luka 20 g merupakan salep penutup luka dengan kandungan white petrolatum, thin paraffin oil, ceresin wax, glycerin, panthenol, glyceryl stearate. Formulasi pada produk ini digunakan untuk membantu proses penyembuhan luka dengan mengurang', '50500', 'hansaplast.png'),
(5, 'Tolak Angin Cair', 'Syrup', 100, 'TOLAK ANGIN CAIR PLUS MADU merupakan obat herbal terstandar yang mengandung kombinasi berbagai herbal alami yang dapat digunakan untuk membantu memelihara atau menjaga daya tahan tubuh dan meringankan gejala masuk angin.', '19100', 'tolakangin.png'),
(6, 'Enervon-C 4 Tablet', 'Pills', 20, 'ENERVON C merupakan suplemen makanan dengan kandungan multivitamin seperti Vitamin C, Vitamin B1, Vitamin B2, Vitamin B6, Vitamin B12, Vitamin D, Niacinamide, Kalsium pantotenat dalam bentuk tablet salut. Suplemen vitamin ini berguna untuk membantu menjag', '6500', 'enervon.png'),
(7, 'Salep Kulit 88 6g', 'External Medications', 30, 'SALEP KULIT 88 merupakan obat luar yang mengandung Salicylic acid, Benzoic acid, dan Sulfur praecipitatum. Obat ini digunakan untuk membantu meringankan penyakit kulit yang disebabkan oleh jamur seperti gatal-gatal, panu, kadas, kudis, kurap, dan kutu air', '17700', '88.png'),
(8, 'Alpara Sirup 60 ml', 'Syrup', 15, 'ALPARA SIRUP merupakan obat yang digunakan untuk mengatasi', '10000', 'alpara.png'),
(9, 'Desoximetasone 0.25% Salep 15g', 'External Medications', 10, 'DESOXIMETASONE CREAM merupakan obat golongan kortikosteroid topikal. Obat ini digunakan untuk radang akut yang berat, kelainan kulit alergis dan kronis, psoriasis. Dalam penggunaan obat ini harus SESUAI DENGAN PETUNJUK DOKTER.', '30900', 'desoximetasone.png'),
(10, 'Imunped Sirup 60 ml', 'Syrup', 35, 'IMUNPED SIRUP merupakan suplemen makanan yang mengandung vitamin c dan zinc sulfat. Suplemen ini digunakan sebagai suplementasi zinc dan vitamin c pada anak-anak.', '63500', 'imunped.png'),
(11, 'Sangobion 10 Kapsul', 'Pills', 30, 'SANGOBION adalah vitamin dan zat besi penambah darah dengan kandungan Ferrous gluconate, manganese sulfate, copper Sulfate, vitamin C, folic acid, vitamin B12. Kandungan pada produk ini membantu proses pembentukan hemoglobin ditubuh sehingga dapat membant', '22000', 'sangobion.png');

-- --------------------------------------------------------

--
-- Table structure for table `med_cart`
--

CREATE TABLE `med_cart` (
  `id` int(11) NOT NULL,
  `med_id` int(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `waktu_transaksi` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `med_cart`
--

INSERT INTO `med_cart` (`id`, `med_id`, `qty`, `username`, `status`, `waktu_transaksi`) VALUES
(48, 4, 1, 'Fatimah', 'completed', '2024-12-20 16:44:39'),
(55, 3, 12, 'Fatimah', 'completed', '2024-12-20 16:44:39'),
(58, 3, 9, 'Fatimah', 'completed', '2024-12-20 16:44:39'),
(61, 3, 5, 'Fatimah', 'completed', '2024-12-20 16:44:39'),
(65, 5, 5, 'Fatimah', 'unpaid', NULL),
(66, 3, 5, 'Fatimah', 'unpaid', NULL),
(69, 3, 5, 'Fatimah', 'unpaid', NULL),
(70, 6, 6, 'Fatimah', 'unpaid', NULL),
(71, 11, 5, 'Fatimah', 'unpaid', NULL),
(72, 4, 3, 'Fatimah', 'unpaid', NULL),
(73, 6, 1, 'Fatimah', 'unpaid', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `poli_name` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`poli_name`, `harga`) VALUES
('Cardiologist', 240000),
('Dentist', 400000),
('Gastroenteritis', 180000),
('General', 200000),
('Orthopaedic', 230000),
('Otology', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_kesehatan`
--

CREATE TABLE `riwayat_kesehatan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `penyakit_kronis` text DEFAULT NULL COMMENT 'Riwayat penyakit kronis, seperti diabetes atau hipertensi',
  `alergi` text DEFAULT NULL COMMENT 'Alergi terhadap makanan, obat, atau lainnya',
  `operasi` text DEFAULT NULL COMMENT 'Riwayat operasi yang pernah dilakukan',
  `rawat_inap` text DEFAULT NULL COMMENT 'Riwayat rawat inap di rumah sakit',
  `obat_saat_ini` text DEFAULT NULL COMMENT 'Obat-obatan yang sedang dikonsumsi',
  `terapi_saat_ini` text DEFAULT NULL COMMENT 'Terapi yang sedang dijalani, seperti fisioterapi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_medicine` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `waktu_transaksi` date DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_medicine`, `jumlah`, `total_harga`, `waktu_transaksi`, `tanggal_transaksi`) VALUES
(26, 4, 42, 50000, '2024-12-01', '2024-12-01'),
(27, 4, 41, 30000, '2024-12-02', '2024-12-02'),
(28, 3, 43, 75000, '2024-12-03', '2024-12-03'),
(29, 4, 45, 150000, '2024-12-04', '2024-12-04'),
(30, 5, 42, 60000, '2024-12-05', '2024-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `rating` enum('1','2','3','4','5') NOT NULL,
  `category` varchar(50) NOT NULL,
  `review` text NOT NULL,
  `reply` text NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id`, `username`, `rating`, `category`, `review`, `reply`, `gambar`) VALUES
(7, 'khoir', '5', 'Facilities', 'wow\r\n', '', ''),
(8, 'khoir', '5', 'Facilities', 'wow\r\n', '', ''),
(9, 'wiwik', '4', 'Place', 'abc', '', ''),
(10, 'wiwik', '4', 'Place', 'abc', '', ''),
(11, 'wiwik', '5', 'Service', 'ramah', '', ''),
(12, 'wiwik', '5', 'Service', 'ramah', '', ''),
(13, 'wiwik', '4', 'Place', 'abc', '', ''),
(14, 'fatimah', '5', 'Facilities', 'fasilitas lengkap dan bagus', '', 'WIN_20240516_08_30_33_Pro668159142a690.jpg'),
(15, 'Dew', '5', 'Medicine', 'Good', '', 'kitten-7901442_12806682152ae5649.jpg'),
(16, 'Dew', '5', 'Medicine', 'Good', 'thank youu', 'kitten-7901442_12806682152ae5649.jpg'),
(17, 'fatimah', '4', 'Place', 'tempatnya bersih', 'makasi review', 'kitten-7901442_1280668229020ee0b.jpg'),
(18, 'Fatimah', '4', 'Facilities', 'fasilitas memuaskan', 'thank youu', 'kitten-7901442_1280668229020ee0b.jpg'),
(19, 'Fatimah', '4', 'Facilities', 'fasilitas memuaskan', 'makaci', 'kitten-7901442_1280668229020ee0b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(50) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `role` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1: user, 2: admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `username`, `email`, `password`, `fullname`, `dob`, `phone`, `gender`, `gambar`, `role`) VALUES
(36, 'Fatimah', 'fatimahazzahra@gmail.com', 'fatimah', 'Fatimah Azzahra ', '2000-06-28', '08993339888', 'female', 'kitten-7901442_1280668229020ee0b.jpg', '1'),
(37, 'yasmin', 'yasminazzahra@gmail.com', 'yasmin12345', 'Yasmin azzahra', '2004-12-09', '086543776573', 'female', 'Screenshot 2024-04-02 17442066815c52469d5.png', '1'),
(38, 'Dew', 'Dewimasito@gmail.com', 'Dew', 'Dewi Massitoh', '2024-06-30', '0812345678', 'female', 'kitten-7901442_12806682152ae5649.jpg', '1'),
(41, 'admin', 'admin@gmail.com', 'admin123', '', '0000-00-00', '', '', '', '2'),
(42, 'wiwik', 'wiwik@gmail.com', 'wiwik123', 'Wiwik Ainun Janah', '2005-08-13', '085708654651', 'female', 'kitten-7901442_128066821b6e96909.jpg', '1'),
(43, 'khoir', 'khoir@gmail.com', '12345', 'siti khoirul muzaroah', '2005-07-07', '085433277746', 'female', '', '1'),
(44, 'maharani', 'maharani@gmail.com', '1234', 'a', '2024-07-17', '33', 'other', '', '1'),
(45, 'ciawra', 'ci@gmail.com', '123', 'w', '2024-07-17', '7', 'male', '', '1'),
(46, 'rara', 'rara1@gmai;.com', '123', 'rara', '2024-07-02', '9', 'male', '', '1'),
(47, 'Dewi', 'Dewim@gmail.com', '123', 'Dewi masssitoh trimuji', '2024-07-01', '08123456789', 'female', '', '1'),
(55, 'dwi', 'dwi@gmail.com', 'dwi', 'Yasmin azzahra', '2024-10-29', '086543776573', 'other', '', '1'),
(56, 'Edith Farith', 'edith@gmail.com', 'edith', 'Dr Edith Farith', '1995-02-10', '086543776573', 'male', 'doctor674ee6ba2e1f1.png', '1'),
(65, 'Janneth William', 'janneth@gmail.com', 'janneth', 'Janneth William', '1992-05-03', '085433277746', 'female', '675487045d16e.png', '1'),
(66, 'Reinath Salsa', 'reinath@gmail.com', 'reinath', 'Reinath Salsa', '2000-02-04', '08993339888', 'female', '6754878560bbd.png', '1'),
(67, 'William Smith', 'william@gmail.com', 'william', 'William Smith', '1996-11-14', '0832747583912', 'male', '675487def0bae.png', '1'),
(68, 'Budi Rejani', 'budi@gmail.com', 'budi', 'Budi Rejani', '1995-10-17', '083847563928', 'male', '67548b5738818.png', '1'),
(69, 'Samira Renata', 'samira@gmail.com', 'samira', 'Samira Renata', '2001-07-11', '08374628161', 'female', '67548ba57bcaf.jpg', '1'),
(70, 'Ade Teguh Pradigara', 'adeteguh@gmail.com', 'adeteguh', 'Ade Teguh Pradigara', '1994-06-07', '089474625122', 'male', '67548c02f195e.jpg', '1'),
(71, 'Ana Maria', 'ana@gmail.com', 'ana', 'Ana Maria', '1995-09-11', '084759385746', 'female', '67548c5a42051.jpg', '1'),
(72, 'Yusfian Brahmantio', 'yusfian@gmail.com', 'yusfian', 'Yusfian Brahmantio', '1999-10-27', '084756382938', 'male', '67548cad9d027.jpg', '1'),
(73, 'Diana Salsabila', 'diana@gmail.com', 'diana', 'Diana Salsabila', '2001-08-30', '083645273832', 'female', '67548cfd53f88.jpg', '1'),
(74, 'Liam Hermawan', 'liam@gmail.com', 'liam', 'Liam Hermawan', '1993-09-02', '084758392847', 'male', '67548d45b58bf.webp', '1'),
(75, 'Reihan Firmansyah', 'reihan@gmail.com', 'reihan', 'Reihan Firmansyah', '1996-01-19', '083474628211', 'male', '67548d995c577.jpg', '1'),
(76, 'Dwi Puspita', 'dwipuspita@gmail.com ', 'dwipuspita', 'Dwi Puspita', '1999-03-09', '08376647282', 'female', '67548ddebf85e.jpg', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`mcu_id`),
  ADD KEY `mcu_id` (`mcu_id`);

--
-- Indexes for table `favorites_dokter`
--
ALTER TABLE `favorites_dokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokter_id` (`dokter_id`);

--
-- Indexes for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indexes for table `kiat_news`
--
ALTER TABLE `kiat_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laboratory`
--
ALTER TABLE `laboratory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_data`
--
ALTER TABLE `lab_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mcu`
--
ALTER TABLE `mcu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mcu_data`
--
ALTER TABLE `mcu_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `med_cart`
--
ALTER TABLE `med_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `med_id` (`med_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`poli_name`);

--
-- Indexes for table `riwayat_kesehatan`
--
ALTER TABLE `riwayat_kesehatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `favorites_dokter`
--
ALTER TABLE `favorites_dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `kiat_news`
--
ALTER TABLE `kiat_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `laboratory`
--
ALTER TABLE `laboratory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `lab_data`
--
ALTER TABLE `lab_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `mcu`
--
ALTER TABLE `mcu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT for table `mcu_data`
--
ALTER TABLE `mcu_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `med_cart`
--
ALTER TABLE `med_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `riwayat_kesehatan`
--
ALTER TABLE `riwayat_kesehatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites_dokter`
--
ALTER TABLE `favorites_dokter`
  ADD CONSTRAINT `favorites_dokter_ibfk_1` FOREIGN KEY (`dokter_id`) REFERENCES `dokter` (`id`);

--
-- Constraints for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD CONSTRAINT `jadwal_dokter_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `med_cart`
--
ALTER TABLE `med_cart`
  ADD CONSTRAINT `med_cart_ibfk_1` FOREIGN KEY (`med_id`) REFERENCES `medicine` (`id`),
  ADD CONSTRAINT `med_cart_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user_data` (`username`);

--
-- Constraints for table `riwayat_kesehatan`
--
ALTER TABLE `riwayat_kesehatan`
  ADD CONSTRAINT `riwayat_kesehatan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_data` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
