<?php

namespace yashveersingh\shellhubPHP\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use yashveersingh\rportPHP\Enum\RPortDeviceConnectionStateEnum;
use yashveersingh\rportPHP\Models\RPortDevice;

class RPortDeviceFactory extends Factory
{
    protected $model = RPortDevice::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'name' => $this->faker->randomNumber(6) . '-' . $this->faker->firstName,
            'client_auth_id' => $this->faker->randomNumber(6) . '-' . $this->faker->firstName,
            'disconnected_at' => $this->faker->dateTime(),
            'last_heartbeat_at' => $this->faker->dateTime(),
            'connection_state' => $this->faker->randomElement(RPortDeviceConnectionStateEnum::cases()),
            'ipv4' => [],
            'ipv6' => []
        ];
    }
}