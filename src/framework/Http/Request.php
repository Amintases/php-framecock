<?php

namespace Framework\Http;

class Request
{
	public function __construct(
		private readonly array $getParams,
		private readonly array $postData,
		private readonly array $cookie,
		private readonly array $files,
		public readonly array $server
	){

	}

	public static function createFromGlobals(): static
	{
		return new static($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
	}
}