<?php

namespace LiteHex\MerchantSDK\Interfaces;

/**
 * Webhook Events
 *
 * @link    https://github.com/litehex/merchant-sdk-php
 * @author  Shahrad Elahi <shahrad@litehex.com>
 * @license MIT
 */
interface WebhookEvents
{

    public function onPaymentExpired(array $update): void;

    public function onPaymentCancelled(array $update): void;

    public function onPaymentPartiallyPaid(array $update): void;

    public function onPaymentCompletePaid(array $update): void;

}