<?php

use App\Livewire\EditarMarxant;
use Illuminate\Support\Facades\Route;
use App\Livewire\HomePage;
use App\Livewire\FerMarxants;
use App\Http\Controllers\FileController;
use App\Livewire\EditParada;
use App\Livewire\IndicadorsPage;
// Ensure the MakeParada class exists at app/Livewire/MakeParada.php
use App\Livewire\MakeParada;
use App\Livewire\ParadasPage;

Route::get('/', HomePage::class);
Route::get('/fer-marxant', FerMarxants::class);
Route::get('/editar-marxant/{id}', EditarMarxant::class);
Route::get('/fer-parada', MakeParada::class);
Route::get('/editar-parada/{id}', EditParada::class);
Route::get('/paradas', ParadasPage::class);
Route::get('/fer-parada', MakeParada::class);
Route::get('/indicadors', IndicadorsPage::class);




