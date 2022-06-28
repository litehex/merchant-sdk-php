<?php

namespace Litehex\MerchantSDK\Features;

use Litehex\MerchantSDK\Utils\ApiRequest;

/**
 * Invoices class
 *
 * @link    https://github.com/litehex/merchant-sdk-php
 * @author  Shahrad Elahi <shahrad@litehex.com>
 * @license MIT
 */
class Invoices extends ApiRequest
{

	/**
	 * Get Invoice
	 *
	 * @param string $invoiceId
	 * @return array
	 */
	public function get(string $invoiceId): array
	{
		return parent::call('GET', "invoices/${$invoiceId}");
	}

	/**
	 * Scan for Invoices
	 *
	 * @param array $params
	 * @return array
	 */
	public function scan(array $params): array
	{
		return parent::call('POST', 'invoices/scan', [], $params);
	}

	/**
	 * Create Invoice
	 *
	 * @param array $params
	 * @return array
	 */
	public function create(array $params): array
	{
		return parent::call('POST', 'invoices/create', [], $params);
	}

	/**
	 * Update Invoice
	 *
	 * @param string $invoiceId
	 * @param array $params
	 * @return array
	 */
	public function update(string $invoiceId, array $params): array
	{
		return parent::call('POST', "invoices/${$invoiceId}/update", [], $params);
	}

	/**
	 * Delete Invoice
	 *
	 * @param string $invoiceId
	 * @return array
	 */
	public function delete(string $invoiceId): array
	{
		return parent::call('GET', "invoices/${$invoiceId}/delete");
	}

}