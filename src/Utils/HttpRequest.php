<?php

namespace LiteHex\MerchantSDK\Utils;

/**
 * Http Request
 *
 * @link    https://github.com/litehex/merchant-sdk-php
 * @author  Shahrad Elahi <shahrad@litehex.com>
 * @license MIT
 */
class HttpRequest
{

    /**
     * @var array
     */
    private array $headers;

    /**
     * @var array
     */
    private array $query;

    /**
     * @var string
     */
    private string $input;

    /**
     * Http Request Constructor
     */
    public function __construct(array $headers = [], array $queries = [])
    {
        $this->headers = $headers ?? [];
        $this->query = $queries ?? [];
    }

    /**
     * @param array $headers
     * @return HttpRequest
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @param string $input
     * @return HttpRequest
     */
    public function setInput(string $input): self
    {
        $this->input = $input;
        return $this;
    }

    /**
     * @param array $query
     * @return HttpRequest
     */
    public function setQueries(array $query): self
    {
        $this->query = $query;
        return $this;
    }

    public function sendRequest(string $url): string
    {
        $queryString = http_build_query($this->query);
        $endPoint = $url . "?" . $queryString;
        $curl = curl_init($endPoint);

        $headers = [];
        foreach ($this->headers as $key => $value) {
            $headers[] = "$key: $value";
        }

        if ($this->input != []) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $this->input);
            $headers[] = "Content-Type: application/json";
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endPoint,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

}