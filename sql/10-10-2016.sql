-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.13 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных fb
DROP DATABASE IF EXISTS `fb`;
CREATE DATABASE IF NOT EXISTS `fb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `fb`;


-- Дамп структуры для таблица fb.bans
DROP TABLE IF EXISTS `bans`;
CREATE TABLE IF NOT EXISTS `bans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `blocked_until` timestamp NULL DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bans_user_id_index` (`user_id`),
  CONSTRAINT `bans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.bans: ~0 rows (приблизительно)
DELETE FROM `bans`;
/*!40000 ALTER TABLE `bans` DISABLE KEYS */;
/*!40000 ALTER TABLE `bans` ENABLE KEYS */;


-- Дамп структуры для таблица fb.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.categories: ~7 rows (приблизительно)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`, `slug`, `color`) VALUES
	(3, 'html & css', 'html & css', '2016-10-08 19:05:07', '2016-10-08 19:05:07', 'html-css', 'rgb(244, 67, 54)'),
	(4, 'javascript', 'javascript', '2016-10-08 19:05:33', '2016-10-08 19:05:33', 'javascript', '#f6b33c'),
	(5, 'php', 'php\r\n', '2016-10-08 19:05:58', '2016-10-08 19:05:58', 'php', '#669'),
	(6, 'database', 'db', '2016-10-08 19:06:11', '2016-10-08 19:06:11', 'database', 'rgb(76, 96, 246)'),
	(7, 'design & ux', 'design & ux', '2016-10-08 19:06:29', '2016-10-08 19:06:29', 'design-ux', 'rgb(170, 53, 214)'),
	(8, 'tools', 'tools', '2016-10-08 19:06:40', '2016-10-08 19:06:40', 'tools', '#32B47B'),
	(9, 'vcs', 'vcs', '2016-10-08 19:06:46', '2016-10-08 19:06:46', 'vcs', 'rgb(51, 163, 241)');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


-- Дамп структуры для таблица fb.comments
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_post_id_foreign` (`post_id`),
  CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.comments: ~1 rows (приблизительно)
DELETE FROM `comments`;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `user_id`, `post_id`, `text`, `created_at`, `updated_at`, `rating`) VALUES
	(1, 2, 28, 'KLASS!', '2016-10-01 11:25:00', '2016-10-03 18:53:32', 1);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;


-- Дамп структуры для таблица fb.comments_rates
DROP TABLE IF EXISTS `comments_rates`;
CREATE TABLE IF NOT EXISTS `comments_rates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `value` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_rates_comment_id_foreign` (`comment_id`),
  KEY `comments_rates_user_id_foreign` (`user_id`),
  CONSTRAINT `comments_rates_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_rates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.comments_rates: ~1 rows (приблизительно)
DELETE FROM `comments_rates`;
/*!40000 ALTER TABLE `comments_rates` DISABLE KEYS */;
INSERT INTO `comments_rates` (`id`, `comment_id`, `user_id`, `value`, `created_at`, `updated_at`) VALUES
	(1, 1, 5, 1, '2016-10-03 18:53:32', '2016-10-03 18:53:32');
/*!40000 ALTER TABLE `comments_rates` ENABLE KEYS */;


-- Дамп структуры для таблица fb.email_resets
DROP TABLE IF EXISTS `email_resets`;
CREATE TABLE IF NOT EXISTS `email_resets` (
  `user_id` int(10) unsigned NOT NULL,
  `new_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `email_resets_user_id_index` (`user_id`),
  KEY `email_resets_token_index` (`token`),
  CONSTRAINT `email_resets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.email_resets: ~0 rows (приблизительно)
DELETE FROM `email_resets`;
/*!40000 ALTER TABLE `email_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_resets` ENABLE KEYS */;


-- Дамп структуры для таблица fb.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.migrations: ~31 rows (приблизительно)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`migration`, `batch`) VALUES
	('2014_10_12_000000_create_users_table', 1),
	('2014_10_12_100000_create_password_resets_table', 1),
	('2016_08_22_191709_create_posts_table', 1),
	('2016_09_05_082735_add_roles_to_users_table', 2),
	('2016_09_05_092523_create_roles_table', 2),
	('2016_09_06_142053_change_role_id_column_type_in_users_table', 3),
	('2016_09_09_092512_create_user_activations_table', 4),
	('2016_09_09_093152_add_is_active_column_to_users_table', 4),
	('2016_09_12_130940_add_columns_to_users_table', 5),
	('2016_09_14_144841_change_columns_role_id_and_is_active_in_users_table', 5),
	('2016_09_16_134051_change_slug_column_in_posts_table', 5),
	('2016_09_17_075211_change_img_path_column_in_posts_table', 6),
	('2016_09_18_150959_create_categories_table', 7),
	('2016_09_18_153452_create_category_id_to_posts_table', 7),
	('2016_09_19_131245_create_tags_table', 8),
	('2016_09_19_133125_create_post_tag_table', 8),
	('2016_09_21_111212_add_slug_column_to_categories_table', 8),
	('2016_09_22_142623_create_comments_table', 8),
	('2016_09_28_090321_add_rating_column_to_posts_table', 9),
	('2016_09_28_090356_add_rating_column_to_comments_table', 9),
	('2016_09_29_114036_create_comments_rates_table', 9),
	('2016_09_30_102513_create_posts_rates_table', 9),
	('2016_10_01_192550_create_email_resets_table', 10),
	('2016_10_03_091553_add_avatar_column_to_users_table', 11),
	('2016_10_03_115359_create_tag_user_table', 11),
	('2016_10_03_154214_create_bans_table', 11),
	('2016_10_03_182858_add_ban_counter_to_users_table', 11),
	('2016_10_04_113341_add_ban_id_column_to_users_table', 12),
	('2016_10_07_120449_add_category_id_column_to_tags_table', 13),
	('2016_10_08_191336_add_color_column_to_categories_table', 14),
	('2016_10_10_095632_add_foreign_key_category_id_to_posts_table', 15);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Дамп структуры для таблица fb.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.password_resets: ~0 rows (приблизительно)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;


-- Дамп структуры для таблица fb.posts
DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `FK_posts_categories` (`category_id`),
  CONSTRAINT `FK_posts_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.posts: ~21 rows (приблизительно)
DELETE FROM `posts`;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `title`, `short`, `img`, `slug`, `text`, `created_at`, `updated_at`, `category_id`, `rating`) VALUES
	(1, 'Voluptatem velit et est.', 'Qui et sit fugiat quas perspiciatis quasi. Sunt iusto sint ut eaque. Voluptatum nobis sint reiciendis. Voluptatibus dolorem sint voluptatem aspernatur.', NULL, 'velit-deserunt-magni-quasi-minus', 'Recusandae in laudantium veniam. Reiciendis id eius est tempora reiciendis ea. Incidunt pariatur non voluptates modi ea sunt fugit.', '2016-09-01 19:00:47', '2016-09-01 19:00:47', NULL, 0),
	(2, 'Neque quis a assumenda et.', 'Non recusandae temporibus eos provident sunt voluptatem iusto. Reprehenderit et nulla impedit quia cum et. Eligendi culpa nam ut quo eveniet reiciendis similique.', NULL, 'et-aut-ab-nostrum-culpa', 'Rerum placeat rerum asperiores debitis. Voluptas est earum eum est. Et est ad rem blanditiis dolor maxime et recusandae. Deleniti veritatis provident beatae fugiat omnis quidem fugiat.', '2016-09-01 19:00:47', '2016-09-01 19:00:47', NULL, 0),
	(3, 'Suscipit facere non in tempore ut.', 'Error consequuntur corporis dignissimos maxime omnis repellendus reiciendis quia. Est labore qui omnis sequi quam quia. Dolores et officiis recusandae enim et.', NULL, 'repellendus-adipisci-ducimus-consequatur-id-officiis', 'Quis earum et velit dolore vel aut. Laboriosam delectus aliquid aperiam nihil dolore reprehenderit. Provident et autem culpa autem vitae. Sit ab nemo omnis nulla sed.', '2016-09-01 19:00:47', '2016-09-01 19:00:47', NULL, 0),
	(4, 'Est eum dolorem dolorem praesentium nihil ad odio.', 'Voluptate sint delectus et ab laboriosam. Assumenda sunt voluptas velit consequuntur ut doloribus cumque. Qui sunt veniam quia repudiandae ea ut minima.', NULL, 'provident-et-unde-repellat-temporibus', 'Iure adipisci ex ut voluptates. Deleniti dolorem voluptatum aliquam facilis dolorum et. Voluptas reprehenderit sed corrupti consequatur. Blanditiis incidunt inventore et non nihil doloremque.', '2016-09-01 19:00:47', '2016-09-01 19:00:47', NULL, 0),
	(5, 'Aliquam perspiciatis facilis in aut minus tempore impedit.', 'Error est omnis earum eligendi delectus nesciunt. Ipsam atque a nostrum doloribus excepturi. Repellendus et esse et maxime.', NULL, 'quia-itaque-et-tenetur', 'Quo voluptatem sequi in architecto est vitae. Porro et earum quia debitis hic repellendus accusamus. Soluta aut incidunt repudiandae totam.', '2016-09-01 19:00:47', '2016-09-01 19:00:47', NULL, 0),
	(6, 'Velit expedita nesciunt ab deserunt esse deserunt hic.', 'Dolor commodi eligendi aliquid delectus incidunt qui mollitia. Reprehenderit quasi magni soluta sed unde. Sunt qui maiores repellat hic et dolore consequuntur. Aut impedit excepturi a rerum error modi amet.', NULL, 'dolores-fugit-maxime-ad-voluptatem', 'Omnis sapiente sequi est beatae molestiae ut et. Hic non incidunt quas sapiente nostrum. Et deserunt sapiente ut velit ullam sed.', '2016-09-01 19:00:47', '2016-09-01 19:00:47', NULL, 0),
	(7, 'Ab aut officia molestias maiores nobis voluptate soluta.', 'Qui sit beatae expedita ipsa aut. Nam atque provident omnis pariatur. Est ea doloribus deleniti atque ab earum. Totam excepturi illum enim sit cum consequatur velit quod.', NULL, 'omnis-error-vitae-expedita-incidunt-et-ut-in-sit', 'Nemo quas porro ut natus occaecati perferendis. Nihil facilis dolores tenetur sunt non. Assumenda minima voluptas totam vitae ipsum est.', '2016-09-01 19:00:47', '2016-09-01 19:00:47', NULL, 0),
	(8, 'Maxime eius sed dolorem sed.', 'Hic quae eum qui exercitationem natus est. Molestias molestiae fuga vero ea aut ut. Est necessitatibus fugit id exercitationem.', NULL, 'quisquam-sequi-quasi-provident-laborum', 'Fuga explicabo reiciendis non facilis natus repudiandae doloremque. Hic eos suscipit dicta magni voluptas. Nam quisquam quis architecto suscipit. A distinctio cumque et ipsum voluptas.', '2016-09-01 19:00:47', '2016-09-01 19:00:47', 3, 0),
	(9, 'Dolor ea velit est praesentium voluptates rerum.', 'Suscipit provident rerum non qui sit nihil nihil. In voluptatibus fugit reprehenderit alias laborum natus eveniet.', NULL, 'voluptatum-ut-odio-iure-quam', 'Perferendis provident laudantium quos ut. Id totam amet tenetur quia facilis. Alias architecto quo sunt quis. Dicta asperiores dolor rem esse iste quo consequatur voluptas.', '2016-09-01 19:00:47', '2016-09-01 19:00:47', 5, 0),
	(10, 'Quis dolores sed illo.', 'Doloribus velit quia quod. Nihil et iste consequuntur dolores. Voluptatum porro eos est labore quam harum mollitia. Eveniet porro laboriosam animi.', NULL, 'inventore-sed-possimus-minima-eligendi', 'Quam eveniet et ad earum iusto. Animi ipsam autem assumenda qui. Ex sint odio nihil non pariatur repellendus quia.', '2016-09-01 19:00:47', '2016-09-01 19:00:47', 5, 5),
	(11, 'Aliquid voluptatum numquam commodi.', 'Occaecati doloribus sunt et dolor aut aperiam totam. Dolorum delectus amet explicabo odio et. Ipsum quam iusto est quia. Optio sint facilis odio fuga suscipit et consectetur.', NULL, 'quisquam-nihil-rerum-fugiat-at-quidem', 'Aut deleniti aut dolor et. Autem aut maiores eum. Totam magnam aperiam ullam vel. Vitae excepturi omnis repudiandae eligendi animi molestias.', '2016-09-01 19:00:47', '2016-09-01 19:00:47', 5, 0),
	(12, 'Natus veniam eaque sit aut officia.', 'Qui consequatur odit facilis iure rerum ea odit. Voluptatum velit fugit tempore quisquam amet. Ut distinctio quia quis voluptatem repellendus beatae. Culpa et nemo blanditiis aliquam tenetur.', NULL, 'consequatur-perspiciatis-harum-et-quia-et-quia-autem', 'Reprehenderit expedita tenetur adipisci ut atque. Itaque ipsam incidunt sunt quaerat illo quibusdam commodi. Aut at corporis voluptatem vel pariatur aut sequi.', '2016-09-01 19:00:47', '2016-09-01 19:00:47', 7, 0),
	(13, 'Et voluptates perspiciatis delectus deserunt.', 'Tempore laboriosam facere omnis molestias ipsam. Odit non et voluptatem occaecati quasi. Repellat ipsam ratione nostrum quia sit molestias iste rerum. Soluta amet et odit enim distinctio.', NULL, 'facilis-quo-sit-officiis-aut-et-numquam', 'Tempore esse numquam autem. Nostrum vel ea consequatur. Quibusdam doloremque voluptatibus quia nisi est inventore. Id assumenda neque corrupti quia.', '2016-09-01 19:00:47', '2016-09-01 19:00:47', 9, 5),
	(14, 'Voluptates rerum exercitationem qui ducimus cumque.', 'Dicta est sunt reprehenderit dignissimos qui enim est. Rerum rerum blanditiis consequatur quia. Dignissimos aperiam assumenda unde quaerat praesentium est.', NULL, 'sed-error-consequatur-exercitationem-dolorum-qui-dicta-iure', 'Sint consectetur et dignissimos. Voluptate laudantium quia est quos officia voluptatibus distinctio.', '2016-09-01 19:00:47', '2016-09-01 19:00:47', 8, 5),
	(15, 'Et est quam at dicta nulla similique quam.', 'Quo repellendus sunt et sint tenetur. Optio voluptatem in eum ex similique laudantium. Consectetur adipisci et neque expedita.', NULL, 'sunt-magni-ut-adipisci-illum-quod', 'Qui et velit quod sit incidunt voluptatem est praesentium. Quisquam et harum officia libero in. Rem id neque error minima. Iusto omnis veritatis repudiandae consectetur.', '2016-09-01 19:00:47', '2016-09-01 19:00:47', 3, 0),
	(16, 'Webpack для Single Page App', 'Error ut ex quo hic incidunt corrupti repellat. Molestias suscipit ex neque sed. Et eligendi sed et est corporis non. Id incidunt aliquid soluta odio provident qui. Consequuntur facilis quis voluptatem.', '78f382d56da957cce47a8af7d534a199.png', 'webpack-dlya-single-page-app', '<p>Occaecati sunt voluptatem odio ducimus. Sed rerum minus dolor debitis. Aliquid dolorum repellat voluptas fugiat iste quo sed nostrum.</p>', '2016-09-01 19:00:47', '2016-10-10 19:11:03', 8, 5),
	(17, '10 потенциальных SQL ошибок, которые делают программисты', 'Deleniti et repudiandae molestias id animi et corporis ratione. Officia esse quasi sed cupiditate et facere est. Dolorem explicabo rerum eveniet autem.', 'f17913c6c4ac4541d589c0ff96672fc0.jpg', '10-potentsialinih-sql-oshibok-kotorie-delayut-programmisti', '<p>Sit error enim necessitatibus qui et. Hic maxime alias expedita ab dolor libero eum. Qui numquam et magnam. Odit est et excepturi totam.</p>', '2016-09-01 19:00:47', '2016-10-10 19:09:43', 6, 5),
	(26, 'Не используйте Illuminate Support ', 'REALLY???', '2f8e49c13aa0889c22f75c3e1922be52.jpg', 'ne-ispolizuite-illuminate-support', '<p>REALLY???</p>', '2016-09-17 12:31:56', '2016-10-10 19:04:01', 5, 0),
	(27, 'Телепатия на стероидах в js/node.js', 'awdawdawd', '6e256694d48c28ff2fac1bef4ea31673.jpg', 'telepatiya-na-steroidah-v-js-node-js', '<p>awdawdawd</p>', '2016-09-17 12:58:18', '2016-10-10 18:56:59', 4, 5),
	(28, 'Редизайн Хрома на десктопе', 'wdawdawdawdawdawdawd', '7739ed4cb14831b4928370fd6ef4639e.jpg', 'redizain-hroma-na-desktope', '<h1>AWDAWDAWDAWDAWDAWDAWD</h1>\r\n<p>AWDAWDAWD<strong>AWD</strong></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', '2016-09-25 22:36:18', '2016-10-10 18:48:54', 7, 5),
	(29, 'Пилим веб-демку — Wavescroll ', 'Как Yahoo перешла от Flash к HTML5 в видео', '08f09d6419df9cb6c89311a1d4afaf41.jpg', 'pilim-veb-demku-wavescroll', '<p>Как Yahoo перешла от Flash к HTML5 в видео</p>', '2016-10-10 18:50:28', '2016-10-10 19:02:36', 3, 0);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;


-- Дамп структуры для таблица fb.posts_rates
DROP TABLE IF EXISTS `posts_rates`;
CREATE TABLE IF NOT EXISTS `posts_rates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `value` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_rates_post_id_foreign` (`post_id`),
  KEY `posts_rates_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_rates_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `posts_rates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.posts_rates: ~3 rows (приблизительно)
DELETE FROM `posts_rates`;
/*!40000 ALTER TABLE `posts_rates` DISABLE KEYS */;
INSERT INTO `posts_rates` (`id`, `post_id`, `user_id`, `value`, `created_at`, `updated_at`) VALUES
	(1, 28, 2, 1, '2016-10-01 11:24:52', '2016-10-01 11:24:52'),
	(2, 27, 2, 1, '2016-10-03 18:30:43', '2016-10-03 18:30:43'),
	(3, 28, 5, 1, '2016-10-03 18:53:35', '2016-10-03 18:53:35');
/*!40000 ALTER TABLE `posts_rates` ENABLE KEYS */;


-- Дамп структуры для таблица fb.post_tag
DROP TABLE IF EXISTS `post_tag`;
CREATE TABLE IF NOT EXISTS `post_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_tag_post_id_foreign` (`post_id`),
  KEY `post_tag_tag_id_foreign` (`tag_id`),
  CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.post_tag: ~6 rows (приблизительно)
DELETE FROM `post_tag`;
/*!40000 ALTER TABLE `post_tag` DISABLE KEYS */;
INSERT INTO `post_tag` (`id`, `post_id`, `tag_id`) VALUES
	(1, 28, 1),
	(2, 27, 2),
	(3, 27, 3),
	(4, 28, 3),
	(5, 29, 3),
	(6, 29, 4);
/*!40000 ALTER TABLE `post_tag` ENABLE KEYS */;


-- Дамп структуры для таблица fb.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.roles: ~3 rows (приблизительно)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', NULL, NULL),
	(2, 'moderator', NULL, NULL),
	(3, 'member', NULL, NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Дамп структуры для таблица fb.tags
DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_slug_unique` (`slug`),
  KEY `tags_category_id_foreign` (`category_id`),
  CONSTRAINT `tags_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.tags: ~5 rows (приблизительно)
DELETE FROM `tags`;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` (`id`, `name`, `description`, `created_at`, `updated_at`, `slug`, `category_id`) VALUES
	(1, 'php', 'PHP posts', NULL, NULL, NULL, NULL),
	(2, 'js', 'JS posts', NULL, NULL, NULL, NULL),
	(3, 'css', 'css posts', NULL, NULL, NULL, NULL),
	(4, 'html', 'html posts', NULL, NULL, NULL, NULL),
	(5, 'nodejs', 'NodeJS posts', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;


-- Дамп структуры для таблица fb.tag_user
DROP TABLE IF EXISTS `tag_user`;
CREATE TABLE IF NOT EXISTS `tag_user` (
  `user_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  KEY `tag_user_user_id_index` (`user_id`),
  KEY `tag_user_tag_id_index` (`tag_id`),
  CONSTRAINT `tag_user_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tag_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.tag_user: ~2 rows (приблизительно)
DELETE FROM `tag_user`;
/*!40000 ALTER TABLE `tag_user` DISABLE KEYS */;
INSERT INTO `tag_user` (`user_id`, `tag_id`) VALUES
	(2, 3),
	(2, 4);
/*!40000 ALTER TABLE `tag_user` ENABLE KEYS */;


-- Дамп структуры для таблица fb.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(10) unsigned NOT NULL DEFAULT '3',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `age` tinyint(3) unsigned DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ban_counter` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ban_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_login_unique` (`login`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_ban_id_foreign` (`ban_id`),
  CONSTRAINT `users_ban_id_foreign` FOREIGN KEY (`ban_id`) REFERENCES `bans` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.users: ~4 rows (приблизительно)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `login`, `name`, `last_name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`, `is_active`, `age`, `city`, `avatar`, `ban_counter`, `ban_id`) VALUES
	(2, 'admin', 'Admin', 'Admin', 'admin@mail.ro', '$2y$10$jVx9buRn2e2vCo0lwgtIDuxzJhW2eMZLbMbD81THsEYmX4E17sGwG', 'CoxwsMR3HAiglbPJR9dkPpeL4ydS7Zxp87Ia3TgOp8jV8xoEgMrWsdx4VV3e', NULL, '2016-10-09 21:04:10', 1, 1, 21, 'фыв', NULL, 0, NULL),
	(3, 'wadawdawdawd', 'ADAWD', 'AWDAWD', 'awdawdawda@AWD.AWDA', '$2y$10$dl.oP.X5DeWEypxGDsyt2uLCyGylusRHSo4tmtUtO2zVEP.kdooN2', 'Sf4NL2NLcwZ9TGBgLG97Dq9Cf3oR8LNgcSr6lqJJ3nM7d6Em7lwfHFsHPnXO', '2016-09-25 21:52:15', '2016-09-25 22:00:18', 3, 0, NULL, NULL, NULL, 0, NULL),
	(4, 'admin3', 'awdawdawd', 'awdawd', 'awdad@awdawd.awd', '$2y$10$30lAA7/6e.oL25KeGOiy4.EVJ6DhWWEXIp0aSLzBrAk7hJoy8ZtCu', NULL, '2016-09-25 22:09:50', '2016-09-25 22:09:50', 1, 1, NULL, NULL, NULL, 0, NULL),
	(5, 'guba', 'qwqwdqwd', 'qwdawdawd', 'awdawd@awd.awd', '$2y$10$M9H8O0HJfLafNDrjxg033uZJ//L566sPZmqFhPar4nlFHJ3GwK6m6', 'SgBtRiXDqKwFfXfEHPnLEKmmpIOmgiZYGWZ5G9w9VT0ZEMyYRyo3UbZcqwhw', '2016-10-01 15:24:37', '2016-10-04 19:52:18', 3, 1, NULL, NULL, NULL, 0, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Дамп структуры для таблица fb.user_activations
DROP TABLE IF EXISTS `user_activations`;
CREATE TABLE IF NOT EXISTS `user_activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_activations_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.user_activations: ~0 rows (приблизительно)
DELETE FROM `user_activations`;
/*!40000 ALTER TABLE `user_activations` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_activations` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
