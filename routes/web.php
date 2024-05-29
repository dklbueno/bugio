<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampaingController;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CampaingExport;

Route::get('/export', function () {
    return Excel::download(new CampaingExport, 'campaings.xlsx');
});

Route::get('/campaings', [CampaingController::class, 'index'])->name('campaings.index');
