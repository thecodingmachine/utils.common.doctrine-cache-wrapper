<?php
/*
 * Copyright (c) 2014 David Negrier
 *
 * See the file LICENSE.txt for copying permission.
 */

namespace Mouf\Utils\Common\Doctrine\Cache;

use Mouf\Utils\Cache\CacheInterface;
use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Cache\CacheProvider;

/**
 * This class is an adapter that turns a Doctrine cache into a Mouf cache.
 */
class DoctrineCacheAdapter implements CacheInterface {

	private $doctrineCache;

	public function __construct(Cache $doctrineCache) {
		$this->doctrineCache = $doctrineCache;
	}

	/**
	 * (non-PHPdoc)
	 * @see \Mouf\Utils\Cache\CacheInterface::get()
	 */
	function get($key) {
		// Note: on miss, we return null, not false.
		$result = $this->doctrineCache->fetch($key);
		if ($result == false) {
			if ($this->doctrineCache->has($key)) {
				return false;
			} else {
				return null;
			}
		} else {
			return $result;
		}
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Mouf\Utils\Cache\CacheInterface::set()
	 */
	function set($key, $value, $timeToLive = null) {
		$this->doctrineCache->save($key, $value, $timeToLive);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Mouf\Utils\Cache\CacheInterface::purge()
	 */
	function purge($key) {
		$this->doctrineCache->delete($key);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Mouf\Utils\Cache\CacheInterface::purgeAll()
	 */
	function purgeAll() {
		if ($this->doctrineCache instanceof CacheProvider) {
			$this->doctrineCache->deleteAll();
		} else {
			$this->doctrineCache->delete("*");
		}
	}
}
