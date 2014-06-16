<?php
/*
 * Copyright (c) 2014 David Negrier
 *
 * See the file LICENSE.txt for copying permission.
 */

namespace Mouf\Utils\Common\Doctrine\Cache;


/**
 * This class is an adapter that turns a Doctrine cache into a Mouf cache.
 */
class DoctrineCacheAdapter implements CacheInterface {

	private $doctrineCache;

	public function __construct(Cache $doctrineCache) {
		$this->doctrineCache = $doctrineCache;
	}



}
