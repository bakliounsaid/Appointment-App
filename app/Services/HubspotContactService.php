<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class HubspotContactService
{
    public function createContact(array $properties): Response
    {
        return Http::withToken(config('services.hubspot.access_token'))
            ->post('https://api.hubapi.com/crm/v3/objects/contacts', [
                'properties' => $properties,
            ]);
    }
}
