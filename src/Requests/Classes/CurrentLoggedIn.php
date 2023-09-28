<?php

namespace yashveersingh\rportPHP\Requests\Classes;

use yashveersingh\rportPHP\Requests\RequestAbstract;

class CurrentLoggedIn extends RequestAbstract
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
        return 'me';
    }
}