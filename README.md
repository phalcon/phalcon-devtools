Phalcon Devtools
================

![Webtools](http://www.phalconphp.com/img/webtools.png)

What's Phalcon?
---------------
Phalcon PHP is a web framework delivered as a C extension providing high performance and lower resource consumption.

What are Devtools?
------------------
This tools provide you useful scripts to generate code helping to develop faster and easy applications that use
with Phalcon framework.

Requirements
------------

* PHP >= 5.3.9
* Phalcon >= 0.7.0

Installing via Composer
=======================
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

Run the composer installer:

```bash
php composer.phar install
```

Create a symbolink link to the phalcon.php script:

```bash
ln -s ~/devtools/phalcon.php /usr/bin/phalcon
chmod ugo+x /usr/bin/phalcon
```

Installation via PEAR
=====================
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

Usage
=====

To get a list of available commands just execute following:

```bash
$ phalcon commands
```

This command should display something similar to:

```bash
Phalcon DevTools (1.0.0)

Help:
  Lists the commands availables in Phalcon devtools

Available commands:
  commands (alias of: list, enumerate)
  controller (alias of: create-controller)
  model (alias of: create-model)
  all-models (alias of: create-all-models)
  project (alias of: create-project)
  migration
  scaffold
  webtools
```
