Installation
============

This pages contains instructions on how to install Plop on your machine.
There are several ways to achieve that. Each method is described below.

..  contents:: :local:

..  note::

    We recommend using the `PHAR installation`_ method
    or the `composer installation`_ method, depending on
    whether your project already uses `Composer`_ or not.


..  _`PHAR installation`:

Installation using a PHAR archive
---------------------------------

A PHAR archive is simply a way of bundling all the necessary files in one big
file.

Installing Plop as a PHAR archive only involves a few steps:

1.  Make sure your installation fulfills all of the :ref:`prerequisites <Prerequisites>`.

    ..  note::

        As all of Plop's PHAR archives (core and modules) are digitally
        signed, you must make sure the OpenSSL extension is enabled on your
        PHP installation. Failure to do so will result in an error when trying
        to run Plop's PHAR archive.

2.  Download the PHAR archive for Plop. You can grab the latest
    version from https://github.com/Erebot/Plop/releases/latest/.

..  warning::

    The PHAR archive should work properly on most installations.
    However, a few issues have been discovered in the past with certain
    PHP features and extensions. In case the archive does not work
    on your computer,it is usually a good idea to check the following items:

    -   Make sure ``detect_unicode`` is set to ``Off`` in your :file:`php.ini`.
        This is especially important on MacOS where this setting tends to be
        set to ``On`` for a default PHP installation.

    -   If you applied the Suhosin security patch to your PHP installation,
        make sure ``phar`` is listed in your :file:`php.ini` under the
        ``suhosin.executor.include.whitelist`` directive.

    -   Please be aware of certain incompatibilities between the Phar extension
        and the ionCube Loader extension. To use Plop from a PHAR archive,
        you will need to remove the following line from your :file:`php.ini`:

        .. sourcecode:: ini

            zend_extension = /usr/lib/php5/20090626+lfs/ioncube_loader_lin_5.3.so

        (the path and versions may be different for your installation).

3.  Check that the installation was successful by running the following
    command:

    ..  sourcecode:: bash

        $ php -f Plop-latest.phar

    (replace :file:`Plop-latest.phar` with the actual name of the PHAR archive
    you just downloaded in case it was different)

    The command should return without any error. If error messages are issued,
    try to fix your installation using the information given by those messages.

You may now proceed to the :ref:`next step <Using Plop>`, which makes
actual use of Plop's logging capabilities.


..  _`composer installation`:

Installation using `Composer`_
------------------------------

`Composer`_ is a simple dependency resolver / package manager aimed at
PHP 5.3.0 or later.

If your project already uses Composer, installing Plop is very simple.
You just need to add a requirement on Plop's package:

..  sourcecode:: bash

    me@localhost:~/myproject/$ php /path/to/composer.phar require erebot/plop

That's it! Plop is now installed and you may proceed
to the :ref:`next step <Using Plop>`, which makes actual use
of Plop's logging capabilities.


Installation from sources
-------------------------

First, make sure a git client is installed on your machine.
Under Linux, **from a root shell**, run the command that most closely matches
the tools provided by your distribution:

..  sourcecode:: bash

    # For apt-based distributions such as Debian or Ubuntu
    $ apt-get install git

    # For yum-based distributions such as Fedora / RHEL / CentOS
    $ yum install git

    # For dnf-based distributions such as newer Fedora releases
    $ dnf install git

    # For urpmi-based distributions such as MES (Mandriva)
    $ urpmi git

..  note::

    Windows users may be interested in installing `Git for Windows`_ to get
    an equivalent git client. Also, make sure that :program:`git` is present
    on your account's :envvar:`PATH`. If not, you'll have to replace
    :command:`git` by the full path to :file:`git.exe` on every invocation
    (e.g. :command:`"C:\\Program Files\\Git\\bin\\git.exe" clone ...`)

Also, make sure you have all the :ref:`required dependencies <Prerequisites>`
installed as well. Now, retrieve Plop's code from its repository,
using the following command:

..  sourcecode:: bash

    $ git clone --recursive git://github.com/Erebot/Plop.git

You may now proceed to the :ref:`next step <Using Plop>`, which makes
actual use of Plop's logging capabilities.


..  _`Git for Windows`:
    http://code.google.com/p/msysgit/downloads/list
..  _`Composer`:
    http://getcomposer.org/

.. vim: ts=4 et
