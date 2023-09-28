<?php

namespace yashveersingh\shellhubPHP\database\migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('rport_devices', function (Blueprint $table) {
            $table->string('id', 190)->primary();
            $table->string('name', 190);
            $table->string('client_auth_id', 190);
            $table->dateTime('disconnected_at')->nullable();
            $table->dateTime('last_heartbeat_at')->nullable();
            $table->tinyInteger('connection_state');
            $table->json('ipv4');
            $table->json('ipv6');
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('rport_devices');
    }
};