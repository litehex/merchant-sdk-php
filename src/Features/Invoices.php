<?php

namespace LiteHex\MerchantSDK\Features;

use LiteHex\MerchantSDK\Utils\ApiRequest;

/**
 * Invoices
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
    public function getInvoice(string $invoiceId): array
    {
        return parent::sendRequest('invoices/getInvoice', [
            'id' => $invoiceId
        ]);
    }

    /**
     * Create Invoice
     *
     * @param array $params
     * @return array
     */
    public function createInvoice(array $params): array
    {
        return parent::sendRequest('invoices/createInvoice', $params);
    }

    /**
     * Update Invoice
     *
     * @param string $invoiceId
     * @param array $params
     * @return array
     */
    public function updateInvoice(string $invoiceId, array $params): array
    {
        return parent::sendRequest('invoices/updateInvoice', $params);
    }

    /**
     * Delete Invoice
     *
     * @param string $invoiceId
     * @return array
     */
    public function deleteInvoice(string $invoiceId): array
    {
        return parent::sendRequest('invoices/deleteInvoice', [
            'id' => $invoiceId
        ]);
    }

}