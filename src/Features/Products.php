<?php

namespace Litehex\MerchantSDK\Features;

use Litehex\MerchantSDK\Utils\ApiRequest;

/**
 * Products class
 *
 * @link    https://github.com/litehex/merchant-sdk-php
 * @author  Shahrad Elahi <shahrad@litehex.com>
 * @license MIT
 */
class Products extends ApiRequest
{

	/**
	 * Get a specific product
	 *
	 * @param string $productUuid
	 * @return array
	 */
	public function get(string $productUuid): array
	{
		return parent::call('GET', "products/${$productUuid}");
	}

	/**
	 * Scan in products
	 *
	 * @param array $params ["keyword", "page_size", "page", "sort_by" => "asc|desc", "sort_by_field" => "id|name|price|created_at|updated_at"]
	 * @return array
	 */
	public function scan(array $params = []): array
	{
		return parent::call('POST', 'products/scan', [], $params);
	}

	/**
	 * Create a Product
	 *
	 * @param array $params
	 * @return array
	 */
	public function create(array $params): array
	{
		return parent::call('POST', 'products/create', [], $params);
	}

	/**
	 * Update a specific product
	 *
	 * @param string $invoiceId
	 * @param array $params
	 * @return array
	 */
	public function update(string $invoiceId, array $params): array
	{
		return parent::call('POST', "products/${$invoiceId}/update", [], $params);
	}

	/**
	 * Delete a specific product
	 *
	 * @param string $productId
	 * @return array
	 */
	public function delete(string $productId): array
	{
		return parent::call('GET', "products/${$productId}/delete");
	}

}