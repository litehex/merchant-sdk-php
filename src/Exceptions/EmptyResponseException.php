<?php

namespace Litehex\MerchantSDK\Exceptions;

/**
 * Empty Response exception
 *
 * @link    https://github.com/litehex/merchant-sdk-php
 * @author  Shahrad Elahi <shahrad@litehex.com>
 * @license MIT
 */
class EmptyResponseException extends \Exception
{

	protected $message = 'Empty Response';

}