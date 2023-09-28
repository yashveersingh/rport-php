<?php

namespace yashveersingh\rportPHP\Helpers\Config;

abstract class ConfigEnvAbstract
{
    /**
     * @return string
     */
    protected abstract function getName(): string;

    private function getFromEnv(string $name): ?string
    {
        return config('rport.' . $name, null);
    }

    /**
     * @return string|null
     */
    function get(): string|null
    {
        return ($this->getFromEnv($this->getName()));
    }
}