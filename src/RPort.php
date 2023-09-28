<?php

namespace yashveersingh\rportPHP;

use Illuminate\Database\Eloquent\Collection;
use yashveersingh\rportPHP\Repositories\RPortDeviceRepository;

class RPort
{
    private RPortDeviceRepository $rportDeviceRepository;

    public function __construct()
    {
        $this->rportDeviceRepository = new RPortDeviceRepository();
    }

    /**
     * @return array
     */
    function getDevices(): array
    {
        return $this->rportDeviceRepository->gets()->toArray();
    }
}