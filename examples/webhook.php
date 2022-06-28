<?php
require_once __DIR__ . '/vendor/autoload.php';

abstract class MyHandler extends \Litehex\MerchantSDK\WebhookHandler
{

	public function __construct(\Litehex\MerchantSDK\Api $API)
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

	public function onPaymentPartially(array $update): void
	{
		// TODO: Implement onPaymentPartiallyPaid() method.
	}

	public function onPaymentCompleted(array $update): void
	{
		// TODO: Implement onPaymentCompletePaid() method.
	}

}

$settings = [
	'ip_strict' => true, // Highly recommended
];

$MerchantSDK = new \Litehex\MerchantSDK\Api("493140774:a52d0f343000f2aeb773c6bd6233bd92");
$MerchantSDK->setupWebhook(MyHandler::class, $settings);