<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CampaingExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $response = Http::withHeaders([
            'x-api-key' => config('services.eemovel_agro.token')
        ])->get(config('services.eemovel_agro.url') . '/campaing');
        
        if ($response->successful()) {
            $data = collect($response->json()['data'])->map(function($res) {
                return [
                    'id' => $res['id'],
                    'name' => $res['name'],
                    'realty_count' => '' . $res['realty_count'] . '',
                    'silo_count' => '' . $res['silo_count'] . ''
                ];
            })->toArray();
            return new Collection($data);
        }

        return new Collection();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nome',
            'Contagem Imobiliária',
            'Contagem de Silos'
        ];
    }
}
