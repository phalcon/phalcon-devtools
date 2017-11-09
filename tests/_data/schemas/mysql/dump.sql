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

--
-- Table structure for testing table prefix, issue #595
--
DROP TABLE IF EXISTS `issue595_1`;
CREATE TABLE `issue595_1` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(45) NOT NULL,
    `version` int(45) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `issue595_2`;
CREATE TABLE `issue595_2` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `version` int(45) NOT NULL,
    `name` varchar(45) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structures for testing generating models
--
CREATE TABLE testModel (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `some-col` varchar(20) NOT NULL,
    `someCol2` varchar(20) NOT NULL,
    `SomeCol3` varchar(20) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `test-model2` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(45) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `test_model3` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(45) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Testmodel4` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(45) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
