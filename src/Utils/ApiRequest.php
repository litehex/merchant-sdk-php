<?php

namespace MerchantSDK\Utils;

use MerchantSDK\Constants;

/**
 * ApiRequest
 *
 * @link    https://github.com/shahradelahi/trongate-php
 * @author  Shahrad Elahi (https://github.com/shahradelahi)
 * @license https://github.com/shahradelahi/trongate-php/blob/master/LICENSE (MIT License)
 */
abstract class ApiRequest
{

    private static array $headers = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    ];

    /**
     * ApiRequest constructor.
     *
     * @param string $apiToken
     */
    public function __construct(string $apiToken)
    {
        self::$headers['X-MERCHANT-TOKEN'] = $apiToken;
        self::$headers['User-Agent'] = "LiteHex/MerchantSDK v" . Constants::VERSION;
    }

    /**
     * @param string $endpoint
     * @param array $query
     * @param array $input
     * @return array
     */
    protected static function sendRequest(string $endpoint, array $query = [], array $input = []): array
    {
        $queryString = http_build_query($query);

        $endPointUrl = Constants::MERCHANT_API_URL . $endpoint . "?" . $queryString;

        $curl = curl_init();

        $headers = [];
        foreach (self::$headers as $key => $value) {
            $headers[] = $key . ": " . $value;
        }

        if ($input != []) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($input));
            $headers[] = "Content-Type: application/json";
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endPointUrl,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }

}