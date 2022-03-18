<?php
require_once __DIR__ . '/vendor/autoload.php';

class MyHandler extends \MerchantSDK\Modules\WebhookHandler
{

    public function __construct(\MerchantSDK\Api $API)
    {
        // TODO: Initialize things here.
    }

    public function onPaymentExpired(array $update): void
    {
        // TODO: Implement onPaymentExpired() method.
    }

    public function onPaymentCancelled(array $update): void
    {
        // TODO: Implement onPaymentCancelled() method.
    }

    public function onPaymentPartiallyPaid(array $update): void
    {
        // TODO: Implement onPaymentPartiallyPaid() method.
    }

    public function onPaymentCompletePaid(array $update): void
    {
        // TODO: Implement onPaymentCompletePaid() method.
    }

}

$settings = [
    'ip_strict' => true, // Highly recommended
];

$TronGate = new \MerchantSDK\Api("493140774:a52d0f343000f2aeb773c6bd6233bd92");
$TronGate->setupWebhook(MyHandler::class, $settings);