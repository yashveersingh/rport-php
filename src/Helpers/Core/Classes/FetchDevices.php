<?php

namespace yashveersingh\rportPHP\Helpers\Core\Classes;

use Carbon\Carbon;
use Illuminate\Support\Str;
use yashveersingh\rportPHP\Enum\RPortDeviceConnectionStateEnum;
use yashveersingh\rportPHP\Facades\RPortRequest;
use yashveersingh\rportPHP\Helpers\Core\CoreAbstract;
use yashveersingh\rportPHP\Repositories\RPortDeviceRepository;

class FetchDevices extends CoreAbstract
{
    private RPortDeviceRepository $rportDeviceRepository;

    /**
     * @return void
     */
    function init(): void
    {
        $this->rportDeviceRepository = new RPortDeviceRepository();
    }

    /**
     * @return void
     */
    protected function request(): void
    {
        $request = RPortRequest::getClients();
        $request->filter();
        $this->responseData = $request->request();
    }

    /**
     * @return bool
     */
    protected function process(): bool
    {
        if (is_array($this->responseData) && isset($this->responseData['data']) && is_array($this->responseData['data'])) {
            foreach ($this->responseData['data'] as $responseData) {
                $this->rportDeviceRepository->createOrUpdate(
                    $responseData['id'],
                    $responseData['name'],
                    $responseData['client_auth_id'],
                    $responseData['disconnected_at'] ? Carbon::parse($responseData['disconnected_at'], 'UTC') : null,
                    $responseData['last_heartbeat_at'] ? Carbon::parse($responseData['last_heartbeat_at'], 'UTC') : null,
                    constant(RPortDeviceConnectionStateEnum::class . "::" . Str::lower($responseData['connection_state'])),
                    $responseData['ipv4'],
                    $responseData['ipv6']
                );
            }
            return true;
        }
        return false;
    }
}