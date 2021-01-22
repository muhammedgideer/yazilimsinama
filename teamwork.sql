-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 22 Oca 2021, 22:57:11
-- Sunucu sürümü: 8.0.17
-- PHP Sürümü: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `teamwork`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ekipler`
--

CREATE TABLE `ekipler` (
  `ekip_id` int(11) NOT NULL,
  `ekip_ad` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ekip_aciklama` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ekip_yoneticiid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ekipler`
--

INSERT INTO `ekipler` (`ekip_id`, `ekip_ad`, `ekip_aciklama`, `ekip_yoneticiid`) VALUES
(9, 'yazılım sınama ekibi', 'muhendislik ekibi', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ekipuyeleri`
--

CREATE TABLE `ekipuyeleri` (
  `id` int(11) NOT NULL,
  `ekip_id` int(11) NOT NULL,
  `uye_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ekipuyeleri`
--

INSERT INTO `ekipuyeleri` (`id`, `ekip_id`, `uye_id`) VALUES
(29, 9, 2),
(30, 9, 3),
(31, 9, 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kartlar`
--

CREATE TABLE `kartlar` (
  `kart_id` int(11) NOT NULL,
  `kart_ad` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `kart_aciklama` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `kart_baslangictarih` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `kart_bitistarih` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `kart_kapak` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '14',
  `kart_listeid` int(11) NOT NULL,
  `kart_sira` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kartlar`
--

INSERT INTO `kartlar` (`kart_id`, `kart_ad`, `kart_aciklama`, `kart_baslangictarih`, `kart_bitistarih`, `kart_kapak`, `kart_listeid`, `kart_sira`) VALUES
(79, 'cds', 'fwehh', '2021-01-21', '2021-07-22', '19', 35, 4),
(80, 'wehjh', 'ğpohj', '2021-02-05', '2021-03-01', '14', 35, 3),
(81, '4r4ewds', 'fedsc', '2021-01-25', '2021-01-30', '14', 36, 1),
(82, 'işlem9', 'dnwekjbfbfhjerbfhjerfher fvgherhfgve rhferhfvghervghervf', '2021-01-22', '2021-01-31', '15', 35, 1),
(83, 'fjıwuds', 'efdhshj', '2021-01-22', '2021-02-22', '14', 35, 2),
(84, '4freohj', 'üğlpljk', '2021-01-22', '2021-01-30', '14', 37, 0),
(85, 'lkljhm', 'v b', '2021-01-22', '2021-02-22', '14', 36, 2),
(86, 'ozi', 'klm', '2021-01-22', '2021-01-30', '14', 37, 0),
(87, 'jbk', 'h', '2021-02-22', '2021-03-01', '14', 37, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `listeler`
--

CREATE TABLE `listeler` (
  `liste_id` int(11) NOT NULL,
  `liste_ad` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `liste_sira` int(11) NOT NULL,
  `liste_durum` enum('0','1') CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '1',
  `liste_panoid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `listeler`
--

INSERT INTO `listeler` (`liste_id`, `liste_ad`, `liste_sira`, `liste_durum`, `liste_panoid`) VALUES
(35, 'list1', 1, '1', 23),
(36, 'orhan', 2, '1', 23),
(37, '4dejhuj', 1, '1', 26);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `panolar`
--

CREATE TABLE `panolar` (
  `pano_id` int(11) NOT NULL,
  `pano_ad` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `pano_aciklama` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `pano_arkaplan` varchar(500) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `pano_yildizdurumu` enum('0','1') CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `pano_link` varchar(500) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `pano_ekipid` int(11) NOT NULL,
  `pano_yoneticiid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `panolar`
--

INSERT INTO `panolar` (`pano_id`, `pano_ad`, `pano_aciklama`, `pano_arkaplan`, `pano_yildizdurumu`, `pano_link`, `pano_ekipid`, `pano_yoneticiid`) VALUES
(23, 'Yazılım Sınama Panosu', 'bu panoda yazılım sınma proje ödevini takip edip bir ekip gibi yönetmeye çalışcaz', '6', '0', '', 0, 1),
(26, 'pano', 'ecdsjb cf', '7', '0', '', 0, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uye`
--

CREATE TABLE `uye` (
  `uye_id` int(11) NOT NULL,
  `uye_ad` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `uye_soyad` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `uye_mail` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `uye_password` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `uye_sifre` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `uye_yetki` int(11) NOT NULL,
  `uye_durum` enum('0','1') CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `uye`
--

INSERT INTO `uye` (`uye_id`, `uye_ad`, `uye_soyad`, `uye_mail`, `uye_password`, `uye_sifre`, `uye_yetki`, `uye_durum`) VALUES
(1, 'Orhan', 'Koyunbakan', 'orhan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456', 1, '1'),
(2, 'MUHAMMED ', 'GİDER', 'muhammed@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456', 1, '1'),
(3, 'sefer', 'koyunbakan', 'sefer@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456', 1, '1'),
(5, 'haydi', 'bakalim', 'haydi@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456', 1, '1'),
(6, 'Emin', 'GİDER', 'emin@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '1234567', 1, '1'),
(7, 'a', 'b', 'a@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '1234567', 1, '1'),
(8, 'b', 'c', 'b@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '1234567', 1, '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorum`
--

CREATE TABLE `yorum` (
  `yorum_id` int(11) NOT NULL,
  `yorum_kartid` int(11) NOT NULL,
  `yorum_uyeid` int(11) NOT NULL,
  `yorum_zaman` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `yorum_icerik` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yorum`
--

INSERT INTO `yorum` (`yorum_id`, `yorum_kartid`, `yorum_uyeid`, `yorum_zaman`, `yorum_icerik`) VALUES
(15, 82, 1, '2021-01-21 23:08:18', 'ferfdhjlkhjg'),
(16, 82, 2, '2021-01-21 23:08:43', 'pokıjhjg');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ekipler`
--
ALTER TABLE `ekipler`
  ADD PRIMARY KEY (`ekip_id`),
  ADD KEY `ekip-uye-disanahtar` (`ekip_yoneticiid`);

--
-- Tablo için indeksler `ekipuyeleri`
--
ALTER TABLE `ekipuyeleri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ekpuyeleri-ekip-disanahtar` (`ekip_id`);

--
-- Tablo için indeksler `kartlar`
--
ALTER TABLE `kartlar`
  ADD PRIMARY KEY (`kart_id`),
  ADD KEY `kart-liste-disanahtar` (`kart_listeid`);

--
-- Tablo için indeksler `listeler`
--
ALTER TABLE `listeler`
  ADD PRIMARY KEY (`liste_id`),
  ADD KEY `liste-pano-disanahtar` (`liste_panoid`);

--
-- Tablo için indeksler `panolar`
--
ALTER TABLE `panolar`
  ADD PRIMARY KEY (`pano_id`),
  ADD KEY `pano-ekip-disanahtar` (`pano_ekipid`),
  ADD KEY `pano-uye-disanahtar` (`pano_yoneticiid`);

--
-- Tablo için indeksler `uye`
--
ALTER TABLE `uye`
  ADD PRIMARY KEY (`uye_id`);

--
-- Tablo için indeksler `yorum`
--
ALTER TABLE `yorum`
  ADD PRIMARY KEY (`yorum_id`),
  ADD KEY `yorum-uye-disanahtar` (`yorum_uyeid`),
  ADD KEY `yorum-kart-disanahtar` (`yorum_kartid`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ekipler`
--
ALTER TABLE `ekipler`
  MODIFY `ekip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `ekipuyeleri`
--
ALTER TABLE `ekipuyeleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Tablo için AUTO_INCREMENT değeri `kartlar`
--
ALTER TABLE `kartlar`
  MODIFY `kart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Tablo için AUTO_INCREMENT değeri `listeler`
--
ALTER TABLE `listeler`
  MODIFY `liste_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Tablo için AUTO_INCREMENT değeri `panolar`
--
ALTER TABLE `panolar`
  MODIFY `pano_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Tablo için AUTO_INCREMENT değeri `uye`
--
ALTER TABLE `uye`
  MODIFY `uye_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `yorum`
--
ALTER TABLE `yorum`
  MODIFY `yorum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `ekipler`
--
ALTER TABLE `ekipler`
  ADD CONSTRAINT `ekip-uye-disanahtar` FOREIGN KEY (`ekip_yoneticiid`) REFERENCES `uye` (`uye_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `ekipuyeleri`
--
ALTER TABLE `ekipuyeleri`
  ADD CONSTRAINT `ekpuyeleri-ekip-disanahtar` FOREIGN KEY (`ekip_id`) REFERENCES `ekipler` (`ekip_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `kartlar`
--
ALTER TABLE `kartlar`
  ADD CONSTRAINT `kart-liste-disanahtar` FOREIGN KEY (`kart_listeid`) REFERENCES `listeler` (`liste_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `listeler`
--
ALTER TABLE `listeler`
  ADD CONSTRAINT `liste-pano-disanahtar` FOREIGN KEY (`liste_panoid`) REFERENCES `panolar` (`pano_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `panolar`
--
ALTER TABLE `panolar`
  ADD CONSTRAINT `pano-uye-disanahtar` FOREIGN KEY (`pano_yoneticiid`) REFERENCES `uye` (`uye_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `yorum`
--
ALTER TABLE `yorum`
  ADD CONSTRAINT `yorum-kart-disanahtar` FOREIGN KEY (`yorum_kartid`) REFERENCES `kartlar` (`kart_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `yorum-uye-disanahtar` FOREIGN KEY (`yorum_uyeid`) REFERENCES `uye` (`uye_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
