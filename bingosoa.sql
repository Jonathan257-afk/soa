-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 12 juin 2024 à 15:02
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bingosoa`
--

-- --------------------------------------------------------

--
-- Structure de la table `bingo`
--

CREATE TABLE `bingo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dateDebut` datetime NOT NULL,
  `date` datetime NOT NULL,
  `libelle` varchar(191) NOT NULL,
  `montant` int(11) NOT NULL,
  `ticket` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `association_id` int(11) NOT NULL,
  `tirage` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `bingoticket`
--

CREATE TABLE `bingoticket` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `achat_id` int(11) NOT NULL,
  `bingo_id` int(11) NOT NULL,
  `num_ticket` int(11) NOT NULL,
  `number` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `gagnantbingo`
--

CREATE TABLE `gagnantbingo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bingoticket_id` int(11) NOT NULL,
  `bingo_id` int(11) NOT NULL,
  `lotbingo_id` int(11) NOT NULL,
  `gagnant_at` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lotbingo`
--

CREATE TABLE `lotbingo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number` int(11) NOT NULL,
  `libelle` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `link` varchar(191) DEFAULT NULL,
  `bingo_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(12, '2024_02_27_053709_create_bingo_table', 1),
(13, '2024_02_27_054416_create_lotbingos_table', 1),
(14, '2024_03_01_130408_create_bingotickets_table', 1),
(15, '2024_03_01_143714_create_gagnantbingos_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bingo`
--
ALTER TABLE `bingo`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bingoticket`
--
ALTER TABLE `bingoticket`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gagnantbingo`
--
ALTER TABLE `gagnantbingo`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lotbingo`
--
ALTER TABLE `lotbingo`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bingo`
--
ALTER TABLE `bingo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `bingoticket`
--
ALTER TABLE `bingoticket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `gagnantbingo`
--
ALTER TABLE `gagnantbingo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lotbingo`
--
ALTER TABLE `lotbingo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
