<?php
/*
 * Copyright (c) 2013 David Negrier
 *
 * See the file LICENSE.txt for copying permission.
 */

namespace Mouf\Utils\Common\Doctrine\Annotations;

use Mouf\Installer\PackageInstallerInterface;
use Mouf\MoufManager;
use Mouf\Actions\InstallUtils;

/**
 * A Mouf installer for the cache system of Doctrine.
 */
class CacheInstaller implements PackageInstallerInterface {

	/**
	 * (non-PHPdoc)
	 * @see \Mouf\Installer\PackageInstallerInterface::install()
	 */
	public static function install(MoufManager $moufManager) {
		// Let's create the instances.
		$cacheInstance = InstallUtils::getOrCreateInstance('defaultDoctrineCache', null, $moufManager);
		$cacheInstance->setCode('// If DEBUG mode is on, let\'s just use an ArrayCache.
if (DEBUG) {
	$driver = new Doctrine\\Common\\Cache\\ArrayCache());
} else {
	// If APC is available, let\'s use APC
	if (extension_loaded("apc")) {
		$driver = new Doctrine\\Common\\Cache\\ApcCache();
	} else {
		$driver = new Doctrine\\Common\\Cache\\FileCache(sys_get_temp_dir().\'/doctrinecache\');
	}
}
$driver->setNamespace(SECRET);
return $driver;
');

		// Let's rewrite the MoufComponents.php file to save the component
		$moufManager->rewriteMouf();
	}
}