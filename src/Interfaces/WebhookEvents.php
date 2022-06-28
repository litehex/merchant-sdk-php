<?php

namespace Litehex\MerchantSDK\Interfaces;

/**
 * Webhook Events class
 *
 * @link    https://github.com/litehex/merchant-sdk-php
 * @author  Shahrad Elahi <shahrad@litehex.com>
 * @license MIT
 */
interface WebhookEvents
{

	/**
	 * On Payment Expired
	 *
	 * @param array $update
	 * @return void
	 */
	public function onPaymentExpired(array $update): void;

	/**
	 * On Payment Refunded
	 *
	 * @param array $update
	 * @return void
	 */
	public function onPaymentRefunded(array $update): void;

	/**
	 * On Payment Failed
	 *
	 * @param array $update
	 * @return void
	 */
	public function onPaymentFailed(array $update): void;

	/**
	 * On Payment Cancelled
	 *
	 * @param array $update
	 * @return void
	 */
	public function onPaymentCancelled(array $update): void;

	/**
	 * On Payment Partially Paid
	 *
	 * @param array $update
	 * @return void
	 */
	public function onPaymentPartially(array $update): void;

	/**
	 * On Payment Complete Paid
	 *
	 * @param array $update
	 * @return void
	 */
	public function onPaymentCompleted(array $update): void;

}