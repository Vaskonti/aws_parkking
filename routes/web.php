<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::post('/register-car', function () {
    $data = request()->validate([
        'make' => 'required',
        'model' => 'required',
        'year' => 'required|integer',
        'category' => 'required',
    ]);

    $car = new \App\Models\Car($data);
    $car->save();

    return redirect('/');
});

Route::get('/healthcheck', function () {
    return view('healthcheck');
});

Route::get('/discount-cards', function () {
    return view('discount-cards', [
        'discountCards' => \App\Models\DiscountCard::all(),
    ]);
});
