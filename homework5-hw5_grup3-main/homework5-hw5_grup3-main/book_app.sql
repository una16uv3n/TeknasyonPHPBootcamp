-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 20 Eyl 2021, 21:01:16
-- Sunucu sürümü: 10.4.21-MariaDB
-- PHP Sürümü: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `book_app`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `author_name` varchar(55) NOT NULL,
  `bookId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `author`
--

INSERT INTO `author` (`id`, `author_name`, `bookId`) VALUES
(1, 'Jules Verne', 1),
(2, 'George Orwel', 2),
(3, 'Stefan Zweig', 5),
(4, 'Hasan Basri', 4),
(5, 'Dan Brown', 6),
(6, 'Henry Kissenger', 3),
(7, 'George Orwel', 7),
(13, 'Jose Mauro De Vasconcelos', 14),
(15, 'Paulo Coelho', 19),
(17, 'Michael Ende', 21),
(18, 'Michael Ende', 22),
(19, 'Michael Ende', 23),
(20, 'Jose Saramago', 24),
(21, 'Paulo Coelho', 25),
(22, 'asdasd', 26),
(24, 'Paulo Coelho', 28),
(25, 'Michael Ende', 29),
(32, 'Kadir Erman', 36),
(33, 'Efe Büyük', 37),
(34, 'dasd', 38),
(36, 'dasdsad', 40);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `image` longtext NOT NULL,
  `published_at` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `book`
--

INSERT INTO `book` (`id`, `name`, `desc`, `image`, `published_at`) VALUES
(1, '80 Günde Devr-i Alem', 'Burlington Gardens\'teki Saville row\'un 7 numaralı evinde, bir İngiliz centilmen yaşıyordu. Bu centilmenin adı, Phileas Fogg\'tu Bay Fogg, tüm İngiliz tüm centilmenleri gibi bir kulübün üyesiydi. Kendisi hiçbir şirket ya da kumpanyanın yönetim kurulu üyesi değil, sadece Reform Kulüp üyesiydi. Phileas Fogg oraya, Barin Brothers Bankası\'nın önerisiyle girmişti. Orada açık bir kredisi vardı. Çekleri muntazam ödendiği, hesabının alacak hanesinde de daima para bulunduğu için, Phileas Fogg\'un itibarı yüksekti. Fazla konuşkan bir insan değildi. Sessiz bir insan oluşu ondaki o esrar dolu hali daha da arttırmaktaydı. Bununla birlikte,', 'resources/images/80-gunde.jpg', 1872),
(2, '1984', '', 'resources/images/1984.jpg', 1949),
(3, 'Diplomasi', '', 'resources/images/diplomasi-henry-kissinger.jpg', 1994),
(4, 'Basreal', '', 'resources/images/default.jpg', 2021),
(5, 'Amok Koşucusu', '', 'resources/images/amok-kosucusu.jpg', 0),
(6, 'Başlangıç', '', 'resources/images/baslangic.jpg', 0),
(7, 'Hayvan Çiftiliği', '', 'resources/images/hayvan-ciftligi.jpg', 1945),
(14, 'Şeker Portalalı', '', '', 0),
(19, 'Simyacı', '', '', 0),
(21, 'Momo', '', '', 0),
(22, 'Momo', '', '', 0),
(23, 'Momo', '', '', 0),
(24, 'Körlük', '', '', 0),
(25, 'Simyacı', '', '', 0),
(26, 'dasda', '', '', 0),
(28, 'Simyacı', '', '', 0),
(29, 'Momo', '', '', 0),
(36, 'Php ile Hikayelerim', '', '', 0),
(37, 'Hadi Bakayım', '', '', 0),
(38, 'sadsa', '', '', 0),
(40, 'dasd', '', '', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `level` varchar(55) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `log`
--

INSERT INTO `log` (`id`, `level`, `message`, `created_at`) VALUES
(1, '', '', '2021-09-17 16:38:48'),
(2, '', '', '2021-09-17 16:38:48'),
(3, 'info', 'Log sistemi denendi', '2021-09-17 16:49:45'),
(4, 'info', 'Log sistemi denendi', '2021-09-17 16:49:46'),
(5, 'info', 'Log sistemi denendi', '2021-09-17 16:50:00'),
(6, 'warning', 'İzinsiz giriş engellendi', '2021-09-17 16:58:38'),
(7, 'warning', 'İzinsiz giriş engellendi', '2021-09-17 17:39:03'),
(8, 'info', 'Kullanıcı log tablosunu databaseden çekti', '2021-09-17 17:51:22'),
(9, 'error', 'Kullanıcı log tablosunu databaseden çekerken hata oluştu', '2021-09-17 17:54:34'),
(10, 'alert', 'Sisteme izinsiz giriş yapıldı', '2021-09-18 19:57:50');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post` longtext NOT NULL,
  `bookId` int(11) NOT NULL,
  `authorId` int(11) DEFAULT NULL,
  `sectionId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `posts`
--

INSERT INTO `posts` (`id`, `post`, `bookId`, `authorId`, `sectionId`) VALUES
(2, 'Burası başka bir post', 2, 2, 2),
(3, 'Burası kitabın 1.bölümü için ekstra post', 1, 1, 1),
(5, 'Post Crud işlemleri', 28, 24, 6),
(8, 'Postumun postu postumdur.', 36, NULL, NULL),
(19, 'dasdasd', 36, NULL, NULL),
(20, 'Bir PHP betiğinin Perl ya da C gibi dillerden ne kadar farklı bir yapıda olduğuna dikkat edin. HTML kodu oluşturmak için bir sürü kod yazacağınıza, istediğiniz işi yapan bir PHP kodu yazıp onu HTML kodunun içine gömüyorsunuz (bu örnekte, yapılan iş ekrana yazı yazmak). PHP kodu özel başlangıç ve bitiş etiketleri arasına yazılır. Bu etiketler \"PHP kipine\" rahatlıkla girip çıkabilmenizi sağlarlar.', 36, NULL, NULL),
(21, 'Değiştirildi', 36, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `bookId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `section`
--

INSERT INTO `section` (`id`, `section_name`, `content`, `bookId`) VALUES
(1, 'Bölüm1', 'Bölüm 1 Başlığı', 1),
(2, 'Bölüm 2 Başlık', 'Bölüm 2 İçeriği', 2),
(3, 'Serüven Başlarken', 'Burlington Gardens\'teki Saville row\'un 7 numaralı evinde, bir İngiliz centilmen yaşıyordu. Bu centilmenin adı, Phileas Fogg\'tu Bay Fogg, tüm İngiliz tüm centilmenleri gibi bir kulübün üyesiydi. Kendisi hiçbir şirket ya da kumpanyanın yönetim kurulu üyesi değil, sadece Reform Kulüp üyesiydi. ', 1),
(4, 'Serüven Devam Ederken...', 'Phileas Fogg oraya, Barin Brothers Bankası\'nın önerisiyle girmişti. Orada açık bir kredisi vardı. Çekleri muntazam ödendiği, hesabının alacak hanesinde de daima para bulunduğu için, Phileas Fogg\'un itibarı yüksekti. Fazla konuşkan bir insan değildi. Sessiz bir insan oluşu ondaki o esrar dolu hali daha da arttırmaktaydı. Bununla birlikte, yaşayışında esrarlı denecek bir yan yoktu. Seyahat etmiş miydi? Belki de... Çünkü dünyayı hiç kimse onun kadar iyi bilmiyordu.', 1),
(6, 'Create Update Delete', 'Crud işlemler yapılacak', 28),
(7, 'Ekleme Örneği', 'Boş', 28),
(8, 'Örnek Bölüm', 'Örnek content bölümün', 28),
(11, 'sad', 'dasdsad', 28),
(15, 'asd', 'dasdasdsadasd', 28),
(16, 'asd', 'adasd', 28),
(19, 'sada', 'saddasd', 28),
(21, 'Ekleme Özelliği', 'Eklendi', 28),
(22, 'Eklenen Bölüm', 'Eklendi', 28),
(25, 'Momoo', 'İçerik', 29),
(30, 'Eklenen Bölüm düzenlendi', 'Eklendi düzenlendi', 7),
(35, 'Sql İnjection', 'Sql adaasdasdasljşdjklasljkdsad', 36);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Tablo için AUTO_INCREMENT değeri `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Tablo için AUTO_INCREMENT değeri `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Tablo için AUTO_INCREMENT değeri `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
