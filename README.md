Doctrine's Cache for Mouf framework
===================================

Provides an install script for Doctrine's Cache system in Mouf Framework.

Content of the package
----------------------

This package contains an install script that provides a [Doctrine's `Cache`](http://docs.doctrine-project.org/en/2.0.x/reference/caching.html) instance in a Mouf project,
and a wrapper that makes Doctrine cache system compatible with Mouf cache system.

The Mouf instance of the Doctrine cache driver is called `defaultDoctrineCache`.

By default, it is configured as the following:

- If debug mode is true (constant DEBUG=true is config.php), then an `ArrayCache` is used. Therefore, the cache is purged
  after each request.
- If debug mode is false, a `APCCache`. If APC is not installed, we fallback to a `FileCache`.

The package also creates a `doctrineMoufCache` instance that is a wrapper around the `defaultDoctrineCache`
that provides compatibility with the Mouf cache system.

The wrapper
-----------

This package contains the `DoctrineCacheAdapter` class. This class can be used to transform any instance of a
Doctrine cache into a cache that is compatible with Mouf.

This is very convenient, especially because any Mouf cache can be purged using the red "Purge button" in the Mouf UI.

Installation
------------

To install the package, just add its latest version to your composer.json (see the package in the [packagist website](https://packagist.org/packages/mouf/utils.common.doctrine-annotations-wrapper)) adn run the `php composer.phar update`.

Then in Mouf validation process, a new task should be marked as **To run**, launch the installation process and you will have your `defaultDoctrineCache` instance ready to use !
