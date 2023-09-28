<?php

namespace yashveersingh\rportPHP\Helpers\Config\Classes;

use yashveersingh\rportPHP\Helpers\Config\ConfigEnvAbstract;

class Username extends ConfigEnvAbstract
{

    /**
     * @inheritDoc
     */
    protected function getName(): string
    {
        return 'username';
    }
}