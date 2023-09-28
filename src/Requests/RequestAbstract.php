<?php

namespace yashveersingh\rportPHP\Requests;

use yashveersingh\rportPHP\Helpers\HttpClient\HttpClient;

abstract class RequestAbstract
{
    private HttpClient $httpClient;
    protected array $data = [];
    private ?string $authorizationKey = null;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    abstract function getMethod(): string;

    abstract function getPath(): string;

    /**
     * @param string $username
     * @param string $password
     * @return void
     */
    protected function setBasicAuth(string $username, string $password): void
    {
        $this->httpClient->setBasicAuth($username, $password);
    }

    /**
     * @param array $data
     * @return RequestAbstract
     */
    public function setData(array $data): RequestAbstract
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return array|null
     */
    public function request(): ?array
    {
        return match ($this->getMethod()) {
            'get' => $this->httpClient->get($this->getPath(), $this->data),
            'post' => $this->httpClient->post($this->getPath(), $this->data),
            default => null,
        };
    }
}