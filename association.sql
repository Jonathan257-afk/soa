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
-- Base de données : `association`
--

-- --------------------------------------------------------

--
-- Structure de la table `achat`
--

CREATE TABLE `achat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bienfetaire_id` int(11) DEFAULT NULL,
  `tombola_id` int(11) DEFAULT NULL,
  `bingo_id` int(11) DEFAULT NULL,
  `ticket` int(11) NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `association`
--

CREATE TABLE `association` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `stripe` varchar(191) DEFAULT NULL,
  `paypal_id` int(11) DEFAULT NULL,
  `gpay` varchar(191) DEFAULT NULL,
  `interet` varchar(191) NOT NULL,
  `cerfa` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `bienfetaire`
--

CREATE TABLE `bienfetaire` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `first_name` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `tel` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `confirmaccount`
--

CREATE TABLE `confirmaccount` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) NOT NULL,
  `code` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `don`
--

CREATE TABLE `don` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bienfetaire_id` int(11) DEFAULT NULL,
  `achat_id` int(11) DEFAULT NULL,
  `tombola_id` int(11) DEFAULT NULL,
  `bingo_id` int(11) DEFAULT NULL,
  `montant` int(11) NOT NULL,
  `ticket` int(11) NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `association_id` int(11) DEFAULT NULL,
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
(102, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(103, '2024_02_05_163713_create_association_table', 1),
(104, '2024_02_08_143140_create_don_table', 1),
(105, '2024_02_08_143204_create_achat_table', 1),
(106, '2024_02_08_143220_create_bienfetaire_table', 1),
(107, '2024_02_17_035417_create_paypal_table', 1),
(108, '2024_03_10_130136_create_confirmaccounts_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `paypal`
--

CREATE TABLE `paypal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `clientId` varchar(191) NOT NULL,
  `clientSecret` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Index pour la table `achat`
--
ALTER TABLE `achat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `association`
--
ALTER TABLE `association`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `association_email_unique` (`email`);

--
-- Index pour la table `bienfetaire`
--
ALTER TABLE `bienfetaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `confirmaccount`
--
ALTER TABLE `confirmaccount`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `confirmaccount_email_unique` (`email`),
  ADD UNIQUE KEY `confirmaccount_code_unique` (`code`);

--
-- Index pour la table `don`
--
ALTER TABLE `don`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paypal`
--
ALTER TABLE `paypal`
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
-- AUTO_INCREMENT pour la table `achat`
--
ALTER TABLE `achat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `association`
--
ALTER TABLE `association`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `bienfetaire`
--
ALTER TABLE `bienfetaire`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `confirmaccount`
--
ALTER TABLE `confirmaccount`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `don`
--
ALTER TABLE `don`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT pour la table `paypal`
--
ALTER TABLE `paypal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
