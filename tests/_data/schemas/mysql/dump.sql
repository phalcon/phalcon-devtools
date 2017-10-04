--
-- Table structure for table `phalcon_migrations`
--
DROP TABLE IF EXISTS `phalcon_migrations`;
CREATE TABLE `phalcon_migrations` (
  `version` varchar(255) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `idx_phalcon_migrations_version` (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `test_migrations`;
CREATE TABLE `test_migrations` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(45) NOT NULL,
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL,
    `active` tinyint(1) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT into `test_migrations` SET
    `name` = 'test2',
    `active` = 1,
    `created_at` = NOW(),
    `updated_at` = NOW();

DROP TABLE IF EXISTS `test_many_running`;
CREATE TABLE `test_many_running` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(45) NOT NULL,
    `created_at` datetime NOT NULL,
    `active` tinyint(1) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `test_dry_verbose`;
CREATE TABLE `test_dry_verbose` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(45) NOT NULL,
    `created_at` datetime NOT NULL,
    `active` tinyint(1) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
