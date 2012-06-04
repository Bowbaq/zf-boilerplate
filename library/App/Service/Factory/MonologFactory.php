<?php

namespace App\Service\Factory;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * A factory for Monolog loggers
 */
class MonologFactory {
	private $stream;
	
	public function __construct($path, $level = Logger::DEBUG)
	{
		$this->stream = new StreamHandler($path, $level);
	}
	
	public function logger($channel)
	{
		$logger = new Logger($channel);
        $logger->pushHandler($this->stream);
		
		return $logger;
	}
}
