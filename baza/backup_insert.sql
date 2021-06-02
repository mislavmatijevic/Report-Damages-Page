-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 02, 2021 at 10:41 AM
-- Server version: 5.5.62-0+deb8u1
-- PHP Version: 7.2.25-1+0~20191128.32+debian8~1.gbp108445

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WebDiP2020x057`
--


--
-- Dumping data for table `tip_radnje`
--

INSERT INTO `tip_radnje` VALUES
(1, 'prijava/odjava'),
(2, 'rad s bazom'),
(3, 'ostale radnje');

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` VALUES
(1, 'Administrator'),
(2, 'Moderator'),
(3, 'Registrirani korisnik'),
(4, 'Neregistrirani korisnik');

--
-- Dumping data for table `vrsta_materijala`
--

INSERT INTO `vrsta_materijala` VALUES
(1, 'Fotografija', 'Fotografija materijal.', 'Uploadati.', '.jpg, .jpeg', 4),
(2, 'Video', 'Video materijal.', 'Uploadati.', '.mp4', 64),
(3, 'Audio', 'Audio materijal.', 'Uploadati.', '.mp3', 1);


--
-- Dumping data for table `status_stete`
--

INSERT INTO `status_stete` VALUES
(1, 'obrada'),
(2, 'prihvaćeno'),
(3, 'odbijeno');


--
-- Dumping data for table `dokazni_materijali`
--


INSERT INTO `dokazni_materijali` VALUES
(1, 'multimedija\\/wall.jpg', 'Primjer dokaza 1', '2021-04-13 14:57:10', 'Pogledati gornji desni kut.', 1),
(2, 'multimedija\\/požar.jpg', 'požar.jpg', '2021-05-23 19:36:08', NULL, 1),
(27, 'multimedija/oluja.jpg', 'oluja.jpg', '2021-05-23 19:40:35', NULL, 1),
(28, 'multimedija/potres.jpg', 'potres.jpg', '2021-05-23 19:41:37', NULL, 1),
(29, 'multimedija/krađa.jpg', 'krađa.jpg', '2021-05-23 19:43:09', NULL, 1),
(30, 'multimedija/potres.jpg', 'potres.jpg', '2021-05-23 20:28:19', NULL, 1),
(31, 'multimedija\\/poplava_kuca.jpg', 'oluja.jpg', '2021-05-23 20:37:16', NULL, 1),
(32, 'multimedija\\/poplava_kuca.jpg', 'poplava_kuca.jpg', '2021-05-24 16:50:14', NULL, 1),
(33, 'multimedija\\/poplava_kuca.jpg', 'poplava_kuca.jpg', '2021-05-24 16:50:45', NULL, 1),
(34, 'multimedija\\/kuća_gori.jpg', 'kuća_gori.jpg', '2021-05-24 19:22:08', NULL, 1),
(35, 'multimedija\\/wall.jpg', 'krađa.jpg', '2021-05-24 20:34:27', NULL, 1);


--
-- Dumping data for table `kategorija_stete`
--

INSERT INTO `kategorija_stete` VALUES
(1, 'Oluja', 'Gromovi mogu spaliti osigurače, električne uređaje itd. Šteta je još gora kada se posjed zapali uslijed udara groma.', 1, 1, 'multimedija/oluja.jpg'),
(2, 'Poplava', 'Nema načina zaštite spremišta ispod prizemne razine od poplava. PVC stolarija, metalna vrata, ništa ne zaustavlja prodor vode pred ogromnim pritiskom. Voda uništi sav namještaj od ivice, električne uređaje. U dodiru s otvorenim instalacijama može doći i do požara.', 3, 1, 'multimedija/poplava.jpg'),
(3, 'Požar', 'Sama pomisao na požare utiskuju strah u kosti. Eksplozija cijevi od plina uslijed malene pukotine može se dogoditi bilo kome. Vatra najčešće uništi susjedne posjede, stanove itd.', 0, 0, 'multimedija/pozar.jpg'),
(4, 'Potres', 'Instiktivan strah koje potresi uzrokuju rijetki mogu izdržati, a strah se duboko urezuje u kosti. Kao da to nije dovoljno, na starijim građevinama potresi uzrokuju katastrofalnu infrastrukturnu štetu koju je teško i skupo sanirati.', 2, 1, 'multimedija/potres.jpg'),
(5, 'Krađa', 'Nekada se čovjek trudi, radi svoj posao pošteno, samo da bi uočio obijenu bravu na kućnim vratima. Ponekad štete nastale krađom budu kobne i ljudi izgube svo bogatstvo što su imali.', 2, 1, 'multimedija/kradja.jpg'),
(6, 'Posljedice rata', 'Već je 30 godina od rata, no štete nastale razaranjima i pljačkom i dan danas nisu kompenzirane.', 1, 1, 'multimedija/rat.jpg');

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` VALUES
(1, 'Mislav', 'Matijević', 'mmatijevi', 'mmatijevi@foi.hr', 'test1', '1b4f0e9851971998e732078544c96b36c3d01cedf7caa332359d6f1d83567014', NULL, '2021-04-13 12:33:51', NULL, NULL, 1),
(2, 'Ana', 'Anić', 'aanic2', 'aanic@foi.hr', 'anica2', '8d58152608756c9a966cc6b529806fd4465b4ccf442b481673e957fafe8684a2', NULL, '2021-04-03 21:29:42', NULL, NULL, 2),
(3, 'Goran', 'Gorić', 'ggoric', 'ggoric@foi.hr', 'goran2', '06480f0f268fe094bef54826f9aa64f6a6b1df8f3cf95181c3673c4b4f6fe827', NULL, '2021-04-12 01:19:30', NULL, NULL, 2),
(4, 'Mirko', 'Mirkić', 'mmirkic', 'mmirkic@foi.hr', 'dinamo2', 'a0f9f9f2f5567113d6b9783a84d3b2a813c9a1c15299aefa363f4b7740be1494', NULL, '2021-04-08 13:33:17', NULL, NULL, 2),
(5, 'Matej', 'Matijač', 'mmatijac3', 'mmatijac@foi.hr', 'matejftw3', 'e47c91ee2668da296be81c23ced5a85ddf1246a0bafc08765af7689fe755537e', NULL, '2021-04-09 04:11:07', NULL, NULL, 3),
(6, 'Željko', 'Željkić', 'zzeljkic', 'zzeljkic@foi.hr', 'kamion3', '080433177e2304bca06e06f4404bd2eb531f2659a2b704c9f6eb9fb1b93bb85a', NULL, '2021-04-10 01:10:06', NULL, NULL, 3),
(7, 'Maja', 'Majajić', 'mmajajic', 'mmajajic@foi.hr', 'barbie3', '8b79893ae14b2d3bf23e382380e71a0791f2d3b335bd82635256696f7012bc51', NULL, '2021-04-11 07:12:44', NULL, NULL, 3),
(8, 'Zera', 'Hudžibufić', 'zhudzibufic', 'zhudzibufic@foi.hr', 'zera3', '2e74147cc2e4424916034268d123770a1d0634cd6f2fef2ce78e9b0f3e0b1d17', NULL, '2021-04-12 08:29:31', NULL, NULL, 3),
(9, 'Garo', 'Garavi', 'ggaravi', 'ggaravi@foi.hr', 'crnac3', '66ef69e3bab8ffe14eec89d228f0b1b7d4483e46d0f12990bed5eb99190e11da', NULL, '2021-04-13 00:11:08', NULL, NULL, 3),
(10, 'Ana', 'Prekrasna', 'aprekrasna4', 'aprekrasna@foi.hr', 'beuty4', '8eabcebc63234997f9fe253ab554ac3c9e2366fd53b5dcb9b8bb61a425500a31', NULL, '2021-04-13 12:39:30', NULL, NULL, 4),
(11, 'ime', 'prezime', 'korime', 'email', 'lozinka', 'lozinka_sha256', NULL, '2021-05-23 22:40:36', NULL, NULL, 3),
(12, 'Mario', 'Nižić', 'mnizic', 'mnizic@email.co', 'test1', '1b4f0e9851971998e732078544c96b36c3d01cedf7caa332359d6f1d83567014', NULL, '2021-05-23 22:54:51', NULL, NULL, 3),
(13, 'Anton', 'Lovrić', 'alovric', 'alovric@mail', 'test3', 'fd61a03af4f77d870fc21e05e7e80678095c92d808cfb3b5c279ee04c74aca13', NULL, '2021-05-23 23:05:07', NULL, NULL, 3),
(14, 'Mateo', 'Mustać', 'mmustac', 'mmustac@web.com', 'test3', 'fd61a03af4f77d870fc21e05e7e80678095c92d808cfb3b5c279ee04c74aca13', NULL, '2021-05-23 23:09:15', NULL, NULL, 3),
(15, NULL, NULL, 'kd', 'kevin@mail.com', 'test3', 'fd61a03af4f77d870fc21e05e7e80678095c92d808cfb3b5c279ee04c74aca13', NULL, '2021-05-23 23:10:12', NULL, NULL, 3),
(16, NULL, NULL, 'bezimeni', 'bezimeni@bezimenjak.com', 'test3', 'fd61a03af4f77d870fc21e05e7e80678095c92d808cfb3b5c279ee04c74aca13', NULL, '2021-05-23 23:12:15', NULL, NULL, 3),
(17, 'Ivan', 'Blažek', 'iblazek', 'iblazek@web.cc', 'test3', 'fd61a03af4f77d870fc21e05e7e80678095c92d808cfb3b5c279ee04c74aca13', NULL, '2021-05-23 23:24:56', NULL, NULL, 3),
(18, NULL, NULL, 'nemamime', 'nemam@ime.cc', 'test1', '1b4f0e9851971998e732078544c96b36c3d01cedf7caa332359d6f1d83567014', NULL, '2021-05-23 23:25:21', NULL, NULL, 3),
(19, 'Brko', 'Brkić', 'Brkan', 'brkanda@brk.cc', 'test1', '1b4f0e9851971998e732078544c96b36c3d01cedf7caa332359d6f1d83567014', NULL, '2021-05-24 01:29:27', NULL, NULL, 3),
(20, NULL, 'Nemamimenčić', 'noname', 'noname@noname.com', 'noname1', 'feacbb61648b0afa5921e518e31165c75588a3604005ed447021c359b6a2996e', NULL, '2021-05-24 19:32:33', NULL, NULL, 3),
(21, 'matnovak', 'matnovak', 'matnovak', 'matnovak@foi.hr', 'matnovak1', '71f5bd33dfccf179969ac43b29bd8771522d90af7567a1be85cae567465516e5', NULL, '2021-05-28 13:57:11', NULL, NULL, 3);


--
-- Dumping data for table `javni_poziv`
--

INSERT INTO `javni_poziv` VALUES
(1, 'Subvencija za nedavnu oluju', 'Nedavna oluja nanijela je mnogim našim građanima velike štete. Vjetar, gromovi, sve to nanosi materijalne štete.\r\n\r\nPomozite sugrađanima popraviti te štete!', '2021-04-10 03:15:18', 3500, '2021-04-13 17:50:50', 1, 1),
(2, 'Pomoć žrtvama poplave', 'Nedavna poplava nanijela je velike materijalne štete našim sugrađanima. Pomozite im!', '2021-03-31 20:00:00', 4215.5, NULL, 3, 2),
(3, 'Potres, prvi javni natječaj', 'Ovo je prvi javni natječaj za žrtve potresa!', '2021-04-01 20:00:00', 3500, '2021-04-08 20:00:00', 3, 4),
(4, 'Potres, drugi javni natječaj', 'Ovo je drugi javni natječaj za žrtve potresa! Pomozite im jer im je potrebno!', '2021-04-11 20:00:00', 1225.25, NULL, 2, 4),
(5, 'Krađe', 'Nedavno su naši sugrađani bili izloženi stravičnim pljačkama. Pomozite im nadomjesititi ukradenu imovinu dok policija ne odradi svoj posao.', '2021-04-09 20:00:00', 753.65, NULL, 3, 5),
(6, 'Pomoć za ratna stradanja', 'Neki naši sugrađani još izlaze na kraj s ratnim razaranjima. Ovo je prilika da im pomognete do 13. travnja 2021.', '2021-04-10 08:00:00', 7500, '2021-04-12 20:00:00', 1, 6);

--
-- Dumping data for table `moderator_kategorije`
--

INSERT INTO `moderator_kategorije` VALUES
(1, 1),
(3, 2),
(2, 4),
(3, 4),
(3, 5),
(1, 6);

--
-- Dumping data for table `steta`
--

INSERT INTO `steta` VALUES
(1, 'Poplava', 'Poplava uništila kuću, molim pomoć.', 'poplava pomoć', '2021-05-23 15:41:05', '2021-12-12 22:12:12', NULL, 2, 2, 1),
(2, 'Požar', 'Vatra uništila kuću, hitno trebamo krov nad glavom! Ovo je postalo nesnošljivo. Trebamo hitno pomoć!', 'vatra vruće', '2021-05-23 19:38:41', '2021-12-12 13:14:14', NULL, 2, 3, 1),
(23, 'Oluja', 'Grom udario u stog sijena, izgorijela štala. Hitno trebam financijsku pomoć!', 'grom sijeno', '2021-05-23 19:40:35', NULL, NULL, 1, 1, 1),
(24, 'Potres', 'Potres uništio staru kuću iz 70-ih. Sve je nestalo!', 'hitno trese pomozite', '2021-05-23 19:41:37', NULL, NULL, 1, 4, 1),
(25, 'Krađa', 'Lopovi ukrali preko noći novi Samsung TV. Ne znam što mi je činiti...', 'lopovi majkuim', '2021-05-23 19:43:09', NULL, NULL, 1, 5, 1),
(26, 'Požar jaoo', 'Vatra uništila kuću, hitno trebamo krov nad glavom!!!', 'vatra', '2021-05-23 20:28:19', NULL, NULL, 1, 2, 1),
(27, 'Poplava', 'Lopovi ukrali preko noći novi Samsung TV.', 'voda poplava', '2021-05-23 20:37:16', '2021-05-13 15:30:00', NULL, 2, 2, 1),
(28, 'Poplava 2', 'Ovo je druga poplava za redom, prilažem sliku! Molim pomoć. Utopit ćemo se. aaaaaaa', 'poplava', '2021-05-24 16:50:14', '2021-12-31 10:15:15', NULL, 2, 2, 1),
(29, 'Poplava 3', 'Jao voda nas pobi. Jao pomoć. Topim se. jaoo *gulp*  *gulp*', 'poplava', '2021-05-24 16:50:45', '2021-05-24 07:15:15', NULL, 2, 2, 1),
(30, 'Požar 2', 'Izgorjela kuća. Molim pomoć...', 'gori vatra jao meni', '2021-05-24 19:22:08', '2021-01-01 22:01:01', NULL, 2, 3, 2),
(31, 'Stravična krađa', 'Teške lopuže! Ukrali mi TV...', 'lopuže', '2021-05-24 20:34:27', '2021-12-31 22:23:23', NULL, 2, 1, 1);

--
-- Dumping data for table `donacije`
--

INSERT INTO `donacije` VALUES
(1, 345.25, 3, 1),
(2, 25, 4, 2),
(3, 650, 1, 1),
(4, 1250, 5, 2),
(5, 110.5, 6, 1);

--
-- Dumping data for table `steta_dokazi`
--

INSERT INTO `steta_dokazi` VALUES
(1, 1),
(2, 2),
(23, 27),
(24, 28),
(25, 29),
(26, 30),
(27, 31),
(28, 32),
(29, 33),
(30, 34),
(31, 35);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
