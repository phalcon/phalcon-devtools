Phalcon Devtools
================

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
* Phalcon >= 0.5.0

Installation
============

The best way to install Phalcon Devtools is using PEAR. Since the current version of Devtools
is in beta state, you might need to update your PEAR config. You can execute following to check
your current state:

```
$ pear config-show | grep preferred_state | awk '{split($0, s, " "); print s[5]}'
```

If it prints "stable" you need to set the preferred_state to beta:

```
$ pear config-set preferred_state beta
```

After that just discover the channel and install the package:

```
$ pear channel-discover pear.phalconphp.com
$ pear install phalcon/Devtools
```

Alternatively you can just clone the repo and checkout the current branch

```
$ cd ~
$ git clone https://github.com/phalcon/phalcon-devtools.git
$ cd phalcon-devtools
$ git checkout -b 0.5.0
$ git pull origin 0.5.0
```

This method requires a little bit more of setup. Probably the best way would be to symlink
the phalcon.php to a directory in your PATH, so you can issue phalcon commands in each directory
where a phalcon project resides.

```
$ ln -s ~/phalcon-devtools/phalcon.php /usr/bin/phalcon
$ chmod ugo+x /usr/bin/phalcon
```

Installation through composer is planned but not ready yet.

Usage
=====

To get a list of available commands just execute following:

```
$ phalcon commands
```

This command should display something similar to:

```
Phalcon DevTools (0.5.0)

Help:
  Lists the commands availables in Phalcon devtools

Available commands:
  commands (alias of: list, enumerate)
  controller (alias of: create-controller)
  model (alias of: create-model)
  all-models (alias of: create-all-models)
  project (alias of: create-project)
  scaffold
  webtools
```

Right now not all commands are available as described here:

https://groups.google.com/forum/?fromgroups=#!topic/phalcon/B_gc5kNq5q4

To get a help for a certain command just execute phalcon [command], e.g.:

```
$ phalcon project
```

Available Commands
==================

commands
--------

TODO

controller
----------

TODO

model
-----

TODO

all-models
----------

TODO

project
-------

TODO

scaffold
--------

TODO

webtools
--------

TODO

Copyright
=========

See docs/LICENSE

