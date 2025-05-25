<?php

namespace App\Apis\Helpers;

use Http;

abstract class HttpHeaders
{
    public function __construct(
        protected string $baseUrl,
        protected array $headers = []) {}

    public function get(string $endpoint, array $params = [])
    {
        return Http::withHeaders($this->headers)->acceptJson()->get($this->url($endpoint), $params);
    }

    public function post(string $endpoint, array $params = [])
    {
        return Http::withHeaders($this->headers)->acceptJson()->post($this->url($endpoint), $params);
    }

    public function delete(string $endpoint, array $params = [])
    {
        return Http::withHeaders($this->headers)->acceptJson()->delete($this->url($endpoint), $params);
    }

    private function url(string $endpoint)
    {
        return $this->baseUrl . $endpoint;
    }
}
