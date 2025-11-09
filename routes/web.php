<?php

use App\Http\Controllers\money;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    $age=20;
    return view('home',['Age'=>$age]);
});

