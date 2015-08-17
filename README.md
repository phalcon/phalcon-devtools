[![Latest Version](https://img.shields.io/packagist/v/phalcon/devtools.svg?style=flat-square)](https://github.com/phalcon/incubator/devtools)
[![Total Downloads](https://img.shields.io/packagist/dt/phalcon/devtools.svg?style=flat-square)](https://packagist.org/packages/phalcon/devtools)
[![Software License](https://img.shields.io/badge/license-BSD--3-brightgreen.svg?style=flat-square)](https://github.com/phalcon/phalcon-devtools/blob/master/docs/LICENSE.txt)

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
        "phalcon/devtools": "dev-master"
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

Create a symbolic link to the phalcon.php script:

```bash
ln -s ~/devtools/phalcon.php /usr/bin/phalcon
chmod ugo+x /usr/bin/phalcon
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

## Installation via PEAR

Phalcon Devtools can be installed using PEAR. Since the current version of Devtools
is in beta state, you might need to update your PEAR config. You can execute following to check
your current state:

```bash
pear config-show | grep preferred_state | awk '{split($0, s, " "); print s[5]}'
```

If it prints "stable" you need to set the preferred_state to beta:

```bash
pear config-set preferred_state beta
```

After that just discover the channel and install the package:

```bash
pear channel-discover pear.phalconphp.com
pear install phalcon/Devtools
```

Alternatively you can just clone the repo and checkout the current branch

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
$ phalcon commands
```

This command should display something similar to:

```bash
Phalcon DevTools (2.0.7)

Help:
  Lists the commands available in Phalcon devtools

Available commands:
  commands (alias of: list, enumerate)
  controller (alias of: create-controller)
  model (alias of: create-model)
  all-models (alias of: create-all-models)
  project (alias of: create-project)
  scaffold (alias of: create-scaffold)
  migration (alias of: create-migration)
  webtools (alias of: create-webtools)
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

Phalcon Developer Tools is open source software licensed under the New BSD License. See the docs/LICENSE.txt file for more.
