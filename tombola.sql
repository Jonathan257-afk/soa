-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 12 juin 2024 à 15:03
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
-- Base de données : `tombola`
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
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
-- Structure de la table `lot`
--

CREATE TABLE `lot` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number` int(11) NOT NULL,
  `libelle` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `link` varchar(191) DEFAULT NULL,
  `tombola_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
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
(171, '2014_10_12_000000_create_users_table', 1),
(172, '2014_10_12_100000_create_password_resets_table', 1),
(173, '2019_08_19_000000_create_failed_jobs_table', 1),
(174, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(175, '2024_02_02_125349_create_tombola_table', 1),
(176, '2024_02_02_160126_create_lot_table', 1),
(177, '2024_02_05_163713_create_association_table', 1),
(178, '2024_02_08_143140_create_don_table', 1),
(179, '2024_02_08_143204_create_achat_table', 1),
(180, '2024_02_08_143220_create_bienfetaire_table', 1),
(181, '2024_02_17_035417_create_paypal_table', 1),
(182, '2024_02_27_053709_create_bingo_table', 1),
(183, '2024_02_27_054416_create_lotbingos_table', 1),
(184, '2024_03_01_130408_create_bingotickets_table', 1),
(185, '2024_03_01_143714_create_gagnantbingos_table', 1),
(186, '2024_03_06_052505_create_viewresults_table', 1),
(187, '2024_03_10_130136_create_confirmaccounts_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Structure de la table `tombola`
--

CREATE TABLE `tombola` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dateDebut` datetime NOT NULL,
  `date` datetime NOT NULL,
  `libelle` varchar(191) NOT NULL,
  `montant` int(11) NOT NULL,
  `ticket` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `association_id` int(11) NOT NULL,
  `useTirage` varchar(10) NOT NULL,
  `debut` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `first_name` varchar(191) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `tel` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `isAsso` varchar(10) NOT NULL,
  `verified` varchar(10) NOT NULL,
  `association_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `viewresult`
--

CREATE TABLE `viewresult` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `bingo_id` int(11) DEFAULT NULL,
  `tombola_id` int(11) DEFAULT NULL,
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
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `gagnantbingo`
--
ALTER TABLE `gagnantbingo`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lot`
--
ALTER TABLE `lot`
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
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- Index pour la table `tombola`
--
ALTER TABLE `tombola`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `viewresult`
--
ALTER TABLE `viewresult`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `gagnantbingo`
--
ALTER TABLE `gagnantbingo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lot`
--
ALTER TABLE `lot`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

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

--
-- AUTO_INCREMENT pour la table `tombola`
--
ALTER TABLE `tombola`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `viewresult`
--
ALTER TABLE `viewresult`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
