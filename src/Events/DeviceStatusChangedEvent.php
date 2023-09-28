<?php

namespace yashveersingh\rportPHP\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use yashveersingh\rportPHP\Enum\RPortDeviceConnectionStateEnum;
use yashveersingh\rportPHP\Models\RPortDevice;

class DeviceStatusChangedEvent
{
    use Dispatchable, SerializesModels;

    public array $rportDevice;
    public RPortDeviceConnectionStateEnum $rportDeviceConnectionStateEnum;

    public function __construct(RPortDevice|Model $rportDevice, RPortDeviceConnectionStateEnum $rportDeviceConnectionStateEnum)
    {
        $this->rportDevice = $rportDevice->toArray();
        $this->rportDeviceConnectionStateEnum = $rportDeviceConnectionStateEnum;
    }
}