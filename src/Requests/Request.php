<?php

namespace yashveersingh\rportPHP\Requests;

use yashveersingh\rportPHP\Helpers\HttpClient\HttpClient;
use yashveersingh\rportPHP\Requests\Classes\CurrentLoggedIn;
use yashveersingh\rportPHP\Requests\Classes\GetClients;
use yashveersingh\rportPHP\Requests\Classes\ServerStatus;

class Request
{
    private HttpClient $httpClient;

    public function __construct(string $url, string $username, string $password)
    {
        $this->httpClient = new HttpClient($url);
        $this->httpClient->setBasicAuth($username, $password);
    }

    /**
     * @param string $class
     * @return RequestAbstract
     */
    private function getClass(string $class): RequestAbstract
    {
        return new $class($this->httpClient);
    }

    /**
     * @return RequestAbstract
     */
    function serverStatus(): RequestAbstract
    {
        return $this->getClass(ServerStatus::class);
    }

    /**
     * @return RequestAbstract
     */
    function currentLoggedIn(): RequestAbstract
    {
        return $this->getClass(CurrentLoggedIn::class);
    }

    /**
     * @param string $sort
     * @param int $limit
     * @param int $offset
     * @param string $fields
     * @return RequestAbstract
     */
    function getClients(
        string $sort = 'name',
        int    $limit = 500,
        int    $offset = 0,
        string $fields = 'id,name,ipv4,ipv6,connection_state,disconnected_at,last_heartbeat_at,client_auth_id'
    ): RequestAbstract
    {
        return $this->getClass(GetClients::class);
    }
}