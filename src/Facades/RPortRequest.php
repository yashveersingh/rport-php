<?php

namespace yashveersingh\rportPHP\Facades;

use Illuminate\Support\Facades\Facade;

class RPortRequest extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'RPortRequest';
    }

}