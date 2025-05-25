<?php

namespace App\Apis;

use App\Apis\Helpers\HttpHeaders;
use App\Interfaces\DeliveryStrategy;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;


class ZrexpressDeliveryApi extends HttpHeaders implements DeliveryStrategy
{
    public $deliveryApiService;

    public function __construct()
    {
       parent::__construct(
            baseUrl: env('ZRURL') ?? '',
            headers: [
                'key' => env('ZRKEY') ?? '',
                'token' => env('ZRTOKEN') ?? ''
            ]
        );
    }

    public function createOrder(Order $order)
    {

        try {
            $response = $this->post('add_colis', [
                "Colis" => [[
                    'Tracking' => $order->id,
                    'TypeLivraison' => $order->delivery_method,
                    'TypeColis' => false,
                    "Confrimee" => "0", // 1 pour les colis Confirmer directement en pret a expedier
                    'Client' => $order->fullname,
                    'MobileA' => $order->client_phone,
                    'Adresse' => (($order->client_address . ',') ??  '') . $order->city->fr_name . ',' . $order->city->state->fr_name,
                    'IDWilaya' => $order->city->state->id,
                    'Commune' => $order->city->id,
                    'Total' => $order->totalNoDelivery,
                    "Note" => "",
                    'TProduit' => $order->products->first()->name_fr,
                    "id_Externe" => $order->id,  // Votre ID ou Tracking
                    "Source" => false
                ]]
            ]);
            if ($response->failed()) {
                Log::error("An error has occured when trying to access the route '" . $this->deliveryApiService?->url . "add_colis' for delivery service " . $this->deliveryApiService?->name);
                return false;
            } elseif ($response->successful()) {
                $result = json_decode($response, true);
                if ($result && array_key_exists('Colis', $result)) {
                    $colis = $result['Colis'][0];
                    if ((array_key_exists('COUNT', $result) && $result['COUNT'] == 1) &&
                    (array_key_exists('MessageRetour', $colis) && $colis['MessageRetour'] == 'Good')) {
                        return $colis['Tracking'];
                    } else return false;
                } else return false;
            }
        } catch (\Exception $e) {
            Log::error("An error has occured", [
                'file' => basename(__FILE__),
                'method' => __METHOD__,
                'message' => $e->getMessage()
            ]);
            return false;
        }
    }
    public function getOrders(array|Collection $orders)
    {


        try {
            $returnArray = [];
            foreach ($orders as $order) {
                if (! is_null($order->tracking_code)) {
                    $response = $this->post('lire', [
                            "Colis" => [[
                                'Tracking' => $order->tracking_code
                            ]]
                        ]);
                    if ($response->failed()) {
                        Log::error("An error has occured when trying to access the route '" . $this->deliveryApiService?->url . "lire' for delivery service " . $this->deliveryApiService?->name);
                        return false;
                    } elseif ($response->successful()) {
                        $result = json_decode($response, true);
                        if ($result && array_key_exists('Colis', $result)) {
                            $colis = $result['Colis'][0];
                            $matchingStatus = $this->matchStatus($colis['Situation']);
                            $returnArray[$colis['Tracking']] = $matchingStatus;
                        }
                    }
                }
            }
            return $returnArray;
        } catch (\Exception $e) {
            Log::error("An error has occured", [
                'file' => basename(__FILE__),
                'method' => __METHOD__,
                'message' => $e->getMessage()
            ]);
            return false;
        }
    }

    public function getPricing()
    {
        try {
            $response = $this->post('tarification');
            if ($response->failed()) {
                Log::error("An error has occured when trying to access the route '" . $this->deliveryApiService?->url . "lire' for delivery service " . $this->deliveryApiService?->name);
                return false;
            } elseif ($response->successful()) {
                return json_decode($response, true);
            }
            return false;
        } catch (\Exception $e) {
            Log::error("An error has occured", [
                'file' => basename(__FILE__),
                'method' => __METHOD__,
                'message' => $e->getMessage()
            ]);
            return false;
        }
    }

    private function matchStatus($status)
    {
        return match ($status) {
            'En Traitement - Prêt à Expédie',
            'En Préparation',
            'En Préparation - Reportée',
            'En Préparation - Confirmé',
            'Au Bureau',
            'En Préparation - Ne Réponde pas',
            'En Préparation - Message Envoyé',
            'SD - Reporté',
            'Sortir en livraison',
            'En livraison',
            'A Relancé' => Status::where('name','InDelivey')->first()->id,

            'SD - Appel sans Réponse 1',
            'SD - Appel sans Réponse 2',
            'SD - Appel sans Réponse 3',
            'SD - En Attente du Client',
            'Appel sans Réponse 1',
            'Appel sans Réponse 2',
            'Appel sans Réponse 3' => Status::where('name','Alert')->first()->id,

            'Retour Livreur',
            'Retour Navette',
            'Retour Client',
            'Restaurée',
            'Retour de Dispatche',
            'Retour Stock',
            'En Préparation - Annuler',
            'SD - Annuler par le Client',
            'SD - Annuler 3x',
            'Annuler par le Client',
            'Supprimée' => Status::where('name','Returned')->first()->id,

            'Livrée',
            'Livrée [ Encaisser ]',
            'Livrée [ Recouvert ]',
            'Dispatcher' =>Status::where('name','Delivered')->first()->id,

            default => null,
        };
    }
}
