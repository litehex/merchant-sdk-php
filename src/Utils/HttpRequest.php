<?php

namespace MerchantSDK\Utils;

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
     * @var string $raw_input Raw input
     */
    private string $raw_input;

    /**
     * @var array $headers HTTP Headers
     */
    private array $headers;

    /**
     * @var array $query String query
     */
    private array $query;

    /**
     * @var array $input This data will convert to JSON
     */
    private array $input;

    /**
     * HTTPRequest Constructor
     */
    public function __construct()
    {
        $this->headers = $this->input = $this->query = [];
        $this->raw_input = "";
    }

    /**
     * @param array $headers
     * @return HTTPRequest
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @param array $input
     * @return HTTPRequest
     */
    public function setJsonInput(array $input): self
    {
        $this->input = $input;
        return $this;
    }

    /**
     * @param string $input
     * @return HTTPRequest
     */
    public function setRawInput(string $input): self
    {
        $this->raw_input = $input;
        return $this;
    }

    /**
     * @param array $query
     * @return HTTPRequest
     */
    public function setStringQuery(array $query): self
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @param string $url
     * @return string|bool
     */
    public function sendRequest(string $url): string|bool
    {
        $queryString = http_build_query($this->query);
        if (!str_contains($url, "?")) {
            if ($queryString != "") $endPointUrl = $url . "?" . $queryString;
            else $endPointUrl = $url;
        } else $endPointUrl = $url . "&" . $queryString;
        $curl = curl_init($endPointUrl);

        $headers = [];
        foreach ($this->headers as $key => $value) {
            $headers[] = "$key: $value";
        }

        if ($this->input != [] || $this->raw_input != "") {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($this->input));
            $headers[] = "Content-Type: application/json";
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endPointUrl,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
        ));

        $response = curl_exec($curl);
        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) != 200) return false;
        curl_close($curl);

        return $response;
    }

}