<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampaingController;

Route::get('/export-owners', [CampaingController::class, 'exportOwners'])->name('export-owners');

Route::get('/campaing-owners', [CampaingController::class, 'owners'])->name('owners.index');