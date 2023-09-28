<?php

namespace yashveersingh\rportPHP\Helpers\Config\Classes;

use yashveersingh\rportPHP\Helpers\Config\ConfigEnvAbstract;

class Token extends ConfigEnvAbstract
{

    /**
     * @inheritDoc
     */
    protected function getName(): string
    {
        return 'token';
    }
}