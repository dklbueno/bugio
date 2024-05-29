<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CampaingController extends Controller
{
    public function index()
    {
        $campaings = Http::withHeaders([
            'x-api-key' => config('services.eemovel_agro.token')
        ])->get(config('services.eemovel_agro.url') . '/campaing')['data'];

        return view('campaing.index', compact('campaings'));
    }
}
