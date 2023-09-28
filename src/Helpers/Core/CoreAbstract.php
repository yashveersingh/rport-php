<?php

namespace yashveersingh\rportPHP\Helpers\Core;

use yashveersingh\rportPHP\Helpers\HttpClient\Exceptions\UnauthorizedException;

abstract class CoreAbstract
{
    protected ?array $responseData = null;

    /**
     * @return void
     */
    abstract function init(): void;

    /**
     * @return void
     */
    abstract protected function request(): void;

    /**
     * @return bool
     */
    abstract protected function process(): bool;

    /**
     * @return bool
     */
    public function execute(): bool
    {
        $this->init();
        try {
            $this->request();
        } catch (UnauthorizedException $e) {
            return false;
        }
        return $this->process();
    }
}