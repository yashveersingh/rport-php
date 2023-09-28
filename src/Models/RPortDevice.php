<?php

namespace yashveersingh\rportPHP\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use yashveersingh\rportPHP\Enum\RPortDeviceConnectionStateEnum;
use yashveersingh\shellhubPHP\database\factories\RPortDeviceFactory;

class RPortDevice extends Model
{
    use HasFactory;

    /**
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return RPortDeviceFactory::new();
    }

    protected $table = 'rport_devices';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'client_auth_id',
        'disconnected_at',
        'last_heartbeat_at',
        'connection_state',
        'ipv4',
        'ipv6'
    ];
    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'client_auth_id' => 'string',
        'disconnected_at' => 'datetime',
        'last_heartbeat_at' => 'datetime',
        'connection_state' => RPortDeviceConnectionStateEnum::class,
        'ipv4' => 'array',
        'ipv6' => 'array'
    ];
}