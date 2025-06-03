<?php

namespace App\Services;

use App\Apis\ZrexpressDeliveryApi;
use App\Mail\ZrConfirmation;
use App\Models\Order;
use App\Models\State;
use App\Models\Status;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;

class DeliveryContext
{
    /**
     * @var DeliveryInterface
     */
    protected $deliveryInterface;

    public $deliveryApi;

    public function __construct($deliveryApi)
    {
        $this->deliveryApi = $deliveryApi;
        switch ($this->deliveryApi) {
            case 'Zrexpress':
                $this->deliveryInterface = new ZrexpressDeliveryApi();
                break;
            default:
                break;
        }
    }

    public function createOrder(Order $order)
    {
        $tracking = $this->deliveryInterface->createOrder($order);
        if ($tracking) {
            $order->tracking_code = $tracking;
            $order->save();
            $order->orderStatus()->create([
                'status_id' => Status::where('name', 'InDelivery')->first()->id
            ]);
            if ($order->client_email)
              Mail::to($order->client_email)->send(new ZrConfirmation($order));
            return true;
        }
        return false;
    }
    public function getOrders(array|Collection $orders)
    {
        $response = $this->deliveryInterface->getOrders($orders);
        if ($response) {
            if (is_array($response) && count($response)) {
                foreach ($response as $tracking => $statusId) {
                    $order = Order::where('tracking_code', $tracking)->first();
                    if ($statusId && $order && $statusId != $order?->latestStatus->status->id)
                        $order->orderStatus()->create([
                            'status_id' => $statusId
                        ]);
                }
                return true;
            }
        }
        return false;
    }

    public function getPricing()
    {
        $response = $this->deliveryInterface->getPricing();
        if ($response) {
            if (is_array($response) && count($response)) {
                foreach ($response as $state) {
                    $wilaya = State::find($state['IDWilaya']);
                    if ($state['Stopdesk'])
                    {
                        $wilaya->zr_stopdesk = $state['Stopdesk'];
                    }
                    if ($state['Domicile'])
                    {
                        $wilaya->zr_domicile = $state['Domicile'];
                    }
                    $wilaya->save();
                }
                return true;
            }
        }
        return false;
    }
}
