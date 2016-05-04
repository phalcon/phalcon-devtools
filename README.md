[![Latest Version](https://img.shields.io/packagist/v/phalcon/devtools.svg?style=flat-square)](https://github.com/phalcon/incubator/devtools)
[![Software License](https://img.shields.io/badge/license-BSD--3-brightgreen.svg?style=flat-square)][1]
[![Total Downloads](https://img.shields.io/packagist/dt/phalcon/devtools.svg?style=flat-square)](https://packagist.org/packages/phalcon/devtools)
[![Daily Downloads](https://img.shields.io/packagist/dd/phalcon/devtools.svg?style=flat-square)](https://packagist.org/packages/phalcon/devtools)

# Phalcon Devtools

![Webtools](http://static.phalconphp.com/img/webtools.png)

## What's Phalcon?

Phalcon PHP is a web framework delivered as a C extension providing high performance and lower resource consumption.

## What are Devtools?

This tools provide you useful scripts to generate code helping to develop faster and easy applications that use
with Phalcon framework.

## Requirements

* PHP >= 5.3.9
* Phalcon >= 2.0.0

## Installing via Composer

Install composer in a common location or in your project:

```bash
curl -s http://getcomposer.org/installer | php
```

Create the composer.json file as follows:

```json
{
    "require": {
        "phalcon/devtools": "^2.0"
    }
}
```

If you are still using Phalcon 1.3.x, create a composer.json with the following instead:

```json
{
    "require": {
        "phalcon/devtools": "1.3.*@dev"
    }
}
```

Run the composer installer:

```bash
php composer.phar install
```

## Build `.phar`

Install composer and box in a common location or in your project:
```bash
curl -s http://getcomposer.org/installer | php
bin/composer install
```

Build phar file `phalcon-devtools`
```bash
bin/box build -v
chmod +xr ./phalcon.phar
# Test it!
php ./phalcon.phar
```

## Installation via Git

Phalcon Devtools can be installed by using Git.

Just clone the repo and checkout the current branch:

```bash
cd ~
git clone https://github.com/phalcon/phalcon-devtools.git
cd phalcon-devtools
```

This method requires a little bit more of setup. Probably the best way would be to symlink
the phalcon.php to a directory in your PATH, so you can issue phalcon commands in each directory
where a phalcon project resides.

```bash
ln -s ~/phalcon-devtools/phalcon.php /usr/bin/phalcon
chmod ugo+x /usr/bin/phalcon
```

## Usage

To get a list of available commands just execute following:

```bash
phalcon commands help
```

This command should display something similar to:

```sh
$ phalcon list ?

Phalcon DevTools (2.0.11)

Help:
  Lists the commands available in Phalcon devtools

Available commands:
  commands         (alias of: list, enumerate)
  controller       (alias of: create-controller)
  module           (alias of: create-module)
  model            (alias of: create-model)
  all-models       (alias of: create-all-models)
  project          (alias of: create-project)
  scaffold         (alias of: create-scaffold)
  migration        (alias of: create-migration)
  webtools         (alias of: create-webtools)
```

## Update WebTools from old version

Please remove manually directories:

* `public/css/bootstrap`
* `public/css/codemirror`
* `public/js/bootstrap`
* `public/img/bootstrap`
* `public/js/codemirror`
* `public/js/jquery`

and files:

* `public/webtools.config.php`
* `public/webtools.php`

and just run form your project root:

```bash
$ phalcon webtools --action=enable
```

## Database adapter

Should add 'adapter' parameter in your db config file (if you use not Mysql database). For PostgreSql will be

```php
$config = [
  "host"     => "localhost",
  "dbname"   => "my_db_name",
  "username" => "my_db_user",
  "password" => "my_db_user_password",
  "adapter"  => "Postgresql"
];
```

## License

Phalcon Developer Tools is open source software licensed under the [New BSD License][1].
© Phalcon Framework Team and contributors

[1]: docs/LICENSE.md
