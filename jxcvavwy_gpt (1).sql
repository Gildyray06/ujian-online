-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 12, 2024 at 02:16 PM
-- Server version: 10.3.39-MariaDB
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jxcvavwy_gpt`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `nama_user` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `nama_user`, `username`, `password`) VALUES
(1, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int(11) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nama_guru`, `username`, `password`) VALUES
(9222, 'arief', 'ariefc', 'cahya23'),
(123678459, 'ismail soleh', 'mail', '123456'),
(1234567890, 'Dede Iwan Hermawan', 'dede', '123456'),
(2147483647, 'Fajar Hikmal', 'jayous', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jawaban`
--

CREATE TABLE `tb_jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id_soal_ujian` int(11) NOT NULL,
  `jawaban` varchar(255) NOT NULL,
  `skor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_jawaban`
--

INSERT INTO `tb_jawaban` (`id_jawaban`, `id_peserta`, `id_soal_ujian`, `jawaban`, `skor`) VALUES
(1, 2, 1, 'A', '1'),
(2, 2, 1, 'A', '1'),
(3, 2, 1, 'A', '1'),
(4, 7, 1, 'A', '1'),
(5, 7, 2, 'B', '0'),
(6, 9, 1, 'D', '0'),
(7, 10, 1, 'C', '1'),
(8, 10, 2, 'A', '1'),
(9, 13, 7, 'A', '1'),
(10, 13, 6, 'B', '0'),
(11, 15, 7, 'A', '1'),
(12, 15, 8, 'D', '1'),
(13, 15, 6, 'A', '1'),
(14, 17, 9, 'A', '1'),
(15, 17, 8, 'D', '1'),
(16, 17, 7, 'A', '1'),
(17, 17, 6, 'E', '0'),
(18, 14, 8, 'E', '0'),
(19, 14, 6, 'E', '0'),
(20, 14, 7, 'A', '1'),
(21, 14, 9, 'E', '0'),
(22, 25, 6, 'A', '1'),
(23, 25, 15, 'A', '0'),
(24, 25, 4, 'C', '0'),
(25, 25, 11, 'A', '0'),
(26, 25, 1, 'A', '0'),
(27, 25, 16, 'E', '1'),
(28, 25, 3, 'C', '1'),
(29, 25, 2, 'C', '0'),
(30, 25, 9, 'B', '0'),
(31, 25, 10, 'A', '0'),
(32, 25, 12, 'A', '0'),
(33, 25, 7, 'D', '0'),
(34, 25, 14, 'D', '0'),
(35, 25, 8, 'A', '0'),
(36, 25, 13, 'B', '1'),
(37, 35, 9, 'A', '0'),
(38, 35, 1, 'A', '1'),
(39, 35, 4, 'C', '0'),
(40, 35, 8, 'C', '0'),
(41, 35, 10, 'A', '0'),
(42, 35, 5, 'C', '0'),
(43, 35, 2, 'A', '0'),
(44, 35, 7, 'B', '0'),
(45, 35, 3, 'A', '0'),
(46, 38, 4, 'D', '1'),
(47, 38, 8, 'E', '1'),
(48, 38, 10, 'E', '1'),
(49, 38, 5, 'A', '1'),
(50, 38, 9, 'E', '1'),
(51, 38, 2, 'E', '1'),
(52, 38, 12, 'B', '0'),
(53, 38, 3, 'A', '0'),
(54, 38, 7, 'D', '0'),
(55, 38, 11, 'A', '0'),
(56, 38, 1, 'A', '1'),
(57, 38, 13, 'C', '1'),
(63, 39, 18, 'Menggunakan teknologi pengenalan wajah dan suara', '5'),
(64, 39, 20, 'A', '1'),
(65, 39, 17, 'Memberikan feedback kepada guru', '0'),
(66, 39, 19, 'E', '1'),
(67, 39, 16, 'B', '1'),
(68, 49, 18, 'test', '0'),
(69, 49, 22, 'B', '1'),
(70, 49, 19, 'A', '0'),
(71, 49, 17, 'test', '0'),
(72, 49, 20, 'B', '0'),
(73, 49, 24, 'C', '0'),
(74, 49, 16, 'C', '0'),
(75, 49, 23, 'test', '0'),
(76, 49, 25, 'test', '0'),
(77, 50, 22, 'B', '1'),
(78, 50, 17, 'test', '0'),
(79, 50, 24, 'C', '0'),
(80, 50, 18, 'test', '0'),
(81, 50, 23, 'text', '0'),
(82, 50, 20, 'C', '0'),
(83, 50, 19, 'B', '0'),
(84, 50, 16, 'B', '1'),
(85, 50, 25, 'test', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_ujian`
--

CREATE TABLE `tb_jenis_ujian` (
  `id_jenis_ujian` int(11) NOT NULL,
  `jenis_ujian` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_jenis_ujian`
--

INSERT INTO `tb_jenis_ujian` (`id_jenis_ujian`, `jenis_ujian`) VALUES
(1, 'UTS Ganjil '),
(3, 'UAS Genap');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, '7A'),
(2, '7B'),
(3, '8A'),
(4, '8B'),
(5, '9A'),
(6, '9B');

-- --------------------------------------------------------

--
-- Table structure for table `tb_matapelajaran`
--

CREATE TABLE `tb_matapelajaran` (
  `id_matapelajaran` int(11) NOT NULL,
  `kode_matapelajaran` varchar(10) NOT NULL,
  `nama_matapelajaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_matapelajaran`
--

INSERT INTO `tb_matapelajaran` (`id_matapelajaran`, `kode_matapelajaran`, `nama_matapelajaran`) VALUES
(17, '071', 'Bahasa Indonesia'),
(18, '072', 'Matematika'),
(19, '073', 'Bahasa Inggris'),
(20, '081', 'Bahasa Indonesia'),
(21, '082', 'Matematika'),
(22, '083', 'Matematika'),
(23, '091', 'Bahasa Indonesia'),
(24, '092', 'Matematika'),
(25, '093', 'Bahasa Inggris');

-- --------------------------------------------------------

--
-- Table structure for table `tb_materi`
--

CREATE TABLE `tb_materi` (
  `id_materi` int(11) NOT NULL,
  `nama_materi` varchar(50) NOT NULL,
  `pdf_materi` varchar(255) NOT NULL,
  `txt_materi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_materi`
--

INSERT INTO `tb_materi` (`id_materi`, `nama_materi`, `pdf_materi`, `txt_materi`) VALUES
(23, 'Materi kelas 1 ', 'Kelas_I_Tema_1_BS_press-662.pdf', '1720620484.txt');

-- --------------------------------------------------------

--
-- Table structure for table `tb_peserta`
--

CREATE TABLE `tb_peserta` (
  `id_peserta` int(11) NOT NULL,
  `id_matapelajaran` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_jenis_ujian` int(11) NOT NULL,
  `tanggal_ujian` date NOT NULL,
  `jam_ujian` time NOT NULL,
  `durasi_ujian` int(11) NOT NULL,
  `timer_ujian` int(11) NOT NULL,
  `status_ujian` tinyint(1) NOT NULL,
  `status_ujian_ujian` int(11) NOT NULL,
  `benar` varchar(20) NOT NULL,
  `salah` varchar(20) NOT NULL,
  `nilai` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_peserta`
--

INSERT INTO `tb_peserta` (`id_peserta`, `id_matapelajaran`, `id_siswa`, `id_jenis_ujian`, `tanggal_ujian`, `jam_ujian`, `durasi_ujian`, `timer_ujian`, `status_ujian`, `status_ujian_ujian`, `benar`, `salah`, `nilai`) VALUES
(25, 0, 15, 1, '2023-12-25', '01:45:00', 120, 7200, 1, 0, '4', '11', '26.6666666'),
(26, 0, 17, 1, '2023-12-25', '02:45:00', 90, 5400, 1, 0, '', '', ''),
(35, 0, 18, 1, '2024-03-24', '20:30:00', 10, 600, 2, 2, '1', '8', '11.1111111'),
(40, 0, 20, 3, '2024-06-28', '10:00:00', 90, 5400, 1, 0, '', '', ''),
(41, 0, 21, 3, '2024-06-28', '10:00:00', 90, 5400, 1, 0, '', '', ''),
(42, 0, 22, 3, '2024-06-28', '10:00:00', 90, 5400, 1, 0, '', '', ''),
(43, 0, 23, 3, '2024-06-28', '10:00:00', 90, 5400, 1, 0, '', '', ''),
(44, 0, 24, 3, '2024-06-28', '10:00:00', 90, 5400, 1, 0, '', '', ''),
(45, 0, 25, 3, '2024-06-28', '10:00:00', 90, 5400, 1, 0, '', '', ''),
(46, 0, 26, 3, '2024-06-28', '10:00:00', 90, 5400, 1, 0, '', '', ''),
(47, 0, 27, 3, '2024-06-28', '10:00:00', 90, 5400, 1, 0, '', '', ''),
(48, 0, 28, 3, '2024-06-28', '10:00:00', 90, 5400, 1, 0, '', '', ''),
(49, 0, 29, 1, '2024-07-02', '20:00:00', 120, 7200, 2, 2, '1', '6', '4'),
(50, 0, 32, 1, '2024-07-03', '11:00:00', 120, 7200, 2, 2, '2', '7', '8');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `nis` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `id_kelas`, `nama_siswa`, `nis`, `username`, `password`) VALUES
(21, 0, 'Ahmad Fauzi', 12345678, 'fauzi', 'fauzi'),
(22, 0, 'Budi Santoso', 12345679, 'Budi', 'budi'),
(23, 0, 'Citra Dewi', 12345680, 'Citra', 'citra'),
(24, 0, 'Dian Pratama', 12345681, 'Dian', 'dian'),
(25, 0, 'Guntur Wijaya', 12345682, 'Guntur', 'guntur'),
(26, 0, 'Joko Prasetyo', 12345683, 'Joko', 'joko'),
(27, 0, 'Faiz Suharto', 12345684, 'Faiz', 'faiz'),
(28, 0, 'Eca Shesar', 12345685, 'Eca', 'eca'),
(29, 0, 'arief', 123456789, 'arief', 'Go123456'),
(32, 0, 'Gildiray Thaib', 20523072, 'Gildiray', 'Gorontal0'),
(33, 0, 'Daffa Sahad', 20523092, 'DaffaSahad', 'Daffa06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal_ujian`
--

CREATE TABLE `tb_soal_ujian` (
  `id_soal_ujian` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `a` text DEFAULT NULL,
  `b` text DEFAULT NULL,
  `c` text DEFAULT NULL,
  `d` text DEFAULT NULL,
  `e` text DEFAULT NULL,
  `kunci_jawaban` text DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `taxonomy_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_soal_ujian`
--

INSERT INTO `tb_soal_ujian` (`id_soal_ujian`, `pertanyaan`, `a`, `b`, `c`, `d`, `e`, `kunci_jawaban`, `type`, `taxonomy_level`) VALUES
(16, '<p>Apa keuntungan utama dari melakukan ujian online?</p>', 'Memungkinkan pengawasan yang lebih mudah', 'Mengurangi kemungkinan kesalahan manusia', 'Memungkinkan kolaborasi antara siswa', 'Membutuhkan lebih sedikit koordinasi', 'Membutuhkan lebih sedikit waktu', 'B', 2, NULL),
(17, '<p>Bagaimana AI digunakan dalam melakukan ujian online?</p>', 'Memberikan feedback kepada guru', 'Mengawasi penyuapan', 'Mengidentifikasi kelemahan siswa', 'Mengatur jadwal ujian', 'Mengotentikasi identitas siswa', 'A', 3, NULL),
(18, '<p>Apa itu proctoring jarak jauh?</p>', 'Kemampuan AI untuk mengawasi ujian', 'Mengawasi ujian dari jarak jauh', 'Menggunakan teknologi pengenalan wajah dan suara', 'Memungkinkan penipuan selama ujian', 'Menggunakan proktor untuk pengawasan', 'C', 3, NULL),
(19, '<p>Bagaimana AI membantu dalam mengevaluasi lembar jawaban?</p>', 'Mendeteksi tanda tangan siswa', 'Mengubah jawaban siswa', 'Mengunggah jawaban ke cloud', 'Mengurangi waktu evaluasi', 'Memeriksa jawaban menggunakan algoritma AI', 'E', 2, NULL),
(20, '<p>Bagaimana AI memberikan umpan balik kepada guru dan siswa?</p>', 'Menganalisis kinerja siswa', 'Memberikan jawaban langsung kepada siswa', 'Mengawasi guru selama ujian', 'Mengubah kurikulum', 'Menyediakan statistik kelas', 'A', 2, NULL),
(22, 'Bagaimana Anda dapat mengidentifikasi Joko pada tahun 2020?', 'KI JOKO BODO', 'Joko dari Sinetron “Dari Jendela SMP”', 'Joko saat bersepeda', 'Joko yang lupa datang ke rumah orangtuanya', 'Joko yang menjadi Spider-Man', 'B', 2, 2),
(23, 'Mengapa terdapat dua flow berbeda untuk fitur login yang sama?', 'Karena Google Search memiliki algoritma yang kompleks', 'Karena dipengaruhi oleh penggunaan kata kunci dan lokasi', 'Karena ada perbedaan dalam ranking halaman dan IP based location', 'Karena terjadi kesalahan teknis pada server', 'Karena Joko lupa password', 'C', 3, 4),
(24, 'Bagaimana kamu bisa menjelaskan apa itu \'Context Awareness\' dalam konteks aplikasi mobile?', 'Komputer yang dapat merasakan dan merespons berdasarkan kondisi lingkungan', 'Device yang memiliki informasi untuk mengoperasikan suatu rules', 'Berdasarkan situasi di sekitar pengguna', 'Rules tertentu terjadi di konteks tertentu', 'Semua jawaban di atas', 'E', 2, 2),
(25, 'Mengapa untuk fitur login yang sama, terdapat 2 flow berbeda? Berikan penjelasan secara singkat.', 'Karena algoritma Google Search yang kompleks', 'Dipengaruhi oleh penggunaan kata kunci atau trend', 'Menggunakan IP based location', 'Semua jawaban di atas', 'Hanya dua jawaban pertama', 'D', 3, 4),
(26, 'Bagaimana Anda akan membandingkan dua konsep yang berbeda?', 'Menceritakan perbedaan antara keduanya', 'Menyebutkan persamaan yang dimiliki', 'Mengidentifikasi aspek yang berbeda', 'Menjelaskan implikasi dari perbedaannya', 'Menyimpulkan kesamaan dan perbedaan', 'A', 2, 4),
(27, 'Bagaimana Anda akan mengaplikasikan teori yang dipelajari ke dalam situasi nyata?', 'Mencoba teori dalam situasi simulasi', 'Menerapkan teori dalam proyek nyata', 'Membandingkan teori dengan kasus nyata', 'Mengembangkan rencana berdasarkan teori', 'Meninjau kembali konsep dalam konteks realitas', 'simulasi,proyek,kasus,rencana,realitas', 3, 3),
(28, 'Bagaimana Anda akan menganalisis hubungan antara dua konsep yang kompleks?', 'Mengidentifikasi keterkaitan antara kedua konsep', 'Menjelaskan dampak dari hubungan tersebut', 'Membuat diagram untuk menggambarkan hubungan', 'Membahas implikasi dari hubungan tersebut', 'Menyimpulkan signifikansi dari hubungan', 'keterkaitan,dampak,diagram,implikasi,signifikansi', 3, 4),
(29, 'Bagaimana Bloom\'s Taxonomy dapat digunakan untuk mengukur tingkat pemahaman siswa dalam pembelajaran?', 'Mengidentifikasi tujuan pembelajaran', 'Mengkaji tingkat pemahaman siswa', 'Mengimplementasikan strategi pembelajaran', 'Menganalisis hasil evaluasi pembelajaran', 'Menciptakan metode evaluasi yang sesuai', 'B', 2, 2),
(30, 'Berikan contoh konkret penerapan prinsip-prinsip Bloom\'s Taxonomy dalam pengajaran matematika di sekolah?', 'Mengidentifikasi kebutuhan siswa', 'Membuat kurikulum berbasis Bloom\'s Taxonomy', 'Mengajarkan konsep matematika secara tradisional', 'Mengevaluasi kemampuan berpikir siswa', 'Mengembangkan soal ujian berdasarkan tingkat kesulitan', 'D', 2, 3),
(31, 'Bagaimana seorang guru dapat melakukan analisis kemampuan siswa berdasarkan tingkat Bloom\'s Taxonomy?', 'Mengadakan ujian akhir semester', 'Mengamati interaksi siswa di kelas', 'Menganalisis hasil tes standar', 'Membuat laporan perkembangan individu siswa', 'Mengidentifikasi tingkat kemampuan berpikir siswa', 'guru,analisis,kemampuan,siswa,Bloom\'s', 3, 4),
(32, 'Mengapa penting bagi lembaga pendidikan untuk terus melakukan evaluasi terhadap implementasi Bloom\'s Taxonomy dalam proses pembelajaran?', 'Meningkatkan daya saing lembaga', 'Memastikan kualitas pendidikan', 'Menjaga keberlanjutan program pendidikan', 'Menumbuhkan minat belajar siswa', 'Menciptakan lingkungan belajar yang inklusif', 'lembaga,evaluasi,implementasi,Bloom\'s,proses', 3, 5),
(33, 'Bagaimana cara Dayu memegang dan membalik halaman buku dengan benar?', 'Menggunakan jari telunjuk', 'Menggunakan ibu jari', 'Menggunakan jari kelingking', 'Menggunakan seluruh tangan', 'Menggunakan telapak tangan', 'A', 2, 3),
(34, 'Mengapa penting untuk membaca dengan baik saat di rumah?', 'Agar cahaya terang', 'Agar bisa tidur nyenyak', 'Agar bisa memahami isi buku', 'Agar tidak bosan', 'Agar bisa menarik perhatian orang lain', 'C', 2, 5),
(35, 'Bagaimana cahaya di kelas memengaruhi kemampuan Dayu dalam membaca?', 'Membuat Dayu tertidur', 'Membuat Dayu tidak fokus', 'Membuat Dayu bisa membaca dengan baik', 'Membuat Dayu sakit kepala', 'Membuat Dayu tidak suka membaca', 'C', 2, 2),
(36, 'Apakah tindakan yang seharusnya dilakukan jika cahaya saat membaca terlalu redup?', 'Menggunakan lampu senter', 'Meminta teman untuk membacakan', 'Meneruskan membaca tanpa masalah', 'Meminta guru untuk menyalakan lampu', 'Menutup buku dan berhenti membaca', 'D', 2, 4),
(37, 'Bagaimana cara Dayu membaca dengan baik?', 'Membaca dengan cepat', 'Membaca tanpa suara', 'Membaca dengan penuh perasaan', 'Membaca dengan intonasi yang tepat', 'Membaca sambil berdiri', 'D', 2, 3),
(38, 'Mengapa penting untuk memperhatikan cara memegang dan membalik halaman buku dengan benar?', 'Agar buku tidak rusak', 'Agar bisa membaca dengan cepat', 'Agar tidak terganggu saat membaca', 'Agar tampilan buku tetap rapi', 'Agar jari tidak terluka', 'penting,memperhatikan,memegang,halaman,buku', 3, 5),
(39, 'Bagaimana cahaya di kelas dapat mempengaruhi kemampuan seseorang dalam membaca?', 'Membuat mata lelah', 'Membuat terlalu fokus', 'Membuat membaca lebih menyenangkan', 'Membuat membaca lebih sulit', 'Tidak mempengaruhi kemampuan membaca', 'cahaya,kelas,mempengaruhi,kemampuan,membaca', 3, 4),
(40, 'Bagaimana cara memegang dan membalik halaman buku yang tepat?', 'Dengan ibu jari dan jari telunjuk', 'Dengan jari tengah dan jari manis', 'Dengan telapak tangan', 'Dengan ujung jari', 'Dengan punggung tangan', 'A', 2, 3),
(41, 'Mengapa penting untuk membaca dengan baik saat di rumah?', 'Agar bisa mendapat nilai bagus', 'Agar bisa lebih cepat selesai membaca', 'Agar bisa memahami isi buku dengan baik', 'Agar terlihat pintar di mata orang lain', 'Agar terhindar dari hukuman', 'C', 2, 5),
(42, 'Apakah cahaya yang terang saat membaca membantu Dayu?', 'Ya, karena cahaya yang terang membuat mata tidak cepat lelah', 'Tidak, karena cahaya yang terang membuat mata silau', 'Ya, karena cahaya yang terang membantu membaca dengan baik', 'Tidak, karena cahaya yang terang membuat Dayu merasa panas', 'Tidak ada hubungannya', 'A', 2, 1),
(45, 'Bagaimana cara memegang dan membalik halaman buku yang benar?', 'Menggunakan jari telunjuk', 'Menggunakan jari kelingking', 'Menggunakan jari tengah', 'Menggunakan jari telunjuk dan jari tengah', 'Menggunakan jari kelingking dan jari telunjuk', 'D', 2, 3),
(46, 'Mengapa penting untuk membaca dengan baik saat di rumah?', 'Agar cahaya terang', 'Agar bisa membaca gambar', 'Agar bisa membaca dengan baik', 'Agar tidak bosan', 'Agar mendapat nilai bagus', 'C', 2, 5),
(47, 'Apa yang dapat dilakukan Dayu agar bisa membaca dengan baik di kelas?', 'Membawa buku sendiri', 'Membaca dengan mata tertutup', 'Membaca dengan baik', 'Membaca di luar kelas', 'Membaca dengan cahaya terang', 'Dayu,baca,kelas,cahaya,baik', 3, 4),
(48, 'Bagaimana cahaya yang tepat saat membaca buku?', 'Cahaya terang', 'Cahaya gelap', 'Cahaya warna-warni', 'Tidak perlu cahaya', 'Cahaya matahari langsung', 'cahaya,tepat,membaca,buku,terang', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_soal_ujian` (`id_soal_ujian`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indexes for table `tb_jenis_ujian`
--
ALTER TABLE `tb_jenis_ujian`
  ADD PRIMARY KEY (`id_jenis_ujian`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tb_matapelajaran`
--
ALTER TABLE `tb_matapelajaran`
  ADD PRIMARY KEY (`id_matapelajaran`);

--
-- Indexes for table `tb_materi`
--
ALTER TABLE `tb_materi`
  ADD PRIMARY KEY (`id_materi`) USING BTREE;

--
-- Indexes for table `tb_peserta`
--
ALTER TABLE `tb_peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `id_matakuliah` (`id_matapelajaran`),
  ADD KEY `id_mahasiswa` (`id_siswa`),
  ADD KEY `id_jenis_ujian` (`id_jenis_ujian`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nim` (`nis`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tb_soal_ujian`
--
ALTER TABLE `tb_soal_ujian`
  ADD PRIMARY KEY (`id_soal_ujian`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tb_jenis_ujian`
--
ALTER TABLE `tb_jenis_ujian`
  MODIFY `id_jenis_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_matapelajaran`
--
ALTER TABLE `tb_matapelajaran`
  MODIFY `id_matapelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_materi`
--
ALTER TABLE `tb_materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_peserta`
--
ALTER TABLE `tb_peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tb_soal_ujian`
--
ALTER TABLE `tb_soal_ujian`
  MODIFY `id_soal_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
