<?php

namespace yashveersingh\rportPHP\Requests\Classes;

class ServerStatus extends \yashveersingh\rportPHP\Requests\RequestAbstract
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
        return 'status';
    }
}