-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 29 mai 2024 à 19:26
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_lms`
--

-- --------------------------------------------------------

--
-- Structure de la table `ch_favorites`
--

CREATE TABLE `ch_favorites` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint NOT NULL,
  `favorite_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ch_favorites`
--

INSERT INTO `ch_favorites` (`id`, `user_id`, `favorite_id`, `created_at`, `updated_at`) VALUES
('1701d091-73e1-408b-8ebf-b6881bbdc5d3', 6, 4, '2024-05-29 12:29:02', '2024-05-29 12:29:02'),
('1b6945f6-d354-467b-8539-4b202506617b', 4, 8, '2024-05-29 12:12:04', '2024-05-29 12:12:04'),
('df5a1fab-436e-4021-a35d-6109960330f8', 8, 4, '2024-05-29 12:13:51', '2024-05-29 12:13:51');

-- --------------------------------------------------------

--
-- Structure de la table `ch_messages`
--

CREATE TABLE `ch_messages` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint NOT NULL,
  `to_id` bigint NOT NULL,
  `body` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ch_messages`
--

INSERT INTO `ch_messages` (`id`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
('01d4e552-9a9b-4b1a-b084-03f3ab18ed40', 6, 8, 'd&#039;accord mademoiselle camara', NULL, 1, '2024-05-29 12:28:45', '2024-05-29 12:29:15'),
('0352a290-069a-4cfd-bc91-de618c9f75cc', 8, 4, 'je vois pas l&#039;images', NULL, 1, '2024-05-29 12:24:35', '2024-05-29 12:24:36'),
('0c12a76c-e901-49d8-896f-e1f00017f5b9', 4, 8, 'd&eacute;sol&eacute; pour le desagr&eacute;ment', NULL, 1, '2024-05-29 12:25:53', '2024-05-29 12:26:05'),
('2c5e0a7b-cd9d-48a3-95d3-63c742525de3', 4, 6, '', '{\"new_name\":\"e7a00838-df59-44e9-9596-948baa4319fc.jpg\",\"old_name\":\"9671503-lms-banner-web-vector-illustration-concept-for-learning-management-system-with-icon-vectoriel.jpg\"}', 1, '2024-05-28 23:56:41', '2024-05-29 12:28:15'),
('3032aeed-4987-4c50-99d1-1fb766cae475', 8, 8, 'HI', NULL, 1, '2024-05-29 12:14:39', '2024-05-29 12:14:44'),
('3c34af07-a8a2-4ad6-bc0f-b8a0e8346c28', 8, 4, 'ou bonjour monsieur', NULL, 1, '2024-05-29 12:13:59', '2024-05-29 12:17:43'),
('46feb18a-129f-4c24-a4a9-e6e1cf20ca35', 4, 6, 'salut cher prof pouvez-vous mettre &agrave; jour votre cours et pr&eacute;parer la p&eacute;riode des examens', NULL, 1, '2024-05-18 08:47:36', '2024-05-29 12:28:15'),
('5f3a14ec-3158-4883-82dd-613551f235d0', 6, 4, 'merci monsieur', NULL, 0, '2024-05-29 12:28:31', '2024-05-29 12:28:31'),
('8f09f55e-9c21-417b-ad3b-0f786aada76d', 4, 6, '', '{\"new_name\":\"91d6155e-66a0-4178-b9c4-3517b1e4c7a9.png\",\"old_name\":\"html-css-js.png\"}', 1, '2024-05-18 08:48:00', '2024-05-29 12:28:15'),
('9ad70cc8-6f60-461f-a837-9800481eb6ab', 4, 6, '', '{\"new_name\":\"9c22847f-84ca-4292-8c2d-8b40a75c299f.png\",\"old_name\":\"Polyvalence btp.png\"}', 1, '2024-05-12 09:20:12', '2024-05-29 12:28:15'),
('9efe7f22-9efa-4adb-9bf7-1d42fde7a65f', 8, 4, 'non aucun soucis', NULL, 1, '2024-05-29 12:26:19', '2024-05-29 12:26:46'),
('a3a8c154-6e5c-43da-b5f5-c1e215c7b857', 4, 8, '😇😇😇', NULL, 1, '2024-05-29 12:12:14', '2024-05-29 12:13:48'),
('a4c5a5d6-e0da-4735-8212-4dcb9dd3f1b9', 4, 8, 'salut mademoiselle camara', NULL, 1, '2024-05-29 12:09:40', '2024-05-29 12:13:48'),
('b88c7890-9336-4bd8-a211-1694ec9f9a9e', 4, 8, '', '{\"new_name\":\"6d79953b-b25b-48c8-bb22-ff25a67f4e56.jpg\",\"old_name\":\"WhatsApp Image 2024-05-28 &agrave; 20.06.55_06fc091f.jpg\"}', 1, '2024-05-29 12:17:51', '2024-05-29 12:18:07'),
('bd95a511-95dd-46e2-a3bd-2abbaccb20a1', 8, 6, '🙏🏽', NULL, 0, '2024-05-29 12:29:29', '2024-05-29 12:29:29'),
('fee0d220-1c3f-4b2b-bed1-40368eb6dc42', 8, 6, 'bonsoir monsieur pouvez-vous ajouter le nouveau cours', NULL, 1, '2024-05-29 12:26:43', '2024-05-29 12:28:34');

-- --------------------------------------------------------

--
-- Structure de la table `courses`
--

CREATE TABLE `courses` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` int DEFAULT NULL,
  `course_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `published` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `courses`
--

INSERT INTO `courses` (`id`, `title`, `slug`, `description`, `price`, `course_image`, `start_date`, `published`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Programmation web côté serveur', 'programmation-côté-serveur', 'Le cours de programmation côté serveur explore les langages et les technologies nécessaires à la création d\'applications web et de services qui s\'exécutent sur le serveur. Il couvre une gamme de langages, y compris PHP, Python, Java, Ruby, Node.js, etc., ainsi que des frameworks populaires comme Laravel pour PHP, Flask et Django pour Python, Spring pour Java, Ruby on Rails pour Ruby, et Express.js pour Node.js. Les étudiants apprennent les concepts fondamentaux tels que la gestion des requêtes HTTP, la manipulation des données, la sécurité, l\'utilisation des bases de données, ainsi que des compétences pratiques telles que le déploiement et la gestion des applications côté serveur. L\'objectif est de fournir aux étudiants les compétences nécessaires pour concevoir, développer et déployer des applications web robustes et évolutives.', 200, 'images/courses/3WsSoGf1igorBnh2BAnsNT4zQKDudfuuymMqD1gc.png', '2024-05-12', 1, '2024-05-12 07:47:10', '2024-05-12 07:47:10', NULL),
(2, 'Programmation Web Côté Client', 'programmation-web-côté-client', 'Explorez les fondamentaux de la programmation côté client avec notre cours de Programmation Web Côté Client. Apprenez à créer des expériences utilisateur interactives en utilisant HTML, CSS et JavaScript. Du développement d\'interfaces utilisateur dynamiques à la manipulation des événements, plongez dans les techniques essentielles pour créer des applications web engageantes.', 100, 'images/courses/Wv7Ceg3pqPlusWKYsVwE1FFUCy7vbtbuI7vIzW6a.png', '2024-05-15', 1, '2024-05-15 11:47:45', '2024-05-15 11:47:45', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `course_student`
--

CREATE TABLE `course_student` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `rating` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `course_student`
--

INSERT INTO `course_student` (`id`, `course_id`, `user_id`, `rating`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 5, '2024-05-12 09:26:01', '2024-05-20 12:12:30'),
(2, 1, 4, 5, '2024-05-12 09:26:26', '2024-05-20 12:12:30'),
(3, 1, 8, 0, '2024-05-15 10:48:16', '2024-05-15 10:48:16'),
(4, 2, 8, 0, '2024-05-29 12:39:49', '2024-05-29 12:39:49');

-- --------------------------------------------------------

--
-- Structure de la table `course_user`
--

CREATE TABLE `course_user` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `course_user`
--

INSERT INTO `course_user` (`id`, `course_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 5, NULL, NULL),
(2, 2, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `embed_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `full_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `position` int UNSIGNED DEFAULT NULL,
  `free_lesson` tinyint DEFAULT '0',
  `published` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lessons`
--

INSERT INTO `lessons` (`id`, `course_id`, `title`, `slug`, `embed_id`, `short_text`, `full_text`, `position`, `free_lesson`, `published`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Introduction au langage serveur', 'introduction-langage-server', 'https://www.youtube.com/watch?v=h93BmAF1sJE&pp=ygUfaW50cm9kdWN0aW9uIGF1IGxhbmdhZ2Ugc2VydmV1cg%3D%3D', 'short text', 'full text', 1, 1, 1, '2024-05-12 09:25:43', '2024-05-12 09:25:43', NULL),
(2, 2, 'HTML/CSS #1 - introduction', 'introduction-html-css', 'https://www.youtube.com/watch?v=u5W2NWItytc&list=PLrSOXFDHBtfE5tpw0bjMevWxMWXotiSdO', 'HTML (HyperText Markup Language) structure les pages web avec des éléments comme les titres, paragraphes, liens et images. CSS (Cascading Style Sheets) stylise ces éléments pour améliorer leur apparence. Les styles CSS peuvent être appliqués en ligne, en interne ou via des fichiers externes. Ensemble, HTML et CSS permettent de créer des pages web bien structurées et esthétiques.', 'HTML (HyperText Markup Language) structure les pages web avec des éléments tels que titres, paragraphes, liens et images. CSS (Cascading Style Sheets) stylise et met en page ces éléments. Les styles CSS peuvent être appliqués en ligne, en interne ou via des fichiers externes. Ensemble, HTML et CSS permettent de créer des pages web bien structurées et visuellement attrayantes. Maîtriser ces langages est essentiel pour le développement web.', 1, 1, 1, '2024-05-29 12:39:28', '2024-05-29 12:39:28', NULL),
(3, 2, 'HTML/CSS #2 - première page web', 'premiere-page-web-html', 'https://www.youtube.com/watch?v=Fi8fj_JY91o&list=PLrSOXFDHBtfE5tpw0bjMevWxMWXotiSdO&index=2', 'Vous avez maintenant créé une page web simple en utilisant HTML. Cette page contient un titre, un paragraphe, un lien et une image. Vous pouvez continuer à ajouter plus de contenu et à explorer les différentes balises HTML pour enrichir votre page.', 'Créer votre première page web avec HTML\r\nVoici comment créer une page web simple en utilisant uniquement HTML.\r\n\r\nÉtape 1: Créer le fichier HTML\r\nOuvrez votre éditeur de texte préféré et enregistrez le fichier sous le nom index.html.\r\n\r\nÉtape 2: Ajouter la structure de base\r\nVoici la structure de base d\'un document HTML :\r\n<!DOCTYPE html>\r\n<html lang=\"fr\">\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>Ma Première Page Web</title>\r\n</head>\r\n<body>\r\n    <h1>Bienvenue sur ma première page web</h1>\r\n    <p>Ceci est un paragraphe de texte.</p>\r\n    <a href=\"https://www.example.com\">Visiter Exemple</a>\r\n    <img src=\"image.jpg\" alt=\"Description de l\'image\">\r\n</body>\r\n</html>\r\nÉtape 3: Enregistrer et afficher\r\nEnregistrez le fichier sous le nom index.html.\r\nOuvrez le fichier index.html dans votre navigateur web pour voir votre première page web.', 2, 1, 1, '2024-05-29 12:44:53', '2024-05-29 12:44:53', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `lesson_student`
--

CREATE TABLE `lesson_student` (
  `id` bigint UNSIGNED NOT NULL,
  `lesson_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lesson_student`
--

INSERT INTO `lesson_student` (`id`, `lesson_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '2024-05-12 09:26:01', '2024-05-12 09:26:01'),
(2, 1, 8, '2024-05-15 10:48:16', '2024-05-15 10:48:16'),
(3, 2, 8, '2024-05-29 12:39:49', '2024-05-29 12:39:49');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_12_13_150421_create_courses_table', 1),
(6, '2021_12_13_150921_create_lessons_table', 1),
(7, '2021_12_14_003913_create_course_user_table', 1),
(8, '2022_01_19_052015_create_permissions_table', 1),
(9, '2022_01_19_052129_create_roles_table', 1),
(10, '2022_01_19_052257_create_permission_role_table', 1),
(11, '2022_01_19_052421_create_role_user_table', 1),
(12, '2022_01_20_103259_create_questions_table', 1),
(13, '2022_01_20_103626_create_question_options_table', 1),
(14, '2022_01_20_105431_create_tests_table', 1),
(15, '2022_01_21_055517_create_question_test_table', 1),
(16, '2022_01_22_061749_create_course_student_table', 1),
(17, '2022_01_22_070420_add_rating_to_course_student_table', 1),
(18, '2022_01_22_094153_create_lesson_student_table', 1),
(19, '2022_01_23_140035_create_test_results_table', 1),
(20, '2022_01_23_140224_create_test_result_answers_table', 1),
(21, '2023_11_22_999999_add_active_status_to_users', 1),
(22, '2023_11_22_999999_add_avatar_to_users', 1),
(23, '2023_11_22_999999_add_dark_mode_to_users', 1),
(24, '2023_11_22_999999_add_messenger_color_to_users', 1),
(25, '2023_11_22_999999_create_chatify_favorites_table', 1),
(26, '2023_11_22_999999_create_chatify_messages_table', 1),
(27, '2024_05_23_151313_create_purchases_table', 1),
(28, '2024_05_27_144115_create_virtual_classes_table', 2),
(29, '2024_05_29_153929_add_zoom_columns_to_users_table', 3);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'user_management_access', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(2, 'user_management_create', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(3, 'user_management_edit', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(4, 'user_management_view', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(5, 'user_management_delete', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(6, 'permission_access', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(7, 'permission_create', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(8, 'permission_edit', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(9, 'permission_view', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(10, 'permission_delete', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(11, 'role_access', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(12, 'role_create', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(13, 'role_edit', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(14, 'role_view', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(15, 'role_delete', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(16, 'user_access', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(17, 'user_create', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(18, 'user_edit', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(19, 'user_view', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(20, 'user_delete', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(21, 'course_access', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(22, 'course_create', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(23, 'course_edit', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(24, 'course_view', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(25, 'course_delete', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(26, 'lesson_access', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(27, 'lesson_create', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(28, 'lesson_edit', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(29, 'lesson_view', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(30, 'lesson_delete', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(31, 'question_access', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(32, 'question_create', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(33, 'question_edit', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(34, 'question_view', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(35, 'question_delete', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(36, 'questions_option_access', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(37, 'questions_option_create', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(38, 'questions_option_edit', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(39, 'questions_option_view', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(40, 'questions_option_delete', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(41, 'test_access', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(42, 'test_create', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(43, 'test_edit', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(44, 'test_view', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(45, 'test_delete', '2024-05-11 06:13:19', '2024-05-11 06:13:19');

-- --------------------------------------------------------

--
-- Structure de la table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED DEFAULT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 4, 1, NULL, NULL),
(5, 5, 1, NULL, NULL),
(6, 6, 1, NULL, NULL),
(7, 7, 1, NULL, NULL),
(8, 8, 1, NULL, NULL),
(9, 9, 1, NULL, NULL),
(10, 10, 1, NULL, NULL),
(11, 11, 1, NULL, NULL),
(12, 12, 1, NULL, NULL),
(13, 13, 1, NULL, NULL),
(14, 14, 1, NULL, NULL),
(15, 15, 1, NULL, NULL),
(16, 16, 1, NULL, NULL),
(17, 17, 1, NULL, NULL),
(18, 18, 1, NULL, NULL),
(19, 19, 1, NULL, NULL),
(20, 20, 1, NULL, NULL),
(21, 21, 1, NULL, NULL),
(22, 22, 1, NULL, NULL),
(23, 23, 1, NULL, NULL),
(24, 24, 1, NULL, NULL),
(25, 25, 1, NULL, NULL),
(26, 26, 1, NULL, NULL),
(27, 27, 1, NULL, NULL),
(28, 28, 1, NULL, NULL),
(29, 29, 1, NULL, NULL),
(30, 30, 1, NULL, NULL),
(31, 31, 1, NULL, NULL),
(32, 32, 1, NULL, NULL),
(33, 33, 1, NULL, NULL),
(34, 34, 1, NULL, NULL),
(35, 35, 1, NULL, NULL),
(36, 36, 1, NULL, NULL),
(37, 37, 1, NULL, NULL),
(38, 38, 1, NULL, NULL),
(39, 39, 1, NULL, NULL),
(40, 40, 1, NULL, NULL),
(41, 41, 1, NULL, NULL),
(42, 42, 1, NULL, NULL),
(43, 43, 1, NULL, NULL),
(44, 44, 1, NULL, NULL),
(45, 45, 1, NULL, NULL),
(46, 1, 2, NULL, NULL),
(47, 21, 2, NULL, NULL),
(48, 22, 2, NULL, NULL),
(49, 23, 2, NULL, NULL),
(50, 24, 2, NULL, NULL),
(51, 26, 2, NULL, NULL),
(52, 27, 2, NULL, NULL),
(53, 28, 2, NULL, NULL),
(54, 29, 2, NULL, NULL),
(55, 31, 2, NULL, NULL),
(56, 32, 2, NULL, NULL),
(57, 33, 2, NULL, NULL),
(58, 34, 2, NULL, NULL),
(59, 36, 2, NULL, NULL),
(60, 37, 2, NULL, NULL),
(61, 38, 2, NULL, NULL),
(62, 39, 2, NULL, NULL),
(63, 40, 2, NULL, NULL),
(64, 41, 2, NULL, NULL),
(65, 42, 2, NULL, NULL),
(66, 43, 2, NULL, NULL),
(67, 44, 2, NULL, NULL),
(68, 45, 2, NULL, NULL),
(69, 1, 3, NULL, NULL),
(70, 21, 3, NULL, NULL),
(71, 24, 3, NULL, NULL),
(72, 26, 3, NULL, NULL),
(73, 29, 3, NULL, NULL),
(74, 31, 3, NULL, NULL),
(75, 34, 3, NULL, NULL),
(76, 36, 3, NULL, NULL),
(77, 37, 3, NULL, NULL),
(78, 38, 3, NULL, NULL),
(79, 39, 3, NULL, NULL),
(80, 40, 3, NULL, NULL),
(81, 41, 3, NULL, NULL),
(82, 44, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` bigint UNSIGNED NOT NULL,
  `question` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `question`, `question_image`, `score`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Questions 1', 'images/questions/VkD4umxMO2B59WZvNBCuZSSRZSiKlrMRAV2V9GkJ.jpg', 20, '2024-05-15 13:37:12', '2024-05-15 13:37:12', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `question_options`
--

CREATE TABLE `question_options` (
  `id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED DEFAULT NULL,
  `option_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `question_options`
--

INSERT INTO `question_options` (`id`, `question_id`, `option_text`, `correct`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'vrai', 1, '2024-05-15 13:37:12', '2024-05-15 13:37:12', NULL),
(2, 1, 'faux', 0, '2024-05-15 13:37:12', '2024-05-15 13:37:12', NULL),
(3, 1, 'faux', 0, '2024-05-15 13:37:12', '2024-05-15 13:37:12', NULL),
(4, 1, 'faux', 0, '2024-05-15 13:37:12', '2024-05-15 13:37:12', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `question_test`
--

CREATE TABLE `question_test` (
  `id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED DEFAULT NULL,
  `test_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `question_test`
--

INSERT INTO `question_test` (`id`, `question_id`, `test_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Administrator (can create other users)', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(2, 'Teacher', '2024-05-11 06:13:19', '2024-05-11 06:13:19'),
(3, 'Student', '2024-05-11 06:13:19', '2024-05-11 06:13:19');

-- --------------------------------------------------------

--
-- Structure de la table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(5, 4, 1, NULL, NULL),
(6, 5, 2, NULL, NULL),
(7, 6, 2, NULL, NULL),
(8, 7, 2, NULL, NULL),
(9, 8, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tests`
--

CREATE TABLE `tests` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED DEFAULT NULL,
  `lesson_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `published` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tests`
--

INSERT INTO `tests` (`id`, `course_id`, `lesson_id`, `title`, `description`, `published`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'test 1', 'description 1', 1, '2024-05-15 13:27:09', '2024-05-15 13:27:09', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `test_results`
--

CREATE TABLE `test_results` (
  `id` bigint UNSIGNED NOT NULL,
  `test_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `test_result` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `test_results`
--

INSERT INTO `test_results` (`id`, `test_id`, `user_id`, `test_result`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 20, '2024-05-20 12:12:21', '2024-05-20 12:12:21'),
(2, 1, 8, 0, '2024-05-20 17:06:41', '2024-05-20 17:06:41');

-- --------------------------------------------------------

--
-- Structure de la table `test_result_answers`
--

CREATE TABLE `test_result_answers` (
  `id` bigint UNSIGNED NOT NULL,
  `test_result_id` bigint UNSIGNED DEFAULT NULL,
  `question_id` bigint UNSIGNED DEFAULT NULL,
  `question_option_id` bigint UNSIGNED DEFAULT NULL,
  `correct` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `test_result_answers`
--

INSERT INTO `test_result_answers` (`id`, `test_result_id`, `question_id`, `question_option_id`, `correct`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '2024-05-20 12:12:21', '2024-05-20 12:12:21'),
(2, 2, 1, 2, 0, '2024-05-20 17:06:41', '2024-05-20 17:06:41');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zoom_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zoom_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `messenger_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `zoom_id`, `zoom_token`, `created_at`, `updated_at`, `active_status`, `avatar`, `dark_mode`, `messenger_color`) VALUES
(1, 'admin', 'admin@example.com', NULL, '$2y$10$vxt.5rILnEN3v4.z0Qm5ruPRCxRaRHWyrdEnSN3g8uBDgynU3vhke', '', NULL, NULL, '2024-05-11 06:13:19', '2024-05-11 06:13:19', 0, 'avatar.png', 0, NULL),
(4, 'Ibrahima Lo', 'ibrahimalo407@gmail.com', NULL, '$2y$10$WIrUuE7hWOMcNIPQ1S97JOjmF9Uqq2G2VunOcr4EgF8etk1kG5Fy.', 'tozEW6aFAwJ1Btjzbd0EGTZgBsyjliqRE8TsckKBv0UASFQrQDR1p1ICBveF', NULL, NULL, '2024-05-11 07:11:53', '2024-05-29 12:05:52', 0, '18c9edba-2ddb-45bd-9ef7-5c3ab7e9b0d3.jpg', 0, '#4CAF50'),
(5, 'Mr Harik', 'med.harik@gmail.com', NULL, '$2y$10$1SNBUnlHMf0lTNyTU69V2upoEeBE6qpPrDeO4CRE8XqJMOMrT1mlG', NULL, NULL, NULL, '2024-05-12 07:36:23', '2024-05-12 07:36:23', 0, 'avatar.png', 0, NULL),
(6, 'Mr Sylle', 'aliou@gmail.com', NULL, '$2y$10$LQ0JHJYNTdoiubKSiidf3uYaGoF7xKahy8.Pj2.CUobydTLlkVrP2', NULL, NULL, NULL, '2024-05-12 07:37:18', '2024-05-12 07:37:18', 0, 'avatar.png', 0, NULL),
(7, 'Mr Diouf', 'badara@gmail.com', NULL, '$2y$10$i31NqjcX9UCx/6QzDyzG5.lsfVenarWdHTCEKNnMS7t3LbQJR.5r6', NULL, NULL, NULL, '2024-05-12 07:39:45', '2024-05-12 07:39:45', 0, 'avatar.png', 0, NULL),
(8, 'Anna Camara', 'anzzah@gmail.com', NULL, '$2y$10$XG9gTVy5f0RNjdDp0n.u3OenlcVqtPsRyGMmMX5Epk7o2EBu7b2ZC', 'VsXWqWrv9f8StTlf8DQtKn3bGp9X5Qpke88ZUuBQ1KELnzJXAEKmzxUsQNtF', NULL, NULL, '2024-05-12 07:40:25', '2024-05-12 07:40:25', 0, 'avatar.png', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `virtual_classes`
--

CREATE TABLE `virtual_classes` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `meeting_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ch_favorites`
--
ALTER TABLE `ch_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ch_messages`
--
ALTER TABLE `ch_messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `course_student`
--
ALTER TABLE `course_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_student_course_id_foreign` (`course_id`),
  ADD KEY `course_student_user_id_foreign` (`user_id`);

--
-- Index pour la table `course_user`
--
ALTER TABLE `course_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_user_course_id_foreign` (`course_id`),
  ADD KEY `course_user_user_id_foreign` (`user_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lessons_course_id_foreign` (`course_id`);

--
-- Index pour la table `lesson_student`
--
ALTER TABLE `lesson_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_student_lesson_id_foreign` (`lesson_id`),
  ADD KEY `lesson_student_user_id_foreign` (`user_id`);

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
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_user_id_foreign` (`user_id`),
  ADD KEY `purchases_course_id_foreign` (`course_id`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_deleted_at_index` (`deleted_at`);

--
-- Index pour la table `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_options_question_id_foreign` (`question_id`),
  ADD KEY `question_options_deleted_at_index` (`deleted_at`);

--
-- Index pour la table `question_test`
--
ALTER TABLE `question_test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_test_question_id_foreign` (`question_id`),
  ADD KEY `question_test_test_id_foreign` (`test_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Index pour la table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tests_course_id_foreign` (`course_id`),
  ADD KEY `tests_lesson_id_foreign` (`lesson_id`),
  ADD KEY `tests_deleted_at_index` (`deleted_at`);

--
-- Index pour la table `test_results`
--
ALTER TABLE `test_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_results_test_id_foreign` (`test_id`),
  ADD KEY `test_results_user_id_foreign` (`user_id`);

--
-- Index pour la table `test_result_answers`
--
ALTER TABLE `test_result_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_result_answers_test_result_id_foreign` (`test_result_id`),
  ADD KEY `test_result_answers_question_id_foreign` (`question_id`),
  ADD KEY `test_result_answers_question_option_id_foreign` (`question_option_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `virtual_classes`
--
ALTER TABLE `virtual_classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `virtual_classes_course_id_foreign` (`course_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `course_student`
--
ALTER TABLE `course_student`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `course_user`
--
ALTER TABLE `course_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `lesson_student`
--
ALTER TABLE `lesson_student`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `question_test`
--
ALTER TABLE `question_test`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `test_results`
--
ALTER TABLE `test_results`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `test_result_answers`
--
ALTER TABLE `test_result_answers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `virtual_classes`
--
ALTER TABLE `virtual_classes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `course_student`
--
ALTER TABLE `course_student`
  ADD CONSTRAINT `course_student_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_student_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `course_user`
--
ALTER TABLE `course_user`
  ADD CONSTRAINT `course_user_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `lesson_student`
--
ALTER TABLE `lesson_student`
  ADD CONSTRAINT `lesson_student_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lesson_student_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `question_options`
--
ALTER TABLE `question_options`
  ADD CONSTRAINT `question_options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `question_test`
--
ALTER TABLE `question_test`
  ADD CONSTRAINT `question_test_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `question_test_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tests_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `test_results`
--
ALTER TABLE `test_results`
  ADD CONSTRAINT `test_results_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `test_results_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `test_result_answers`
--
ALTER TABLE `test_result_answers`
  ADD CONSTRAINT `test_result_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `test_result_answers_question_option_id_foreign` FOREIGN KEY (`question_option_id`) REFERENCES `question_options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `test_result_answers_test_result_id_foreign` FOREIGN KEY (`test_result_id`) REFERENCES `test_results` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `virtual_classes`
--
ALTER TABLE `virtual_classes`
  ADD CONSTRAINT `virtual_classes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
