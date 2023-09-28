<?php

namespace yashveersingh\rportPHP\Helpers\HttpClient\Clients;

use Illuminate\Support\Facades\Http;
use yashveersingh\rportPHP\Helpers\HttpClient\HttpClientAbstract;
use Illuminate\Http\Client\PendingRequest;

class DefaultClient extends HttpClientAbstract
{
    private PendingRequest $request;

    /**
     * @return void
     */
    function initialization(): void
    {
        $this->request = Http::baseUrl($this->url);
    }

    /**
     * @param string $path
     * @param array $data
     * @return array|null
     */
    function get(string $path, array $data = []): ?array
    {
        $response = $this->request->get($path, $data);
        if ($response->unauthorized())
            $this->throwUnauthorized();
        if ($response->status() === 405)
            $this->throwMethodNotAllowed();
        if ($response->ok())
            return $response->json();
        return null;
    }

    /**
     * @param string $path
     * @param array $data
     * @return array|null
     */
    function post(string $path, array $data = []): ?array
    {
        $response = $this->request->post($path, $data);
        if ($response->unauthorized())
            $this->throwUnauthorized();
        if ($response->status() === 405)
            $this->throwMethodNotAllowed();
        if ($response->ok())
            return $response->json();
        return null;
    }

    /**
     * @param string $username
     * @param string $password
     * @return void
     */
    function setBasicAuth(string $username, string $password): void
    {
        $this->request->withBasicAuth($username, $password);
    }
}