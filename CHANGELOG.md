# [4.0.5](https://github.com/phalcon/cphalcon/releases/tag/v4.0.5)
## Added

## Fixed
- Fixed model creation failure in webtools due to wrong variable mutation [#1415](https://github.com/phalcon/phalcon-devtools/issues/1415)
- Fixed config path detection to platform independent [#1426](https://github.com/phalcon/phalcon-devtools/issues/1426)

## Changed

[4.0.4](https://github.com/phalcon/cphalcon/releases/tag/v4.0.4) (2021-03-11)
## Added
- Added support for PHP `7.4` [#1482](https://github.com/phalcon/phalcon-devtools/pull/1482)

## Fixed
- Fixed config scanner [c5cd3e95dc9356927a8b52ee2bbad0e87bf828a3](https://github.com/phalcon/phalcon-devtools/commit/c5cd3e95dc9356927a8b52ee2bbad0e87bf828a3)
- Fixed Di instance order [#1471](https://github.com/phalcon/phalcon-devtools/issues/1471)

## Changed
- Upgraded lucas/phpdotenv [#1460](http://github.com/phalcon/phalcon-devtools/issues/1460)
- Updated `README.md` [#1458](https://github.com/phalcon/phalcon-devtools/issues/1458)
- Moved phar generation during release from Travis CI to Github Actions [#1483](https://github.com/phalcon/phalcon-devtools/issues/1483)


# [4.0.3](https://github.com/phalcon/cphalcon/releases/tag/v4.0.3) (2020-04-26)
## Fixed
- Fixed notice error during SQLite connection [#1451](https://github.com/phalcon/phalcon-devtools/pull/1451)
- Fixed global autoload [#1378](https://github.com/phalcon/phalcon-devtools/issues/1378)
- Fixed empty `vendor/` directory inside `phalcon.phar` during building [#1456](https://github.com/phalcon/phalcon-devtools/pull/1456)


# [4.0.2](https://github.com/phalcon/cphalcon/releases/tag/v4.0.2) (2020-04-11)
## Added
- Added launcher.bat to run cli with Windows and used DIRECTORY_SEPARATOR to find the file. [#1440](https://github.com/phalcon/phalcon-devtools/issues/1440) [@jenovateurs](https://github.com/jenovateurs)

## Fixed
- Fixed include order of files in created project [#1417](https://github.com/phalcon/phalcon-devtools/issues/1417)
- Fixed Scaffold templates errors and phpstan errors. [#1429](https://github.com/phalcon/phalcon-devtools/issues/1429) [@jenovateurs](https://github.com/jenovateurs)
- Fixed duplicate camelCase properties [#1433](https://github.com/phalcon/phalcon-devtools/pull/1433)
- Fixed webtools not enabled by default when creating a new project [#1410](https://github.com/phalcon/phalcon-devtools/issues/1410) [@jenovateurs](https://github.com/jenovateurs)
