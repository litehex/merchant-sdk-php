<?php

namespace Litehex\MerchantSDK\Utils;

use EasyHttp\Client;
use Litehex\MerchantSDK\Api;

/**
 * ApiRequest class
 *
 * @link    https://github.com/shahradelahi/trongate-php
 * @author  Shahrad Elahi (https://github.com/shahradelahi)
 * @license https://github.com/shahradelahi/trongate-php/blob/master/LICENSE (MIT License)
 */
abstract class ApiRequest
{

	/**
	 * THe default HTTP headers to be sent with each request.
	 *
	 * @var array|string[]
	 */
	private static array $headers = [
		'Accept' => 'application/json',
		'Content-Type' => 'application/json'
	];

	/**
	 * ApiRequest constructor.
	 *
	 * @param string $apiToken
	 */
	public function __construct(string $apiToken)
	{
		self::$headers['X-API-KEY'] = $apiToken;
		self::$headers['User-Agent'] = "LiteHex/MerchantSDK v" . Api::VERSION . " (PHP " . PHP_VERSION . ")";
	}

	/**
	 * @param string $method
	 * @param string $endpoint
	 * @param array $query
	 * @param ?array $input
	 * @return array
	 */
	protected static function call(string $method, string $endpoint, array $query = [], ?array $input = null): array
	{
		$response = (new Client())->request($method, Api::MERCHANT_API_URL . $endpoint, [
			'headers' => self::$headers,
			'query' => $query,
			'body' => $input
		]);

		return json_decode($response->getBody(), true);
	}

}