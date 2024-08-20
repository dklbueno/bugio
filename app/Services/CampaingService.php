<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class CampaingService
{
    public static function getOwners($detail, $campaingId)
    {
        $owners = Cache::remember('campaing_owners_' . $campaingId, 60, function() use($detail, $campaingId) {
            $owners = [];
            foreach($detail['realty'] as $realty) {
                foreach($realty['owners'] as $owner) {
                    if(str_contains($owner['document_number'], '*')) {
                        continue;
                    }
                    $url = config('services.eemovel_agro.url') . "/campaing/{$campaingId}/owner";
                    $response = Http::withHeaders([
                                'x-api-key' => config('services.eemovel_agro.token')
                            ])->post($url, ['document' => $owner['document_number']]);

                    if($response->status() == 200) {
                        $data = $response->json()['data'];

                        $email = count($data['emails']) ? $data['emails'][0]['email'] : '';
                        $phone = count($data['phones']) ? $data['phones'][0]['phone_number'] : '';
                                        
                        $owners[] = [
                            'name' => $data['name'],
                            'email' => $email,
                            'phone' => $phone,
                            'document' => $data['document_number'],
                            'street' => count($data['addresses']) ? $data['addresses'][0]['street'] : '',
                            'city' => count($data['addresses']) ? $data['addresses'][0]['city'] : '',
                            'address_numner' => count($data['addresses']) ? $data['addresses'][0]['number'] : '',
                            'uf' => count($data['addresses']) ? $data['addresses'][0]['uf'] : ''
                        ];
                    }                
                }
            }

            return $owners;
        }); 
        
        return $owners;
    }
}