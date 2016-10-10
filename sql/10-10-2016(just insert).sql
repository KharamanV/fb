-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.31 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица fb.bans
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
/*!40000 ALTER TABLE `bans` DISABLE KEYS */;
/*!40000 ALTER TABLE `bans` ENABLE KEYS */;


-- Дамп структуры для таблица fb.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.categories: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`, `slug`, `color`) VALUES
	(4, 'php', 'php posts', '2016-10-07 11:48:08', '2016-10-07 11:48:08', 'php', '#646497'),
	(5, 'javascript', 'js posts', '2016-10-07 11:48:22', '2016-10-07 11:48:22', 'javascript', '#F6B33C'),
	(6, 'html & css', 'html & css posts', '2016-10-07 11:49:43', '2016-10-07 11:49:43', 'html-css', '#F44336'),
	(7, 'database', 'db posts', '2016-10-07 11:59:12', '2016-10-07 13:21:08', 'database', '#4B5FF2'),
	(8, 'vcs', 'version control system', '2016-10-07 13:48:58', '2016-10-07 13:48:58', 'vcs', '#33A2EF'),
	(9, 'design & ux', 'design and ux posts', '2016-10-07 13:50:22', '2016-10-07 13:50:22', 'design-ux', '#A333CD'),
	(10, 'tools', 'editors, task-managers and more', '2016-10-07 14:00:56', '2016-10-07 14:00:56', 'tools', '#31B179');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


-- Дамп структуры для таблица fb.comments
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.comments: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `user_id`, `post_id`, `text`, `created_at`, `updated_at`, `rating`) VALUES
	(1, 8, 24, 'КРАСИВО!', '2016-09-27 14:59:35', '2016-09-29 13:33:18', 1),
	(2, 8, 24, 'Вообще огонь! ГЕРАЛЬТ ЛАФФКЕ', '2016-09-27 15:17:25', '2016-09-29 13:42:07', -1),
	(4, 8, 22, 'ЭЭэ бля!', '2016-09-28 08:44:41', '2016-09-28 08:44:48', 0),
	(6, 4, 25, 'Где картинка?! Чтобы больше такого не было! Ясно?!', '2016-09-29 11:36:56', '2016-10-03 15:02:09', 1),
	(8, 8, 23, 'Петух!', '2016-10-03 14:37:51', '2016-10-03 14:37:51', 0);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;


-- Дамп структуры для таблица fb.comments_rates
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.comments_rates: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `comments_rates` DISABLE KEYS */;
INSERT INTO `comments_rates` (`id`, `comment_id`, `user_id`, `value`, `created_at`, `updated_at`) VALUES
	(1, 1, 4, 1, '2016-09-29 13:33:18', '2016-09-29 13:33:18'),
	(2, 2, 4, -1, '2016-09-29 13:42:06', '2016-09-29 13:42:06'),
	(5, 6, 8, 1, '2016-10-03 15:02:09', '2016-10-03 15:02:09');
/*!40000 ALTER TABLE `comments_rates` ENABLE KEYS */;


-- Дамп структуры для таблица fb.email_resets
CREATE TABLE IF NOT EXISTS `email_resets` (
  `user_id` int(10) unsigned NOT NULL,
  `new_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `email_resets_user_id_index` (`user_id`),
  KEY `email_resets_token_index` (`token`),
  CONSTRAINT `email_resets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.email_resets: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `email_resets` DISABLE KEYS */;
INSERT INTO `email_resets` (`user_id`, `new_email`, `token`, `created_at`) VALUES
	(8, 'admin@gmail.com', '85cfbcd208fedef86c380e80a3de65e1882dddeb4adf1142444a5e57698e0e76', '2016-10-03 08:38:29');
/*!40000 ALTER TABLE `email_resets` ENABLE KEYS */;


-- Дамп структуры для таблица fb.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.migrations: ~31 rows (приблизительно)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`migration`, `batch`) VALUES
	('2014_10_12_000000_create_users_table', 1),
	('2014_10_12_100000_create_password_resets_table', 2),
	('2016_08_22_191709_create_posts_table', 2),
	('2016_09_05_082735_add_roles_to_users_table', 3),
	('2016_09_05_092523_create_roles_table', 3),
	('2016_09_06_142053_change_role_id_column_type_in_users_table', 4),
	('2016_09_09_092512_create_user_activations_table', 5),
	('2016_09_09_093152_add_is_active_column_to_users_table', 5),
	('2016_09_12_130940_add_columns_to_users_table', 6),
	('2016_09_14_144841_change_columns_role_id_and_is_active_in_users_table', 7),
	('2016_09_16_134051_change_slug_column_in_posts_table', 8),
	('2016_09_17_075211_change_img_path_column_in_posts_table', 9),
	('2016_09_18_150959_create_categories_table', 9),
	('2016_09_18_153452_create_category_id_to_posts_table', 9),
	('2016_09_19_131245_create_tags_table', 10),
	('2016_09_19_133125_create_post_tag_table', 11),
	('2016_09_21_111212_add_slug_column_to_categories_table', 12),
	('2016_09_22_142623_create_comments_table', 13),
	('2016_09_28_090321_add_rating_column_to_posts_table', 14),
	('2016_09_28_090356_add_rating_column_to_comments_table', 14),
	('2016_09_29_114036_create_comments_rates_table', 15),
	('2016_09_30_102513_create_posts_rates_table', 16),
	('2016_10_01_192550_create_email_resets_table', 17),
	('2016_10_03_091553_add_avatar_column_to_users_table', 18),
	('2016_10_03_115359_create_tag_user_table', 19),
	('2016_10_03_154214_create_bans_table', 20),
	('2016_10_03_182858_add_ban_counter_to_users_table', 20),
	('2016_10_04_113341_add_ban_id_column_to_users_table', 21),
	('2016_10_07_120449_add_category_id_column_to_tags_table', 22),
	('2016_10_08_191336_add_color_column_to_categories_table', 23),
	('2016_10_10_095632_add_foreign_key_category_id_to_posts_table', 24);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Дамп структуры для таблица fb.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.password_resets: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('kharaman.v@gmail.com', '666ab50eb9e8eb51e610d05514ef47b427cdd8d7fa665fd768bc93961476c119', '2016-09-09 09:06:11');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;


-- Дамп структуры для таблица fb.posts
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
  KEY `posts_category_id_foreign` (`category_id`),
  CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.posts: ~25 rows (приблизительно)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `title`, `short`, `img`, `slug`, `text`, `created_at`, `updated_at`, `category_id`, `rating`) VALUES
	(1, 'Assumenda exercitationem nemo nesciunt eos est praesentium fuga.', 'Similique consequatur error et ut voluptatem voluptas. Aliquam dolor totam dolorum vitae laboriosam et nihil. Expedita asperiores quidem qui.', NULL, 'sint-dolores-accusantium-mollitia-dolor-esse-molestias', 'Et nulla consequatur quia. Et assumenda non soluta dolores accusamus officiis. Vitae sed quisquam cumque. Hic voluptatem debitis placeat eos laborum qui.', '2016-09-02 10:09:31', '2016-09-02 10:09:31', 5, 0),
	(2, 'Repellat totam modi rem.', 'Quia id illo a dolores incidunt. Et voluptatum accusantium commodi voluptatem.', NULL, 'quibusdam-perferendis-in-dolorem-expedita-illo-molestiae', 'Atque culpa tempora ut. Corporis laborum qui natus nihil. Vel porro maxime doloremque laudantium sint.', '2016-09-02 10:09:31', '2016-09-02 10:09:31', 4, 0),
	(3, 'Vitae temporibus consequuntur rerum et nihil autem minus.', 'Quis ut exercitationem veritatis. Eligendi minima et iusto maiores. Sit consequatur est maxime rem eaque nesciunt. Voluptatem optio et quasi ex qui praesentium molestiae.', NULL, 'qui-voluptatem-qui-voluptatum', 'Laboriosam quia sapiente asperiores voluptatem atque officiis et iure. Odit ut iure voluptatum non et minima suscipit. Vitae et quis sed assumenda hic beatae. Laboriosam officiis ab et perspiciatis.', '2016-09-02 10:09:31', '2016-09-02 10:09:31', 4, 0),
	(4, 'Impedit id nihil non sed similique.', 'Ut sit exercitationem sed quod excepturi nostrum ut. Dolorum dignissimos debitis eaque aliquam voluptas odit. Et eligendi et laudantium sed.', NULL, 'quo-et-ex-repudiandae-occaecati-magnam-esse-facere-et', 'Unde ut tempora quam dicta rerum vel qui. Aperiam quia sapiente omnis sequi ab quia. Reiciendis officia ratione fugit nisi officia.', '2016-09-02 10:09:31', '2016-09-02 10:09:31', 5, 0),
	(5, 'Quis iste provident qui ea.', 'Ipsa eos deleniti laboriosam ut. Aperiam cumque a error. Consequuntur tenetur quibusdam architecto consectetur.', NULL, 'quia-autem-fuga-quis-voluptate-commodi', 'Earum cum quaerat temporibus sunt pariatur ut. Tenetur illo voluptatem animi aut dolorem qui. Consequatur esse natus molestiae et magnam.', '2016-09-02 10:09:31', '2016-09-02 10:09:31', 6, 0),
	(6, 'Saepe necessitatibus sit quo tempore.', 'Officia perferendis aut corporis quis quisquam sit. Commodi ad quaerat ut corrupti necessitatibus recusandae. Commodi earum provident sint.', NULL, 'et-et-est-ex-illo-alias-perspiciatis-hic', 'Unde beatae odio rerum rem. In aliquid facere nam a magnam nihil. Tempora nihil qui ipsum rerum vero dolorum et.', '2016-09-02 10:09:31', '2016-09-02 10:09:31', 4, 0),
	(7, 'Sed sed aliquam maxime harum et.', 'Fugiat tenetur cumque cupiditate est. Sit dignissimos impedit totam non. Itaque enim reprehenderit aspernatur eos.', NULL, 'aut-recusandae-eos-eos-in-optio', 'Deserunt commodi assumenda omnis eaque rerum dolores. Quia totam dolor accusamus. Ducimus qui soluta porro voluptas eligendi est.', '2016-09-02 10:09:31', '2016-09-02 10:09:31', 4, 0),
	(8, 'Consectetur vel libero omnis fugiat dolor recusandae at.', 'Qui eveniet reprehenderit harum assumenda velit temporibus a. Modi optio quam inventore iusto aut. Inventore est omnis id id aliquid deserunt eum.', NULL, 'voluptas-unde-veritatis-et', 'Modi assumenda sit eum tempore modi id dolores. Qui sit officiis et officiis eaque. Ut eum sapiente autem qui. Nisi hic non exercitationem ut cumque eligendi enim.', '2016-09-02 10:09:31', '2016-09-02 10:09:31', 8, 0),
	(9, 'Voluptatem rem earum sunt earum qui cumque.', 'Ut esse omnis et laborum optio provident. Corporis eius voluptatum odio nemo omnis voluptas. Voluptatem expedita quam voluptatem vitae dolores nulla.', NULL, 'adipisci-ipsa-ut-voluptatibus-ratione-voluptate-sed-dolores', 'Qui quos est ratione velit assumenda eos aut. Nostrum maiores eum ipsam consequuntur ut. Veritatis dignissimos est hic officiis impedit.', '2016-09-02 10:09:31', '2016-09-02 10:09:31', 7, 0),
	(10, 'Voluptas et possimus et perspiciatis.', 'Illum doloribus consequuntur exercitationem soluta quod iure. Ex qui inventore voluptas in ad harum quibusdam. Cum quo tenetur nesciunt earum incidunt.', NULL, 'officiis-nihil-minima-sit-non-beatae-ex-totam-ut', 'Necessitatibus deserunt dicta quia. Atque id aut consequuntur rerum sunt nobis. Ut omnis aut ea tempore rerum amet. Fugit est ea voluptatem non alias et. Laborum vero tempora facere accusamus.', '2016-09-02 10:09:31', '2016-09-02 10:09:31', 9, 0),
	(11, 'In dignissimos voluptatem beatae quia maxime dolores vel.', 'Aut excepturi ea sit exercitationem autem. Voluptatem architecto non non facere. Placeat animi et saepe ratione est distinctio aspernatur. Rerum aspernatur sed rem sunt impedit reprehenderit.', NULL, 'dolorum-nulla-ab-et-error-eaque-cum', '<p>Harum eos suscipit in ut. Beatae et optio quia incidunt saepe nam nihil. Aliquam ipsum repellat vel voluptas tempora ab pariatur.</p>', '2016-09-02 10:09:31', '2016-10-03 14:14:48', 6, 0),
	(12, 'Repellendus quod placeat consequatur qui earum.', 'Delectus aut velit culpa id. Vel ipsam fugiat quam aut quo qui. Et quam id eum et. Provident ut cum exercitationem exercitationem minima.', NULL, 'praesentium-consequatur-quia-sed-eaque-assumenda-qui-qui-eum', 'Consequatur nostrum consequatur aspernatur qui qui dolorem fugiat. At corporis beatae minus suscipit velit. Necessitatibus eius voluptatem dignissimos et quae dolore quia.', '2016-09-02 10:09:31', '2016-09-02 10:09:31', 4, 0),
	(13, 'Harum aspernatur sequi dignissimos quia.', 'Sequi natus possimus ut labore sunt sit. Voluptatem architecto laborum dignissimos quo est labore.', NULL, 'est-optio-necessitatibus-ducimus-temporibus-velit', 'Maxime libero accusantium omnis est repellat est. Dolorem voluptatem eveniet nam illo ducimus. Consectetur minima reprehenderit numquam voluptatum.', '2016-09-02 10:09:31', '2016-09-02 10:09:31', 10, 0),
	(14, 'Commodi reiciendis veritatis neque architecto.', 'Repudiandae in veritatis sit fuga. Qui vero molestiae consequatur quibusdam aut veniam. Consequuntur autem magni officia culpa inventore. Ab adipisci doloremque corporis quidem expedita.', NULL, 'sint-numquam-hic-odit-modi-ut', 'Voluptates itaque aut et exercitationem nihil. Nulla similique numquam nihil. Est ipsa omnis et voluptates dolore. Dolor est laboriosam voluptas aut aut.', '2016-09-02 10:09:31', '2016-09-02 10:09:31', 8, 0),
	(15, 'Et quam praesentium beatae nihil qui non itaque.', 'Et totam consequatur unde ipsum eaque dolor voluptate. Nihil rerum consectetur hic. Corrupti velit consequatur qui est tenetur molestiae. Consequatur modi voluptates iste voluptatum inventore minus. Facere at tenetur dignissimos sint.', NULL, 'dolorem-modi-enim-eaque-odit-amet-minima-maxime-ut', 'Cumque ex aut qui incidunt consequatur. Illum vel occaecati omnis laudantium error. Temporibus delectus at nesciunt culpa rerum sequi pariatur.', '2016-09-02 10:09:31', '2016-09-02 10:09:31', NULL, 0),
	(16, 'Magnam quam repudiandae possimus at quis consequatur voluptatem.', 'Deleniti eos modi et aliquam. Quos officia vel pariatur illo. Repudiandae alias et soluta ipsa nobis laborum est.', NULL, 'enim-omnis-similique-amet-dolorem-nisi-at-nam-voluptatum', 'Perspiciatis quidem itaque ex iste. Vero quam non aut nobis. Maiores voluptas sed nam eius nulla.', '2016-09-02 10:09:31', '2016-09-02 10:09:31', NULL, 0),
	(17, 'Quod eos quo non dolorum officiis rem.', 'Amet rerum quas quae. Dolor sequi inventore quia quos error. Rerum qui illo alias tenetur est nihil.', NULL, 'possimus-dolorem-dolores-dolorem-ut-blanditiis-eum-quia', 'Et sed consequatur beatae molestiae. Dolorem dolores deserunt cupiditate consequatur amet aut. Iusto ut ducimus aut rerum necessitatibus enim. Sed blanditiis voluptas rerum qui qui est nesciunt.', '2016-09-02 10:09:31', '2016-09-02 10:09:31', NULL, 0),
	(18, 'Minima voluptatem sunt voluptatum velit labore.', 'Cum rerum voluptate quam amet. Sunt adipisci animi impedit et. Error voluptatem vero qui omnis. Quod magni iste et ipsam natus rerum repellat sed.', NULL, 'est-exercitationem-voluptatibus-libero-voluptatibus-ipsum-a', 'Provident voluptatem voluptas ipsa delectus deleniti. Nesciunt rerum eum dolore aut quisquam ut. Odio iste recusandae sed blanditiis eos. Ipsam est cum enim maiores autem.', '2016-09-02 10:09:31', '2016-09-02 10:09:31', NULL, 0),
	(19, 'Debitis commodi rerum modi quis quisquam voluptatem harum.', 'Non consequatur rerum ipsam quia consequuntur laudantium ab. Laboriosam sint delectus commodi dolores perspiciatis rerum. Numquam architecto dolores odit debitis dolore.', NULL, 'voluptatem-sunt-libero-neque-eius', 'Molestias iusto veritatis omnis asperiores. Autem recusandae veniam ab error ipsam ab debitis. Blanditiis voluptas ut illo quo ad.', '2016-09-02 10:09:31', '2016-09-02 10:09:31', NULL, 0),
	(20, 'Id dolores perspiciatis ut deleniti doloremque voluptas nihil.', 'Optio sit eveniet itaque voluptates itaque dicta sapiente. Est dolor et veniam magnam occaecati sint aut.', NULL, 'est-molestiae-voluptatem-velit-vero', '<p>Aliquam accusantium reiciendis sapiente fugit qui illum voluptas quia. Nostrum molestiae sed error numquam. Voluptas provident sapiente unde accusantium at. Saepe nobis deserunt est et doloremque.</p>', '2016-09-02 10:09:31', '2016-09-21 11:00:26', NULL, 0),
	(21, 'CMONNNN', 'asdasd', NULL, 'cmon-cmon', '<p>asdasdasd</p>', '2016-09-16 13:56:36', '2016-10-03 14:14:27', NULL, 0),
	(22, 'Статья с категорией', 'ХАХАХА. Норм же?', '187d4021e3799377fc1011030047f92a.jpg', 'statiya-s-kategoriei', '<p style="text-align: center;"><strong><em>Вышел мышел шишел мишел</em></strong></p>\r\n<p style="text-align: right;"><strong>Джейсон<em> Стетхем</em></strong></p>', '2016-09-19 12:00:27', '2016-09-19 12:38:21', NULL, 0),
	(23, 'YEEEAAAAAA', 'yeaaaaaa тег', '9a5650bf8eebdfd374afb4dac38c0784.jpg', 'yeeeaaaaaa', '<p>CMONNNNNN!!</p>', '2016-09-20 11:42:03', '2016-10-03 14:37:42', NULL, 1),
	(24, 'Питух!', 'asdasd', 'a4be8591477880f43648f1ea605e60af.jpg', 'pituh', '<p>ыавыавыаываыва</p>', '2016-09-23 15:05:00', '2016-10-03 11:28:32', 7, 2),
	(25, 'Первый редактируемый тайтл', 'ХАХАХА. Норм же?', NULL, 'pervii-redaktiruemii-taitl', '<p>лтлодлодло</p>', '2016-09-23 15:05:31', '2016-10-07 12:40:48', NULL, 2);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;


-- Дамп структуры для таблица fb.posts_rates
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.posts_rates: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `posts_rates` DISABLE KEYS */;
INSERT INTO `posts_rates` (`id`, `post_id`, `user_id`, `value`, `created_at`, `updated_at`) VALUES
	(1, 24, 8, 1, '2016-09-30 11:39:15', '2016-09-30 11:39:15'),
	(2, 24, 4, 1, '2016-09-30 11:40:28', '2016-09-30 11:40:28'),
	(3, 23, 8, 1, '2016-10-03 14:37:42', '2016-10-03 14:37:42'),
	(4, 25, 8, 1, '2016-10-03 15:02:25', '2016-10-03 15:02:25'),
	(5, 25, 4, 1, '2016-10-03 15:02:46', '2016-10-03 15:02:46');
/*!40000 ALTER TABLE `posts_rates` ENABLE KEYS */;


-- Дамп структуры для таблица fb.post_tag
CREATE TABLE IF NOT EXISTS `post_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_tag_post_id_foreign` (`post_id`),
  KEY `post_tag_tag_id_foreign` (`tag_id`),
  CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.post_tag: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `post_tag` DISABLE KEYS */;
INSERT INTO `post_tag` (`id`, `post_id`, `tag_id`) VALUES
	(13, 25, 7);
/*!40000 ALTER TABLE `post_tag` ENABLE KEYS */;


-- Дамп структуры для таблица fb.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.roles: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', NULL, NULL),
	(2, 'moderator', NULL, NULL),
	(3, 'member', NULL, NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Дамп структуры для таблица fb.tags
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_slug_unique` (`slug`),
  KEY `tags_category_id_foreign` (`category_id`),
  CONSTRAINT `tags_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.tags: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` (`id`, `name`, `description`, `created_at`, `updated_at`, `slug`, `category_id`) VALUES
	(7, 'laravel', 'laravel posts', '2016-10-07 12:26:41', '2016-10-07 12:39:32', 'laravel', 4);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;


-- Дамп структуры для таблица fb.tag_user
CREATE TABLE IF NOT EXISTS `tag_user` (
  `user_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  KEY `tag_user_user_id_index` (`user_id`),
  KEY `tag_user_tag_id_index` (`tag_id`),
  CONSTRAINT `tag_user_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tag_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.tag_user: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `tag_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag_user` ENABLE KEYS */;


-- Дамп структуры для таблица fb.users
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
  KEY `FK_users_roles` (`role_id`),
  KEY `users_ban_id_foreign` (`ban_id`),
  CONSTRAINT `FK_users_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `users_ban_id_foreign` FOREIGN KEY (`ban_id`) REFERENCES `bans` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.users: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `login`, `name`, `last_name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`, `is_active`, `age`, `city`, `avatar`, `ban_counter`, `ban_id`) VALUES
	(3, 'kharamanv', 'Vladimir', 'Kharaman', 'kharaman.v@gmail.com', '$2y$10$qzUCl9AKpupAbILdOBT0vu61ZXGB6c.Y9GPcUfEJWdwM9BuYyTtX.', NULL, '2016-09-05 11:08:30', '2016-09-05 11:08:30', 3, 0, NULL, NULL, NULL, 0, NULL),
	(4, 'guba', 'Губенков', 'Губа', 'huhu@hu.ad', '$2y$10$fQx1vPpGf0ss8bcTQ6MuWewmEgm7q2AI81MQnr2Cv1UCckAHGzXf6', 'SnuhZ5bffz4AgE8EPqye8tQGHrWlLcGjho0DeOftkbjxbZn4ujVVDhP6FpK6', '2016-09-06 14:19:30', '2016-10-04 15:04:29', 3, 1, 21, 'Мариуполь', NULL, 3, NULL),
	(8, 'admin', 'Admin', 'Front', 'admin@admin.com', '$2y$10$VUl.O6kevnYHZp1eEfPdZuB4J86OF/4MpaBKbeIaO8wpTptylyWey', 'AwOXJz3VID1d1VNzqpzkgyTW6HAz8oGiPJiKkzYClsqj3McDlUDXGjLV9AEt', '2016-10-03 12:49:54', '2016-10-04 12:50:03', 1, 1, 33, 'Мариуполь', '08bd5af55f070967e032a21ab62e0282.jpg', 0, NULL),
	(9, 'asdadsasd', 'awdawd', 'awdawd', 'asd@ad.awd', '$2y$10$NCnhuoLyo2GSUbjllnWb9OqKakbrx38.Xjw6rF5hwp4DyljRDfcb2', NULL, '2016-09-12 13:37:37', '2016-09-12 13:37:37', 3, 0, NULL, NULL, NULL, 0, NULL),
	(10, 'asdsadasdaaassasa', 'asdasd', 'asdasd', 'asdsadad@asd.asd', '$2y$10$//Sfvrd7U1v7lqQGGbn8IOkIYc7G1PAgoudzQ5XpP9JyIjwzfrr56', NULL, '2016-09-14 14:10:18', '2016-09-14 14:10:18', 1, 1, NULL, NULL, NULL, 0, NULL),
	(11, 'member', 'qwewqeqwe', 'qweqweqwe', 'qweqwe@aa.ad', '$2y$10$WXcqKCVg15s8GoO8ybKuV.C/aMyy6THplEmc2Ek6ykAjgcmdvwwlu', NULL, '2016-09-14 15:06:39', '2016-09-14 15:06:39', 3, 0, NULL, NULL, NULL, 0, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Дамп структуры для таблица fb.user_activations
CREATE TABLE IF NOT EXISTS `user_activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_activations_token_index` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.user_activations: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `user_activations` DISABLE KEYS */;
INSERT INTO `user_activations` (`id`, `user_id`, `token`, `created_at`) VALUES
	(1, 2, 'sdfsd', '2016-09-09 18:22:15'),
	(2, 9, '7d41014093703dca3c42b9ec07b32efdf8541f1e3c10e28832c25fdbd1e48f1f', '2016-09-12 13:37:37'),
	(3, 11, '67e9550723978270f49e05232c148e8a7932c7611b289f019a26be10570581a7', '2016-09-14 15:06:39');
/*!40000 ALTER TABLE `user_activations` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
