-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 23 sep. 2023 à 15:59
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `snowtricks`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(2, 'Grabs'),
(3, 'Butters'),
(4, 'Flips'),
(5, 'Spins');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author_id` int DEFAULT NULL,
  `trick_id` int NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CF675F31B` (`author_id`),
  KEY `IDX_9474526CB281BE2E` (`trick_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `author_id`, `trick_id`, `content`, `created_at`) VALUES
(60, 1, 51, 'zfrzaf', '2023-09-21 14:59:48'),
(61, 1, 51, 'zfrzaf', '2023-09-21 15:18:31'),
(62, 1, 51, 'qsdfqsdq', '2023-09-21 16:23:11'),
(63, 1, 51, 'fqsfdqdq', '2023-09-21 16:23:19'),
(64, 1, 51, 'fqdfqdffqsfqsdf', '2023-09-21 16:23:36'),
(65, 1, 51, 'fseffdqdqdzd', '2023-09-21 16:23:47'),
(66, 1, 51, 'fsfesfsfdsqefseqf', '2023-09-21 16:23:54'),
(67, 32, 54, 'jfqsu', '2023-09-22 13:44:23');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230713154738', '2023-07-13 15:49:25', 57),
('DoctrineMigrations\\Version20230718124915', '2023-07-18 12:50:06', 39),
('DoctrineMigrations\\Version20230718133107', '2023-07-18 13:31:18', 336),
('DoctrineMigrations\\Version20230720184719', '2023-07-20 18:47:38', 39),
('DoctrineMigrations\\Version20230721160933', '2023-07-21 16:09:55', 77),
('DoctrineMigrations\\Version20230724091354', '2023-07-24 09:14:04', 25),
('DoctrineMigrations\\Version20230724154728', '2023-07-24 15:48:36', 38),
('DoctrineMigrations\\Version20230724165206', '2023-07-24 16:52:13', 103),
('DoctrineMigrations\\Version20230725135648', '2023-07-25 13:56:56', 55),
('DoctrineMigrations\\Version20230725190755', '2023-07-25 19:08:03', 95),
('DoctrineMigrations\\Version20230727143831', '2023-07-27 14:38:38', 123),
('DoctrineMigrations\\Version20230810145438', '2023-08-10 14:54:48', 57),
('DoctrineMigrations\\Version20230923131104', '2023-09-23 13:11:27', 42);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trick_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_C53D045FB281BE2E` (`trick_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `trick_id`, `name`, `update_at`) VALUES
(35, 42, '7ef093aafd58e8d78e5ec470acbc9f27.webp', NULL),
(37, 44, '7e5df36e5ba443928945b0c6e9224e75.webp', NULL),
(38, 45, '0997baf5f2b9e75d5417601a3e20ba8e.webp', NULL),
(39, 46, 'bf061ebb3b01b486db41fb0de8ffcc46.webp', NULL),
(40, 46, '74403e08b928fdc4cddf8732da901524.webp', NULL),
(41, 47, 'f5c7255d08f4b68869e6d9e6dddb9fdf.webp', NULL),
(42, 47, '789f56e0fa93a495d7701195b3567e66.webp', NULL),
(43, 48, '597c7a124106e2228898763ba468fce3.webp', NULL),
(44, 48, '84ce0ed05f45c08d3b479aa3b8d0f614.webp', NULL),
(45, 49, '41386f44e349bb9642792e24fbd84522.webp', NULL),
(46, 49, 'f25f8c1e8e9dbeee18976dd1d1b21d79.webp', NULL),
(50, 54, 'b437cde6c7b8a2930a0e45bc51030985.webp', NULL),
(51, 54, 'd2ac7c08e8f6db7a073a8368516c3a35.webp', NULL),
(52, 54, '7f848ab82a87f7ebcc8b6bb952ccdfa9.webp', NULL),
(53, 51, '7dbb41abc027ba31a718587460f29a85.webp', NULL),
(54, 55, '11d6c4354a20d080535d6ca2e8b7fea8.webp', NULL),
(55, 56, '0714d73f207102e943549c0d219508a7.webp', NULL),
(56, 57, '9de5470760adf5e8a5d866585bdcd873.webp', NULL),
(57, 58, 'a15772243daa6e5bcd0cfd65c5494dd1.webp', NULL),
(58, 59, '26f2656726088f0b6826c9d062a56e96.webp', NULL),
(59, 60, '884386bf1155c37389b92bf9d0356623.webp', NULL),
(63, 67, '28ea84b5388b80ce9ba1ddbeb650f766.webp', NULL),
(64, 67, 'a4f7fdcebd27a6e841ba6873ebef9558.webp', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `messenger_messages`
--

INSERT INTO `messenger_messages` (`id`, `body`, `headers`, `queue_name`, `created_at`, `available_at`, `delivered_at`) VALUES
(1, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":4:{i:0;s:24:\\\"email/register.html.twig\\\";i:1;N;i:2;a:1:{s:4:\\\"user\\\";O:15:\\\"App\\\\Entity\\\\User\\\":8:{s:19:\\\"\\0App\\\\Entity\\\\User\\0id\\\";i:20;s:22:\\\"\\0App\\\\Entity\\\\User\\0email\\\";s:15:\\\"test@ttest.test\\\";s:22:\\\"\\0App\\\\Entity\\\\User\\0roles\\\";a:0:{}s:25:\\\"\\0App\\\\Entity\\\\User\\0password\\\";s:60:\\\"$2y$13$Bkcnm8Duk./bTxNmu.JoPuWDEt3dR9HjzqFrXGhdlreaL6vcDQSLm\\\";s:25:\\\"\\0App\\\\Entity\\\\User\\0username\\\";s:4:\\\"test\\\";s:27:\\\"\\0App\\\\Entity\\\\User\\0isVerified\\\";b:0;s:25:\\\"\\0App\\\\Entity\\\\User\\0comments\\\";O:33:\\\"Doctrine\\\\ORM\\\\PersistentCollection\\\":2:{s:13:\\\"\\0*\\0collection\\\";O:43:\\\"Doctrine\\\\Common\\\\Collections\\\\ArrayCollection\\\":1:{s:53:\\\"\\0Doctrine\\\\Common\\\\Collections\\\\ArrayCollection\\0elements\\\";a:0:{}}s:14:\\\"\\0*\\0initialized\\\";b:1;}s:26:\\\"\\0App\\\\Entity\\\\User\\0createdAt\\\";O:17:\\\"DateTimeImmutable\\\":3:{s:4:\\\"date\\\";s:26:\\\"2023-07-21 21:40:29.378517\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:22:\\\"no-reply@snowtricks.fr\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:15:\\\"test@ttest.test\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:40:\\\"activatio de votre compte sur Snowtricks\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2023-07-21 21:40:29', '2023-07-21 21:40:29', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tricks`
--

DROP TABLE IF EXISTS `tricks`;
CREATE TABLE IF NOT EXISTS `tricks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `main_image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int DEFAULT NULL,
  `author_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `slogan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E1D902C15E237E06` (`name`),
  KEY `IDX_E1D902C112469DE2` (`category_id`),
  KEY `IDX_E1D902C1F675F31B` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tricks`
--

INSERT INTO `tricks` (`id`, `name`, `slug`, `description`, `update_at`, `main_image_name`, `category_id`, `author_id`, `created_at`, `slogan`) VALUES
(42, 'BACKSIDE RODEO 1080', 'BACKSIDE-RODEO-1080', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus est diam, tincidunt ac lorem sed, vehicula lobortis ligula. Nullam id scelerisque magna, et cursus arcu. Proin eleifend lacus sit amet bibendum imperdiet. Fusce a iaculis ex, eu euismod nisl. Proin ut fringilla nunc, ac suscipit magna. Curabitur mollis in ipsum vitae ullamcorper. In quis diam ut eros faucibus accumsan in ut est. In nec finibus ex. Etiam vulputate aliquet tortor ac consectetur. Etiam ac tortor aliquet, aliquam lacus efficitur, blandit nisl. Vestibulum in orci ut massa semper ultrices ut et nibh. Sed laoreet cursus libero eget maximus. Integer non lacus cursus tellus porttitor placerat ut sit amet magna. Pellentesque sagittis fringilla massa eget bibendum. Etiam vestibulum pretium risus, in sollicitudin nisl mollis nec. Integer quis turpis vulputate, volutpat ligula nec, dignissim dolor. Suspendisse potenti. Sed eget nunc vitae urna sodales euismod. Vestibulum mollis, metus at gravida malesuada, enim leo pharetra eros, at volutpat sem odio a l', '2023-09-23 13:45:55', '7ef093aafd58e8d78e5ec470acbc9f27.webp', 5, 1, '2023-09-19 20:33:02', 'test phrase d accroche'),
(44, 'STALEFISH', 'STALEFISH', 'ldzaqdzqafdqzfqzdqzd', '2023-09-23 13:44:26', '7e5df36e5ba443928945b0c6e9224e75.webp', 2, 1, '2023-09-19 20:41:05', 'test phrase d accroche'),
(45, 'FRONTFLIP', 'Rotation-en-avant', 'zefdcqsdqdqdqzdqzdqzd', NULL, '0997baf5f2b9e75d5417601a3e20ba8e.webp', 2, 31, '2023-09-19 20:42:46', ''),
(46, 'BACKFLIP', 'Rotation-en-arriere', 'dqdqzdqzdqzdqzdzqdqzd', NULL, '74403e08b928fdc4cddf8732da901524.webp', 4, 31, '2023-09-19 20:44:13', ''),
(47, 'RODEO', 'Le-rodeo-est-une-rotation-desaxee-qui-se-reconnait-par-son-aspect-vrille', 'dqzdzqafzqfzfzaqdzqdqd', NULL, '789f56e0fa93a495d7701195b3567e66.webp', 5, 31, '2023-09-19 20:47:24', ''),
(48, 'NOSE GRAB', 'fdoluqzhfdiqhdqsldhoqjoidj', 'zdzqdzqdzqf', NULL, '84ce0ed05f45c08d3b479aa3b8d0f614.webp', 2, 31, '2023-09-19 20:50:16', ''),
(49, 'CORK', 'CORK', 'fzqfdqzdqzdqzdzq', '2023-09-23 13:14:53', 'f25f8c1e8e9dbeee18976dd1d1b21d79.webp', 5, 1, '2023-09-19 20:51:51', 'test phrase d accroche'),
(50, 'NOSE SLIDE', 'NOSE-SLIDE', 'dzqfzqfdqzdzqdqzdqzsdzqdqz', '2023-09-23 13:25:17', 'default.webp', 2, 1, '2023-09-19 20:53:36', 'test phrase d accroche'),
(51, 'TAIL SLIDE', 'TAIL-SLIDE', 'dqzfqzfqzdzqd', '2023-09-23 13:37:27', '7dbb41abc027ba31a718587460f29a85.webp', 3, 1, '2023-09-19 20:55:47', 'test phrase d accroche'),
(54, 'INDI GRAB', 'INDI-GRAB', 'fsmdfijsjfqsdqsjdqhdhq', '2023-09-23 13:45:12', '7f848ab82a87f7ebcc8b6bb952ccdfa9.webp', 2, 1, '2023-09-22 13:43:32', 'test phrase d accroche'),
(55, 'MUTE', 'MUTE', 'efzeqfqdfqzdeqzzqf', NULL, '11d6c4354a20d080535d6ca2e8b7fea8.webp', 2, 1, '2023-09-23 13:54:22', 'saisie de la carre frontside de la planche entre les deux pieds avec la main avant'),
(56, 'JAPAN AIR', 'JAPAN-AIR', 'zertzerfrezsfesfesfes', NULL, '0714d73f207102e943549c0d219508a7.webp', 2, 1, '2023-09-23 13:58:04', 'saisie de l\'avant de la planche, avec la main avant, du côté de la carre frontside'),
(57, 'SEAT BELT', 'SEAT-BELT', 'edfsqdfqdqdq', NULL, '9de5470760adf5e8a5d866585bdcd873.webp', 2, 1, '2023-09-23 14:08:10', 'saisie du carre frontside à l\'arrière avec la main avant'),
(58, 'TRUCK DRIVER', 'TRUCK-DRIVER', 'zdqzfqzfdqzdqzdqzd', NULL, 'a15772243daa6e5bcd0cfd65c5494dd1.webp', 2, 1, '2023-09-23 14:19:28', 'saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture)'),
(59, 'MISTY', 'MISTY', 'zdqdqzdzq', NULL, '26f2656726088f0b6826c9d062a56e96.webp', 5, 1, '2023-09-23 14:21:42', 'test phrase d accroche'),
(60, 'MC TWIST', 'MC-TWIST', 'edfzzqdqzdqzdqz', NULL, '884386bf1155c37389b92bf9d0356623.webp', 4, 1, '2023-09-23 14:23:55', 'test phrase d accroche'),
(67, 'TEST VIDEO', 'TEST-VIDEO', 'skudfolkwsdfoyqsi', NULL, 'a4f7fdcebd27a6e841ba6873ebef9558.webp', 2, 1, '2023-09-23 15:52:50', 'test phrase d accroche');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `reset_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `username`, `is_verified`, `created_at`, `reset_token`) VALUES
(1, 'cece4526@hotmail.fr', '[\"ROLE_ADMIN\"]', '$2y$13$jLjC695U0twLOWTimrKViehx8iXZNTMPTNvTj1xSuWC2.1Qxn0Vb.', 'cece4526', 1, '2023-07-21 17:30:14', ''),
(27, 'test@test.test', '[]', '$2y$13$.ktPXBzKUOD88EhMsEoBROXXF2r1sqzY8Oe0GcTVXTTQSi0ujafBy', 'test', 1, '2023-07-27 09:13:54', NULL),
(28, 'test1@test.test', '[]', '$2y$13$z5Csh1HEOSwf8HOLFrhEjOFMvAjbw6thekdVlBPq9k/zKRMJQFMeu', 'test1', 1, '2023-07-27 15:09:33', 'R4YIEJ9BXldrjTHc9m4UPPSJhlJd71ObQ7XsEtB7rgY'),
(29, 'testdelete@delete.delete', '[]', '$2y$13$S4UwTiIRZw5FIc0nG43De./mSD3aKbQCVF.jueWEeTKlmp7gIULu.', 'delete', 1, '2023-08-03 13:04:11', NULL),
(30, 'testr@testr.fr', '[]', '$2y$13$Sf9G6/cmQiHwh55rgkF14ejd834bDHbxIr2Y/Gry0Y9OIzG76Gwwe', 'testR', 1, '2023-09-04 08:01:24', NULL),
(31, 'admin@snowtrick.fr', '[\"ROLE_ADMIN\"]', '$2y$13$sSMuaSV.ZfXtZmAczcMga.mpJqxn8peyxgJBMHZsQb6VeWAOmJJgS', 'admin', 1, '2023-09-19 20:23:10', NULL),
(32, 'test@test.fr', '[]', '$2y$13$udOv6tIgafDaCvPgsxDlzOPoax4LVbtPRZdLzs/VZ9Ljxy3ElSbO2', 'jimmy', 1, '2023-09-22 13:36:40', '');

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trick_id` int DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CC7DA2CB281BE2E` (`trick_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id`, `trick_id`, `link`, `update_at`) VALUES
(3, 42, 'https://www.youtube.com/embed/vquZvxGMJT0?si=Msvqlx8XhERamaNo', NULL),
(5, 44, 'https://www.youtube.com/embed/f9FjhCt_w2U?si=TYuv0zzjZ3SHYrx0', NULL),
(6, 45, 'https://www.youtube.com/embed/eGJ8keB1-JM?si=R-9U2SJjsufloXn_', NULL),
(7, 46, 'https://www.youtube.com/embed/arzLq-47QFA?si=d8uFo3hXqmoFmJRA', NULL),
(8, 47, 'https://www.youtube.com/embed/vf9Z05XY79A?si=NyWuj2NEgEeIBMCK', NULL),
(9, 48, 'https://www.youtube.com/embed/y2MHu0mbzQw?si=gXayWLDUI6EqUEK7', NULL),
(10, 49, 'https://www.youtube.com/embed/FMHiSF0rHF8?si=BtsY9VBIQCR4JYxd', NULL),
(11, 50, 'https://www.youtube.com/embed/oAK9mK7wWvw?si=8VXAyx-51tT_1zVo', NULL),
(22, 49, 'https://youtu.be/4AlDWWsprZM?si=prf8gSrrbxcHd_u0', NULL),
(23, 51, 'https://www.youtube.com/watch?v=oAK9mK7wWvw', NULL),
(24, 55, 'https://youtu.be/k6aOWf0LDcQ?si=Oqon-yqYHxkZYny9', NULL),
(25, 56, 'https://youtu.be/jH76540wSqU?si=5Vt3Gk_biPjuVeSR', NULL),
(26, 57, 'https://youtu.be/4vGEOYNGi_c?si=5eC7dPASQUsD7wJw', NULL),
(27, 58, 'https://www.youtube.com/watch?v=OMxJRz06Ujc', NULL),
(28, 59, 'https://youtu.be/DHWlxQ90ZCI?si=ouNLwrR7nB6rGsN0', NULL),
(29, 60, 'https://youtu.be/k-CoAquRSwY?si=l1KfZFeuNj0ek5UG', NULL),
(32, 67, 'https://www.youtube.com/watch?v=oAK9mK7wWvw', NULL),
(33, 67, 'https://youtu.be/4AlDWWsprZM?si=prf8gSrrbxcHd_u0', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526CB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `tricks` (`id`),
  ADD CONSTRAINT `FK_9474526CF675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045FB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `tricks` (`id`);

--
-- Contraintes pour la table `tricks`
--
ALTER TABLE `tricks`
  ADD CONSTRAINT `FK_E1D902C112469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_E1D902C1F675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `FK_7CC7DA2CB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `tricks` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
