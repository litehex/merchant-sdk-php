<?php

namespace MerchantSDK;

use MerchantSDK\Features\Invoices;
use MerchantSDK\Features\Products;
use MerchantSDK\Features\Server;
use MerchantSDK\Modules\WebhookHandler;

/**
 * Api
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
    private string $apiToken;

    /**
     * Api constructor.
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
     * @return Server
     */
    public function Server(): Server
    {
        return new Server();
    }

    /**
     * @param string $handler
     * @param array $settings
     */
    public function setupWebhookHandler(string $handler, array $settings = []): void
    {
        /** @var WebhookHandler $HandlerClass */
        $HandlerClass = new $handler($this);

        // If input wasn't empty, go ahead and initialize the handler
        if (($PHPInputs = file_get_contents('php://input')) != null) {

            // Check for the webhook settings
            if (isset($settings['ip_strict']) && $settings['ip_strict']) {
                if (!$this->Server()->validateConnection($_SERVER['REMOTE_ADDR'])) return;
            }

            // Decode the JSON and pass it to the handler
            $Decode = json_decode($PHPInputs, true);
            $HandlerClass->onReceiveUpdate($Decode['_'], $Decode['input']);

        }

    }

}