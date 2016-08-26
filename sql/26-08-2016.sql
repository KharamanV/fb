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

-- Дамп данных таблицы fb.posts: ~20 rows (приблизительно)
DELETE FROM `posts`;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `title`, `short`, `img_path`, `slug`, `text`, `created_at`, `updated_at`) VALUES
	(1, 'Первый редактируемый тайтл', 'ХАХАХА. Норм же? смотри, отрелактировало', NULL, 'best-title-an-slug', 'Значит так, приходит Губа к с старцу...\r\nЧитать в источике...				', '2016-08-23 15:43:52', '2016-08-26 17:55:37'),
	(2, 'Et est qui repudiandae commodi eum quia.', 'Et distinctio a omnis cumque. At molestiae qui impedit illo. Dignissimos ipsam sit nam aspernatur est.', NULL, 'optio-perferendis-sequi-in-corporis-tempore', 'Sed eaque vel excepturi magni natus. Debitis sit voluptate iure consequatur. Placeat voluptas ex accusamus et velit voluptas. Consectetur quia nobis sed.', '2016-08-23 15:43:52', '2016-08-23 15:43:52'),
	(3, 'Totam dolorem voluptate explicabo rem.', 'Placeat nostrum aut quo hic iste deserunt. Quibusdam cumque itaque eligendi fugiat dolore. Totam odio vel qui impedit praesentium omnis porro.', NULL, 'dicta-sequi-facilis-est-ullam', 'Aspernatur sed iure ut et natus et molestias. Amet odio minus beatae ad tenetur. Sint facilis voluptatem distinctio sunt ea voluptas porro dicta.', '2016-08-23 15:43:52', '2016-08-23 15:43:52'),
	(4, 'Est a qui harum excepturi enim doloremque.', 'Rerum dolores temporibus quia autem doloribus ex. Quia recusandae iste mollitia ea et et. At labore eum iusto fugiat et dolores.', NULL, 'quo-eius-quam-eum', 'Sint veniam et quod omnis. Voluptas totam corrupti et iure et corporis qui. Modi sunt maxime debitis. Accusamus repudiandae minus rerum eius aut.', '2016-08-23 15:43:52', '2016-08-23 15:43:52'),
	(5, 'Rerum iste rem assumenda ut beatae nobis.', 'Itaque optio harum assumenda enim illo distinctio. Perferendis sunt ea rerum voluptas. Atque voluptatem fugiat voluptatibus nemo.', NULL, 'sit-voluptatem-dolor-sunt-similique', 'Harum nam dignissimos quas assumenda eos. Quibusdam et cupiditate consequatur repellendus quo nemo. Nesciunt provident velit cupiditate omnis ut.', '2016-08-23 15:43:52', '2016-08-23 15:43:52'),
	(6, 'Aliquid sed omnis maxime quos.', 'Inventore iure sed quas placeat maxime aspernatur. Sint ut culpa vitae.', NULL, 'culpa-saepe-dolorum-tenetur-iste', 'Suscipit repellat aut quisquam amet ut omnis ad. Assumenda voluptatem molestiae veniam enim. Et repellendus fuga dolorum.', '2016-08-23 15:43:52', '2016-08-23 15:43:52'),
	(7, 'Et eaque asperiores rerum voluptas maxime a.', 'Vitae ab at dolor odio et quo. Numquam minus accusantium facilis autem. Cum voluptatem tempore eos quis et dolorem.', NULL, 'magnam-temporibus-autem-ducimus-nesciunt-doloremque-doloremque-dolorum', 'Consectetur doloribus voluptatem magni consectetur quo consequatur necessitatibus. Soluta tempore consectetur aperiam esse voluptatem commodi dolorem. Quis officiis ut accusantium numquam.', '2016-08-23 15:43:52', '2016-08-23 15:43:52'),
	(8, 'Sed aut ipsam et.', 'Totam explicabo omnis molestiae et at quo non. Omnis placeat nemo inventore laboriosam laborum sapiente repellendus. Suscipit aliquid sit minus facere. Deserunt et accusamus officiis est tempora in.', NULL, 'et-possimus-qui-atque', 'Corrupti ipsam et nisi. Laboriosam exercitationem neque quas aliquid ea tenetur a. Odit atque delectus est nam eligendi quasi. Fuga deleniti assumenda amet consequuntur.', '2016-08-23 15:43:52', '2016-08-23 15:43:52'),
	(9, 'Aut hic ab possimus quia.', 'Ut ut dolorem nihil inventore reiciendis quia nesciunt. Earum minus est eum quia in voluptatem recusandae quis. Et ut maiores voluptates omnis quibusdam.', NULL, 'dolore-amet-consequatur-veritatis-id-dignissimos', 'Sed illo et nemo. Et non quis rerum eveniet. Reprehenderit nesciunt laborum molestiae perferendis quo et.', '2016-08-23 15:43:52', '2016-08-23 15:43:52'),
	(10, 'Ad ut repellendus molestiae enim.', 'Nemo atque ratione animi porro magnam natus ullam. Magnam reiciendis numquam perspiciatis. Incidunt explicabo quibusdam sequi voluptate sit omnis et.', NULL, 'quos-voluptas-labore-deserunt-rem', 'Nulla iusto aut aut in sequi quo provident. Labore consequatur laboriosam deleniti sint perferendis fugiat ut. Omnis alias accusamus ut facilis facere officiis assumenda est.', '2016-08-23 15:43:52', '2016-08-23 15:43:52'),
	(11, 'Incidunt laborum eveniet quidem corrupti aut adipisci placeat.', 'Illum ducimus est maiores quidem necessitatibus sed. Voluptatem est autem ut molestiae. Eveniet deserunt quisquam est harum. Sit et dolores dignissimos quod quo explicabo cupiditate.', NULL, 'ratione-cumque-nisi-enim-facilis-dolore', 'Veritatis consequatur quia velit qui nihil animi. Est modi atque magnam non corrupti quia error. Et vel temporibus qui modi est.', '2016-08-23 15:43:52', '2016-08-23 15:43:52'),
	(12, 'Vel accusamus minima vitae.', 'Similique consequatur consectetur et voluptas. Ut aut veniam ut. Corrupti odit quibusdam qui consequatur culpa harum voluptatem. Ipsa fuga iure sunt nesciunt pariatur odit dolores.', NULL, 'blanditiis-voluptas-cumque-ratione-praesentium-facere-perspiciatis-corrupti', 'Animi cumque eos a dolor. Reiciendis sunt omnis quam eveniet cupiditate iure repellendus. Sed qui et necessitatibus quis earum repellat modi nobis.', '2016-08-23 15:43:52', '2016-08-23 15:43:52'),
	(13, 'Ut dolores dolorem aut voluptatem.', 'Eos eius deserunt in ad consequatur minus doloremque. Velit dolor quasi molestiae quae architecto dolor. Dolore ullam ipsum debitis voluptatem quia. Dolores non nisi quia maxime dicta. Adipisci eveniet vel doloribus minima eos velit.', NULL, 'culpa-itaque-iste-fugiat-qui-perspiciatis', 'Blanditiis repellendus sint rerum. Aut vero sapiente enim perferendis aut. Iusto eveniet eaque fugiat et culpa nostrum.', '2016-08-23 15:43:52', '2016-08-23 15:43:52'),
	(14, 'Esse sunt et vero ut.', 'Officia earum consequatur praesentium nam doloremque unde. Ut odio esse facilis et quo et laboriosam. Quis est soluta tempora enim. Et veritatis voluptatem id eos qui exercitationem quasi tempora.', NULL, 'rerum-vero-temporibus-voluptas-voluptates-molestiae-facilis-et', 'Voluptates numquam eos atque rerum ea blanditiis vel. Doloremque quis quaerat molestiae excepturi quis ullam. Fugiat nemo vel ea.', '2016-08-23 15:43:52', '2016-08-23 15:43:52'),
	(15, 'Occaecati blanditiis et in magni inventore ut natus.', 'Consequatur incidunt omnis expedita recusandae. Reiciendis ea qui deleniti dolores. Dolorem consequuntur similique dolores totam minus temporibus. Amet velit consequatur et est ut ipsum numquam commodi.', NULL, 'illo-magni-impedit-ab-modi-mollitia-amet', 'Non voluptatem voluptatum qui ducimus eum repellat. Animi voluptas aliquam qui qui. Nisi distinctio vitae dolores consequatur architecto.', '2016-08-23 15:43:52', '2016-08-23 15:43:52'),
	(16, 'Quisquam et qui qui maiores in qui totam.', 'Adipisci quidem voluptates nihil mollitia dolorem rerum et. Alias recusandae ipsam dicta autem numquam. Accusantium aut asperiores commodi et eum officia. Dolorum delectus quisquam nisi libero temporibus voluptas. Sint natus natus harum quis quia vel ea.', NULL, 'et-corrupti-assumenda-ut-numquam-qui', 'Recusandae aut nulla ea eos ut rerum nisi. Ab molestiae corporis illo saepe velit est. Aut numquam laudantium consequatur et explicabo quo.', '2016-08-23 15:43:52', '2016-08-23 15:43:52'),
	(17, 'Fugiat et a ut consequatur qui.', 'Voluptatum accusantium quam aliquid dicta. Inventore architecto libero omnis perspiciatis eaque suscipit et assumenda. Est quod architecto ex ut deleniti ea repellat occaecati. Veniam quo rerum commodi alias similique.', NULL, 'ut-qui-nisi-sequi-fugiat', 'Soluta expedita maxime aut nihil cumque illum. Non sequi blanditiis soluta animi placeat voluptatem.', '2016-08-23 15:43:52', '2016-08-23 15:43:52'),
	(18, 'Hic deleniti repudiandae illo aut occaecati minima molestias corrupti.', 'Recusandae dolor magnam omnis accusantium magnam. Eos repudiandae qui dolor omnis rerum ut. Nobis dolore deleniti impedit voluptate magnam inventore quis laboriosam. Quaerat distinctio aliquam minus architecto.', NULL, 'et-et-velit-omnis-sit', 'Et tempore deserunt voluptatem. Corrupti non repudiandae aut nostrum eligendi. Ducimus quod molestias eos iste.', '2016-08-23 15:43:52', '2016-08-23 15:43:52'),
	(19, 'Ipsum id natus ipsam et ex est.', 'Voluptatem ab magni sit velit qui reiciendis. Maiores facere et explicabo id ratione cumque sed. Autem aut possimus quis. Ut ut sunt vitae est distinctio.', NULL, 'ipsa-ea-dolor-similique', 'Facere cumque qui deleniti sit repellendus rerum. Ratione qui aut et ex quia accusamus excepturi. Magnam quasi delectus nemo rerum consequatur enim totam. Quaerat qui consequatur nostrum dolor.', '2016-08-23 15:43:52', '2016-08-23 15:43:52'),
	(20, 'Non atque molestias doloremque nemo ut.', 'Dolor molestiae ad ipsam id reiciendis praesentium. Id assumenda quia quisquam quia quibusdam molestiae placeat. Tenetur necessitatibus inventore rerum itaque doloribus dolorum. Itaque odio totam et ullam quidem iusto.', NULL, 'unde-dicta-animi-dolor', 'Aspernatur dignissimos explicabo corporis aut reiciendis. Qui quia sapiente distinctio qui omnis qui. Fugiat quibusdam quos cum et.', '2016-08-23 15:43:52', '2016-08-23 15:43:52');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;


-- Дамп структуры для таблица fb.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы fb.users: ~0 rows (приблизительно)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
