<?php

namespace MerchantSDK\Modules;

use MerchantSDK\Interfaces\WebhookEvents;

/**
 * Webhook Handler
 *
 * @link    https://github.com/litehex/merchant-sdk-php
 * @author  Shahrad Elahi <shahrad@litehex.com>
 * @license MIT
 */
abstract class WebhookHandler implements WebhookEvents
{

    /**
     * @param string $type
     * @param array $input
     * @return void
     */
    public function onReceiveUpdate(string $type, array $input): void
    {
        if ($type == "PING_WEBHOOK") $this->onWebhookStatus();
        ($this->getUpdateType($type))($input);
    }

    /**
     * @param string $type
     * @return string
     */
    private function getUpdateType(string $type): string
    {
        $res = "on";
        foreach (explode('_', $type) as $w) {
            $res .= ucfirst(strtolower($w));
        }
        return $res;
    }

    /**
     * This method is called when the webhook is successfully registered.
     *
     * @return void
     */
    private function onWebhookStatus(): void
    {
        header('Content-Type: application/json');
        echo json_encode(['ok' => true, 'timestamp' => time()], JSON_PRETTY_PRINT);
        die(200);
    }

}