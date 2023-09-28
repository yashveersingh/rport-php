<?php

namespace yashveersingh\rportPHP\Facades;

use Illuminate\Support\Facades\Facade;

class RPortConfig extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'RPortConfig';
    }
}