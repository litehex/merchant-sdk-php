<?php

namespace Litehex\MerchantSDK;

use EasyHttp\Client;
use Litehex\MerchantSDK\Features\Invoices;
use Litehex\MerchantSDK\Features\Products;
use Litehex\MerchantSDK\Features\Wallets;
use Litehex\MerchantSDK\Modules\WebhookHandler;

/**
 * Api class
 *
 * @link    https://github.com/litehex/merchant-sdk-php
 * @author  Shahrad Elahi <shahrad@litehex.com>
 * @license MIT
 */
class Api
{

	/**
	 * @var string
	 */
	public const VERSION = '1.0.0';

	/**
	 * @var string
	 */
	public const API_BASE_URL = 'https://api.litehex.com/';

	/**
	 * @var string
	 */
	public const MERCHANT_API_URL = self::API_BASE_URL . 'merchant/';

	/**
	 * @var string
	 */
	private string $apiToken;

	/**
	 * Api constructor.
	 *
	 * @param string $apiToken
	 */
	public function __construct(string $apiToken)
	{
		$this->apiToken = $apiToken;
	}

	/**
	 * @return Invoices
	 */
	public function Invoices(): Invoices
	{
		return new Invoices($this->apiToken);
	}

	/**
	 * @return Products
	 */
	public function Products(): Products
	{
		return new Products($this->apiToken);
	}

	/**
	 * @return Wallets
	 */
	public function Wallets(): Wallets
	{
		return new Wallets($this->apiToken);
	}

	/**
	 * This method is used to get the server ip address.
	 *
	 * @return string
	 */
	public function IPAddress(): string
	{
		$response =  (new Client())->get(self::API_BASE_URL . '/status');

		return json_decode($response->getBody(), true)['ip'];
	}

	/**
	 * By calling this method, you can validate webhook signature.
	 *
	 * @param string $ip Remote IP address (e.g. $_SERVER['REMOTE_ADDR'])
	 * @return bool
	 */
	public function validateConnection(string $ip): bool
	{
		return $this->IPAddress() == $ip;
	}

	/**
	 * @param string $handler
	 * @param array $settings
	 */
	public function setupWebhook(string $handler, array $settings = []): void
	{
		/** @var WebhookHandler $webhookHandler */
		$HandlerClass = new $handler($this);

		if (($PHPInputs = file_get_contents('php://input')) != null) {
			if (isset($settings['ip_strict']) && $settings['ip_strict']) {
				if (!$this->validateConnection($_SERVER['REMOTE_ADDR'])) return;
			}

			$Decode = json_decode($PHPInputs, true);
			$HandlerClass->handleUpdate($Decode['_'], $Decode['data']);
		}
	}

}