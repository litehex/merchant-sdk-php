<?php

namespace LiteHex\MerchantSDK\Features;

use LiteHex\MerchantSDK\Utils\ApiRequest;

/**
 * Products
 *
 * @link    https://github.com/litehex/merchant-sdk-php
 * @author  Shahrad Elahi <shahrad@litehex.com>
 * @license MIT
 */
class Products extends ApiRequest
{

    /**
     * Get Product
     *
     * @param string $productId
     * @return array
     */
    public function getProduct(string $productId): array
    {
        return parent::sendRequest('products/getProduct', [
            'id' => $productId
        ]);
    }

    /**
     * Get Products
     *
     * @param array $params
     * @return array
     */
    public function getProducts(array $params = []): array
    {
        return parent::sendRequest('products/getProducts', $params);
    }

    /**
     * Create Product
     *
     * @param array $params
     * @return array
     */
    public function createProduct(array $params): array
    {
        return parent::sendRequest('products/createProduct', $params);
    }

    /**
     * Update Product
     *
     * @param array $params
     * @return array
     */
    public function updateProduct(array $params): array
    {
        return parent::sendRequest('products/updateProduct', $params);
    }

    /**
     * Delete Product
     *
     * @param string $productId
     * @return array
     */
    public function deleteProduct(string $productId): array
    {
        return parent::sendRequest('products/deleteProduct', [
            'id' => $productId
        ]);
    }

}