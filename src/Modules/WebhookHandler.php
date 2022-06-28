<?php

namespace Litehex\MerchantSDK\Modules;

use Litehex\MerchantSDK\Interfaces\WebhookEvents;

/**
 * Webhook Handler class
 *
 * @link    https://github.com/litehex/merchant-sdk-php
 * @author  Shahrad Elahi <shahrad@litehex.com>
 * @license MIT
 */
abstract class WebhookHandler implements WebhookEvents
{

    /**
     * This method is called when a webhook is received, and it will call the appropriate method.
     *
     * @param string $type The type of webhook event
     * @param array $input If method found in class, it will be called with this array
     * @return void
     */
    public function handleUpdate(string $type, array $input): void
    {
        if ($type == "PING_WEBHOOK") $this->sendStatus();
        $method = $this->getUpdateType($type);
        if (method_exists($this, $method)) {
            $this->$method($input);
        }
    }

    /**
     * This method will return the method name of the update type
     *
     * @param string $type
     * @return string
     */
    private function getUpdateType(string $type): string
    {
        $result = "on";
        foreach (explode('_', $type) as $word) {
            $result .= ucfirst(strtolower($word));
        }
        return $result;
    }

    /**
     * This method is called when the webhook is successfully registered.
     *
     * @return void
     */
    private function sendStatus(): void
    {
        header('Content-Type: application/json');
        echo json_encode(['ok' => true, 'timestamp' => time()], JSON_PRETTY_PRINT);
        die(200);
    }

}