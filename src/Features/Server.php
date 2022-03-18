<?php

namespace MerchantSDK\Features;

use MerchantSDK\Constants;
use MerchantSDK\Utils\HttpRequest;

/**
 * Server
 *
 * @link    https://github.com/litehex/merchant-sdk-php
 * @author  Shahrad Elahi <shahrad@litehex.com>
 * @license MIT
 */
class Server
{

    /**
     * This method is used to get the server ip address.
     *
     * @return string
     */
    public function IPAddress(): string
    {
        return (new HttpRequest())->sendRequest(Constants::API_BASE_URL . '/server');
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

}