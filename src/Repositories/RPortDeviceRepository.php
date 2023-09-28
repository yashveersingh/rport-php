<?php

namespace yashveersingh\rportPHP\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use yashveersingh\rportPHP\Enum\RPortDeviceConnectionStateEnum;
use yashveersingh\rportPHP\Events\DeviceStatusChangedEvent;
use yashveersingh\rportPHP\Models\RPortDevice;

class RPortDeviceRepository
{
    /**
     * @return Collection
     */
    function gets(): Collection
    {
        $rows = RPortDevice::query();
        return $rows->get();
    }

    /**
     * @param string $id
     * @return RPortDevice|Model|null
     */
    function get(string $id): RPortDevice|Model|null
    {
        return RPortDevice::where('id', $id)->first();
    }

    /**
     * @param string $id
     * @param string $name
     * @param string $clientAuthId
     * @param Carbon|null $disconnectedAt
     * @param Carbon|null $lastHeartbeatAt
     * @param RPortDeviceConnectionStateEnum $rportDeviceConnectionStateEnum
     * @param array $ipv4
     * @param array $ipv6
     * @return RPortDevice|Model
     */
    function createOrUpdate(
        string                         $id,
        string                         $name,
        string                         $clientAuthId,
        ?Carbon                        $disconnectedAt,
        ?Carbon                        $lastHeartbeatAt,
        RPortDeviceConnectionStateEnum $rportDeviceConnectionStateEnum,
        array                          $ipv4,
        array                          $ipv6
    ): RPortDevice|Model
    {
        $row = $this->get($id);
        if (is_null($row)) {
            $row = new RPortDevice;
            $row->id = $id;
        }
        $row->name = $name;
        $row->client_auth_id = $clientAuthId;
        $row->disconnected_at = $disconnectedAt;
        $row->last_heartbeat_at = $lastHeartbeatAt;
        $row->connection_state = $rportDeviceConnectionStateEnum;
        $row->ipv4 = $ipv4;
        $row->ipv6 = $ipv6;
        $row->save();
        if (isset($row->getChanges()['connection_state']))
            event($row, RPortDeviceConnectionStateEnum::tryFrom($row->getChanges()['connection_state']));
        return $row;
    }

    /**
     * @param string|RPortDevice $id
     * @param Carbon $disconnectedAt
     * @param Carbon $lastHeartbeatAt
     * @param RPortDeviceConnectionStateEnum $rportDeviceConnectionStateEnum
     * @return void
     */
    function updateOnlineStatus(
        string|RPortDevice             $id,
        Carbon                         $disconnectedAt,
        Carbon                         $lastHeartbeatAt,
        RPortDeviceConnectionStateEnum $rportDeviceConnectionStateEnum
    ): void
    {
        if (!($id instanceof RPortDevice))
            $id = $this->get($id);
        $id->disconnected_at = $disconnectedAt;
        $id->last_heartbeat_at = $lastHeartbeatAt;
        $id->connection_state = $rportDeviceConnectionStateEnum;
        $id->save();
    }
}