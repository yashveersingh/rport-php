<?php

namespace yashveersingh\rportPHP\Helpers\HttpClient;

class HttpClient
{
    private HttpClientAbstract $httpClientAbstract;

    public function __construct(string $baseUrl, string $class = __NAMESPACE__ . '\Clients\DefaultClient')
    {
        $this->httpClientAbstract = new $class($baseUrl);
    }

    /**
     * @param string $username
     * @param string $password
     * @return void
     */
    function setBasicAuth(string $username, string $password)
    {
        $this->httpClientAbstract->setBasicAuth($username, $password);
    }

    /**
     * @param string $path
     * @param array $data
     * @return array|null
     */
    function get(string $path, array $data): ?array
    {
        return $this->httpClientAbstract->get($path, $data);
    }

    /**
     * @param string $path
     * @param array $data
     * @return array|null
     */
    function post(string $path, array $data): ?array
    {
        return $this->httpClientAbstract->post($path, $data);
    }

}