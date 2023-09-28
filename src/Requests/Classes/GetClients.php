<?php

namespace yashveersingh\rportPHP\Requests\Classes;

use yashveersingh\rportPHP\Requests\RequestAbstract;

class GetClients extends RequestAbstract
{
    /**
     * @return string
     */
    function getMethod(): string
    {
        return 'get';
    }

    /**
     * @return string
     */
    function getPath(): string
    {
        return 'clients';
    }

    /**
     * @param string $sort
     * @param int $limit
     * @param int $offset
     * @param string $fields
     * @return void
     */
    function filter(
        string $sort = 'name',
        int    $limit = 500,
        int    $offset = 0,
        string $fields = 'id,name,ipv4,ipv6,connection_state,disconnected_at,last_heartbeat_at,client_auth_id'
    ): void
    {
        $this->data = [
            'sort' => $sort,
            'page[limit]' => $limit,
            'page[offset]' => $offset,
            'fields[clients]' => $fields
        ];
    }
}