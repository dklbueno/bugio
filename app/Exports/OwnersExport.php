<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Services\CampaingService;

class OwnersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $campaingId = request()->campaing_id;

        $url = config('services.eemovel_agro.url') . "/campaing/{$campaingId}/detail";
        $response = Http::withHeaders([
                    'x-api-key' => config('services.eemovel_agro.token')
                ])->get($url);
        
        if ($response->successful()) {
            $detail = $response->json()['data'];
            $owners = CampaingService::getOwners($detail, $campaingId);

            $data = collect($owners)->map(function($owner) {
                return [
                    'name' => $owner['name'],
                    'email' => $owner['email'],
                    'document' => $owner['document'],
                    'city' => $owner['city'],
                    'uf' => $owner['uf'],
                    'street' => $owner['street'] . ', ' . $owner['address_numner'],
                    'phone' => $owner['phone']
                ];
            })->toArray();

            return new Collection($data);
        }

        return new Collection();
    }

    public function headings(): array
    {
        return [
            'Nome',
            'Email',
            'Documento',
            'Cidade',
            'UF',
            'Endereço',
            'Telefone'
        ];
    }
}
