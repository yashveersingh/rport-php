<?php

namespace yashveersingh\rportPHP\Helpers\Config;

use ReflectionClass;
use ReflectionException;
use yashveersingh\rportPHP\Helpers\Config\Classes\Token;
use yashveersingh\rportPHP\Helpers\Config\Classes\Url;
use yashveersingh\rportPHP\Helpers\Config\Classes\Username;

class Config
{
    /**
     * @param string $class
     * @return ConfigEnvAbstract|null
     */
    private function getClass(string $class): ConfigEnvAbstract|null
    {
        try {
            $reflection = new ReflectionClass($class);
            if ($reflection->isSubclassOf(ConfigEnvAbstract::class))
                return new $class();
        } catch (ReflectionException $e) {
        }
        return null;
    }

    /**
     * @return ConfigEnvAbstract
     */
    function url(): ConfigEnvAbstract
    {
        return $this->getClass(Url::class);
    }

    /**
     * @return ConfigEnvAbstract
     */
    function username(): ConfigEnvAbstract
    {
        return $this->getClass(Username::class);
    }

    /**
     * @return ConfigEnvAbstract
     */
    function token(): ConfigEnvAbstract
    {
        return $this->getClass(Token::class);
    }
}