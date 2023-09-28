<?php

namespace yashveersingh\rportPHP\Helpers\HttpClient;

use yashveersingh\rportPHP\Helpers\HttpClient\Exceptions\MethodNotAllowedException;
use yashveersingh\rportPHP\Helpers\HttpClient\Exceptions\UnauthorizedException;

abstract class HttpClientAbstract
{
    protected string $url;

    /**
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
        $this->initialization();
    }

    /**
     * @return void
     */
    abstract function initialization(): void;

    /**
     * @param string $username
     * @param string $password
     * @return void
     */
    abstract function setBasicAuth(string $username, string $password): void;

    /**
     * @param string $path
     * @param array $data
     * @return array|null
     */
    abstract function get(string $path, array $data = []): ?array;

    /**
     * @param string $path
     * @param array $data
     * @return array|null
     */
    abstract function post(string $path, array $data = []): ?array;

    /**
     * @return void
     */
    protected function throwUnauthorized(): void
    {
        throw new UnauthorizedException();
    }

    /**
     * @return void
     */
    protected function throwMethodNotAllowed(): void
    {
        throw new MethodNotAllowedException();
    }
}