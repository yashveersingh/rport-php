<?php

namespace yashveersingh\rportPHP\Helpers\Config\Classes;

use yashveersingh\rportPHP\Helpers\Config\ConfigEnvAbstract;

class Url extends ConfigEnvAbstract
{
    /**
     * @return string
     */
    protected function getName(): string
    {
        return 'url';
    }
}