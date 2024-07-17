<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OwnersExport;
use App\Services\CampaingService;

class CampaingController extends Controller
{
    public function owners(Request $request)
    {
        $owners = [];
        $campaing_name = '';

        if($request->campaing_id) {
            $url = config('services.eemovel_agro.url') . "/campaing/{$request->campaing_id}/detail";
            $response = Http::withHeaders([
                        'x-api-key' => config('services.eemovel_agro.token')
                    ])->get($url);
            
            if ($response->successful()) {
                $detail = $response->json()['data'];
                $campaing_name = $detail['name'];
                $owners = CampaingService::getOwners($detail, $request->campaing_id);
            }            
        } 

        return view('owners.index', compact('campaing_name', 'owners'));
    }

    public function exportOwners()
    {
        return Excel::download(new OwnersExport, 'owners.xlsx');
    }    
}
