-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 31, 2024 at 02:51 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `videos`
--

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int NOT NULL,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `categories` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_publication` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `duree` int NOT NULL,
  `score` int NOT NULL DEFAULT '0',
  `sous_titres` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `url_image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nom_auteur` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `utilisateur` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `verifie` tinyint(1) NOT NULL,
  `description_auteur` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `nom`, `description`, `code`, `categories`, `date_publication`, `duree`, `score`, `sous_titres`, `url_image`, `nom_auteur`, `utilisateur`, `verifie`, `description_auteur`) VALUES
(1, 'Je vous présente mon nouveau CHAT! - VLOG #202', 'Découvrez le tout dernier membre de notre famille, Misty! Dans ce 202e vlog, je vous présente mon adorable nouveau chat et partage avec vous les moments spéciaux de notre première rencontre.', '123BBB', 'Style de vie;Vlog', '12/12/2021', 743, 8001, 'ss', 'https://picsum.photos/id/250/300/200', 'Emmy Johnson', 'emmy_johnson', 1, 'Amoureuse des animaux, passionnée de photographie et toujours en quête d\'aventures.'),
(2, 'Top 12 des plus beaux endroits pour une excursion en montagne', 'Découvrez les endroits les plus incroyables pour une aventure en montagne dans cette vidéo palpitante!', '456ABC', 'Aventure;Style de vie', '16/08/2022', 430, 3000, 'ss', 'https://picsum.photos/id/29/300/200', 'John Smith', 'john_smith99', 0, 'Amateur de randonnée et amoureux de la nature qui aime partager et faire découvrir sa passion.'),
(4, 'L\'évolution de la photographie au fil des années', 'Plongez avec moi dans l\'histoire de la photographie et découvrez comment elle a évolué au fil des décennies!', '767JDK', 'Historique;Éducation', '30/04/2020', 360, 3100, 'ss', 'https://picsum.photos/id/250/300/200', 'Alice Dupont', 'alice_photographe', 0, 'Photographe professionnelle passionnée par l\'art visuel.'),
(5, 'Les 5 meilleurs trucs pour être plus productif - À VOIR!', 'Apprenez 5 astuces essentielles pour améliorer votre productivité au quotidien.', '819AIF', 'Style de vie', '23/07/2023', 240, -5001, 'ss', 'https://picsum.photos/id/180/300/200', 'David Martin', 'david_martin88', 0, 'Entrepreneur et coach en efficacité.'),
(6, 'Les Vagabonds de l\'Horizon - Rêves d\'émeraude (Performance Live)', 'Visionnez une performance live époustouflante du groupe Les Vagabonds de l\'Horizon, qui interprètent leur nouvelle chanson Rêves d\'émeraude.', '154JDI', 'Musique', '04/05/2022', 180, 8600, 'ss', 'https://picsum.photos/id/453/300/200', 'Les Vagabonds de l\'Horizon', 'lesvagabondsdelhorizon', 1, 'Groupe musical folk explorant de nouveaux horizons artistiques.'),
(7, 'Élise Maréchal - Lueurs d\'aurore (Vidéoclip officiel)', 'Découvrez le vidéoclip officiel tant attendu de ma nouvelle chanson, Lueurs d\'aurore!', '482SUB', 'Musique', '14/01/2023', 240, 6800, 'ss', 'https://picsum.photos/id/399/300/200', 'Élise Maréchal', 'elisemarechal', 1, 'Artiste musicale émergente qui allie guitare, piano et voix pour livrer des pièces envoûtantes aux tonalités pop.'),
(8, 'Yogourt avec crumble aux fraises maison - Les recettes d\'Aurélie', 'Découvrez ma délicieuse recette de yogourt avec crumble aux fraises! Il s\'agit du déjeuner parfait.', '130CIR', 'Cuisine;Style de vie', '08/03/2019', 300, 4600, 'cc', 'https://picsum.photos/id/493/300/200', 'Les Recettes d\'Aurélie', 'lesrecettesdaurelie', 0, 'Passionnée de cuisine et créatrice de recettes originales.'),
(9, 'Comment créer son propre terrarium? - Jardinez avec Sophie', 'Apprenez à créer votre propre terrarium en visionnant cette vidéo, qui explique chaque étape nécessaire pour y arriver!', '182ODA', 'Style de vie', '15/01/2017', 425, -7000, 'cc', 'https://picsum.photos/id/530/300/200', 'Sophie Tremblay', 'sophie_jardinage', 0, 'Jardinière expérimentée qui aime partager sa passion pour les plantes.'),
(10, 'Le mystère des pyramides d\'Égypte', 'Les pyramides d\'Égypte vous ont toujours fasciné? Apprenez-en davantage sur ce mystère historique!', '987POI', 'Historique', '09/02/2023', 980, 7000, 'ss', 'https://picsum.photos/id/29/300/200', 'Canal Découverte', 'canal_decouverte', 1, 'Canal destiné aux adeptes de mystères et d\'enquêtes.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
