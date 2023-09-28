<?php

namespace yashveersingh\rportPHP\Facades;

use Illuminate\Support\Facades\Facade;

class RPort extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'RPort';
    }
}