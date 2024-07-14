<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlacesController;
use App\Http\Controllers\RecommendationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', HomeController::class)->name('home');

Route::get('places/search/{searchTerm}', [PlacesController::class, 'search'])->name('places.search');

Route::get('empfehlungen/{place}', [RecommendationController::class, 'index'])->name('recommendations.index');
Route::get('empfehlungen/{place}/outfit', [RecommendationController::class, 'outfit'])->name('recommendations.outfit');
Route::get('empfehlungen/{place}/places', [RecommendationController::class, 'places'])->name('recommendations.places');
