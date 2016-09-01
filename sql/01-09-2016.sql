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


-- Дамп структуры для таблица fb.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.migrations: ~3 rows (приблизительно)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`migration`, `batch`) VALUES
	('2014_10_12_000000_create_users_table', 1),
	('2014_10_12_100000_create_password_resets_table', 1),
	('2016_08_22_191709_create_posts_table', 1);
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
  `img_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.posts: ~0 rows (приблизительно)
DELETE FROM `posts`;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `title`, `short`, `img_path`, `slug`, `text`, `created_at`, `updated_at`) VALUES
	(1, 'Voluptatem velit et est.', 'Qui et sit fugiat quas perspiciatis quasi. Sunt iusto sint ut eaque. Voluptatum nobis sint reiciendis. Voluptatibus dolorem sint voluptatem aspernatur.', NULL, 'velit-deserunt-magni-quasi-minus', 'Recusandae in laudantium veniam. Reiciendis id eius est tempora reiciendis ea. Incidunt pariatur non voluptates modi ea sunt fugit.', '2016-09-01 19:00:47', '2016-09-01 19:00:47'),
	(2, 'Neque quis a assumenda et.', 'Non recusandae temporibus eos provident sunt voluptatem iusto. Reprehenderit et nulla impedit quia cum et. Eligendi culpa nam ut quo eveniet reiciendis similique.', NULL, 'et-aut-ab-nostrum-culpa', 'Rerum placeat rerum asperiores debitis. Voluptas est earum eum est. Et est ad rem blanditiis dolor maxime et recusandae. Deleniti veritatis provident beatae fugiat omnis quidem fugiat.', '2016-09-01 19:00:47', '2016-09-01 19:00:47'),
	(3, 'Suscipit facere non in tempore ut.', 'Error consequuntur corporis dignissimos maxime omnis repellendus reiciendis quia. Est labore qui omnis sequi quam quia. Dolores et officiis recusandae enim et.', NULL, 'repellendus-adipisci-ducimus-consequatur-id-officiis', 'Quis earum et velit dolore vel aut. Laboriosam delectus aliquid aperiam nihil dolore reprehenderit. Provident et autem culpa autem vitae. Sit ab nemo omnis nulla sed.', '2016-09-01 19:00:47', '2016-09-01 19:00:47'),
	(4, 'Est eum dolorem dolorem praesentium nihil ad odio.', 'Voluptate sint delectus et ab laboriosam. Assumenda sunt voluptas velit consequuntur ut doloribus cumque. Qui sunt veniam quia repudiandae ea ut minima.', NULL, 'provident-et-unde-repellat-temporibus', 'Iure adipisci ex ut voluptates. Deleniti dolorem voluptatum aliquam facilis dolorum et. Voluptas reprehenderit sed corrupti consequatur. Blanditiis incidunt inventore et non nihil doloremque.', '2016-09-01 19:00:47', '2016-09-01 19:00:47'),
	(5, 'Aliquam perspiciatis facilis in aut minus tempore impedit.', 'Error est omnis earum eligendi delectus nesciunt. Ipsam atque a nostrum doloribus excepturi. Repellendus et esse et maxime.', NULL, 'quia-itaque-et-tenetur', 'Quo voluptatem sequi in architecto est vitae. Porro et earum quia debitis hic repellendus accusamus. Soluta aut incidunt repudiandae totam.', '2016-09-01 19:00:47', '2016-09-01 19:00:47'),
	(6, 'Velit expedita nesciunt ab deserunt esse deserunt hic.', 'Dolor commodi eligendi aliquid delectus incidunt qui mollitia. Reprehenderit quasi magni soluta sed unde. Sunt qui maiores repellat hic et dolore consequuntur. Aut impedit excepturi a rerum error modi amet.', NULL, 'dolores-fugit-maxime-ad-voluptatem', 'Omnis sapiente sequi est beatae molestiae ut et. Hic non incidunt quas sapiente nostrum. Et deserunt sapiente ut velit ullam sed.', '2016-09-01 19:00:47', '2016-09-01 19:00:47'),
	(7, 'Ab aut officia molestias maiores nobis voluptate soluta.', 'Qui sit beatae expedita ipsa aut. Nam atque provident omnis pariatur. Est ea doloribus deleniti atque ab earum. Totam excepturi illum enim sit cum consequatur velit quod.', NULL, 'omnis-error-vitae-expedita-incidunt-et-ut-in-sit', 'Nemo quas porro ut natus occaecati perferendis. Nihil facilis dolores tenetur sunt non. Assumenda minima voluptas totam vitae ipsum est.', '2016-09-01 19:00:47', '2016-09-01 19:00:47'),
	(8, 'Maxime eius sed dolorem sed.', 'Hic quae eum qui exercitationem natus est. Molestias molestiae fuga vero ea aut ut. Est necessitatibus fugit id exercitationem.', NULL, 'quisquam-sequi-quasi-provident-laborum', 'Fuga explicabo reiciendis non facilis natus repudiandae doloremque. Hic eos suscipit dicta magni voluptas. Nam quisquam quis architecto suscipit. A distinctio cumque et ipsum voluptas.', '2016-09-01 19:00:47', '2016-09-01 19:00:47'),
	(9, 'Dolor ea velit est praesentium voluptates rerum.', 'Suscipit provident rerum non qui sit nihil nihil. In voluptatibus fugit reprehenderit alias laborum natus eveniet.', NULL, 'voluptatum-ut-odio-iure-quam', 'Perferendis provident laudantium quos ut. Id totam amet tenetur quia facilis. Alias architecto quo sunt quis. Dicta asperiores dolor rem esse iste quo consequatur voluptas.', '2016-09-01 19:00:47', '2016-09-01 19:00:47'),
	(10, 'Quis dolores sed illo.', 'Doloribus velit quia quod. Nihil et iste consequuntur dolores. Voluptatum porro eos est labore quam harum mollitia. Eveniet porro laboriosam animi.', NULL, 'inventore-sed-possimus-minima-eligendi', 'Quam eveniet et ad earum iusto. Animi ipsam autem assumenda qui. Ex sint odio nihil non pariatur repellendus quia.', '2016-09-01 19:00:47', '2016-09-01 19:00:47'),
	(11, 'Aliquid voluptatum numquam commodi.', 'Occaecati doloribus sunt et dolor aut aperiam totam. Dolorum delectus amet explicabo odio et. Ipsum quam iusto est quia. Optio sint facilis odio fuga suscipit et consectetur.', NULL, 'quisquam-nihil-rerum-fugiat-at-quidem', 'Aut deleniti aut dolor et. Autem aut maiores eum. Totam magnam aperiam ullam vel. Vitae excepturi omnis repudiandae eligendi animi molestias.', '2016-09-01 19:00:47', '2016-09-01 19:00:47'),
	(12, 'Natus veniam eaque sit aut officia.', 'Qui consequatur odit facilis iure rerum ea odit. Voluptatum velit fugit tempore quisquam amet. Ut distinctio quia quis voluptatem repellendus beatae. Culpa et nemo blanditiis aliquam tenetur.', NULL, 'consequatur-perspiciatis-harum-et-quia-et-quia-autem', 'Reprehenderit expedita tenetur adipisci ut atque. Itaque ipsam incidunt sunt quaerat illo quibusdam commodi. Aut at corporis voluptatem vel pariatur aut sequi.', '2016-09-01 19:00:47', '2016-09-01 19:00:47'),
	(13, 'Et voluptates perspiciatis delectus deserunt.', 'Tempore laboriosam facere omnis molestias ipsam. Odit non et voluptatem occaecati quasi. Repellat ipsam ratione nostrum quia sit molestias iste rerum. Soluta amet et odit enim distinctio.', NULL, 'facilis-quo-sit-officiis-aut-et-numquam', 'Tempore esse numquam autem. Nostrum vel ea consequatur. Quibusdam doloremque voluptatibus quia nisi est inventore. Id assumenda neque corrupti quia.', '2016-09-01 19:00:47', '2016-09-01 19:00:47'),
	(14, 'Voluptates rerum exercitationem qui ducimus cumque.', 'Dicta est sunt reprehenderit dignissimos qui enim est. Rerum rerum blanditiis consequatur quia. Dignissimos aperiam assumenda unde quaerat praesentium est.', NULL, 'sed-error-consequatur-exercitationem-dolorum-qui-dicta-iure', 'Sint consectetur et dignissimos. Voluptate laudantium quia est quos officia voluptatibus distinctio.', '2016-09-01 19:00:47', '2016-09-01 19:00:47'),
	(15, 'Et est quam at dicta nulla similique quam.', 'Quo repellendus sunt et sint tenetur. Optio voluptatem in eum ex similique laudantium. Consectetur adipisci et neque expedita.', NULL, 'sunt-magni-ut-adipisci-illum-quod', 'Qui et velit quod sit incidunt voluptatem est praesentium. Quisquam et harum officia libero in. Rem id neque error minima. Iusto omnis veritatis repudiandae consectetur.', '2016-09-01 19:00:47', '2016-09-01 19:00:47'),
	(16, 'Nihil delectus natus earum rem.', 'Error ut ex quo hic incidunt corrupti repellat. Molestias suscipit ex neque sed. Et eligendi sed et est corporis non. Id incidunt aliquid soluta odio provident qui. Consequuntur facilis quis voluptatem.', NULL, 'dolorem-porro-qui-qui-repellendus-sequi', 'Occaecati sunt voluptatem odio ducimus. Sed rerum minus dolor debitis. Aliquid dolorum repellat voluptas fugiat iste quo sed nostrum.', '2016-09-01 19:00:47', '2016-09-01 19:00:47'),
	(17, 'Libero tempore blanditiis voluptatem iste adipisci.', 'Deleniti et repudiandae molestias id animi et corporis ratione. Officia esse quasi sed cupiditate et facere est. Dolorem explicabo rerum eveniet autem.', NULL, 'sint-dolor-pariatur-aperiam-omnis-laudantium-nisi-corporis', 'Sit error enim necessitatibus qui et. Hic maxime alias expedita ab dolor libero eum. Qui numquam et magnam. Odit est et excepturi totam.', '2016-09-01 19:00:47', '2016-09-01 19:00:47'),
	(18, 'Magni odit id autem explicabo expedita omnis ex.', 'Dolores nam voluptatem sed architecto facere id maiores. Laborum dolorem ut perferendis ea aut iusto sequi. Et consectetur sit cupiditate esse. Cupiditate sed porro at est qui saepe possimus doloribus.', NULL, 'ut-deserunt-tenetur-alias-soluta-et', 'Reprehenderit dolorum nihil accusamus itaque. Deserunt et quibusdam ut iure hic aut corporis. Rerum aliquam quia enim ratione vero hic ipsam.', '2016-09-01 19:00:47', '2016-09-01 19:00:47'),
	(19, 'Veritatis in velit facere quidem cum enim et.', 'Incidunt aut qui sint enim sed vitae. Rerum alias officiis aliquid quia iusto voluptatibus. Blanditiis molestiae quia aut voluptates sit. Accusantium ut rerum ipsum odio in.', NULL, 'et-quidem-alias-aliquid-natus-nobis', 'Numquam qui esse vero vel eos. Voluptatibus soluta qui est minima voluptatem aut rerum. Vel debitis aut sint dicta eum.', '2016-09-01 19:00:47', '2016-09-01 19:00:47'),
	(20, 'Magnam saepe saepe possimus similique aut sit.', 'Atque quasi soluta quidem rerum. Corrupti nostrum debitis natus adipisci. Praesentium quia occaecati adipisci eveniet. Quaerat sit est maiores adipisci aut.', NULL, 'dolores-quia-qui-placeat-dolorem', 'Laborum nemo vitae eum mollitia molestiae dolor. Expedita modi pariatur veniam aut assumenda quisquam sunt. Recusandae error facere dolorem enim iusto.', '2016-09-01 19:00:47', '2016-09-01 19:00:47');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;


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
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_login_unique` (`login`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.users: ~0 rows (приблизительно)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `login`, `name`, `last_name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'frontend', 'Edel', 'Pier', 'frontend@gmail.com', '$2y$10$t4obj.t730E0feTv6klJQ.FgZ9gWLG.TmSplSu8wE3JChvJ.Wj3vO', '0nMficfg2DpHGpCuEgPrFYJ6cAOY7pBT6oDnZ5ee78yyUdrW3nqJXKZ9SVe8', '2016-09-01 19:13:14', '2016-09-01 19:13:34');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
