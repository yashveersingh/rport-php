<?php

namespace yashveersingh\rportPHP\Enum;

enum RPortDeviceConnectionStateEnum: int
{
    case disconnected = 1;
    case connected = 2;
}