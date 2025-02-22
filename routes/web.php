<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//route buat kirim email secara terpisah

Route::get('/test-email', function () {
    \Illuminate\Support\Facades\Mail::raw('Halo, ini email uji!', function ($message) {
        $message->to('prodevpit20@gmail.com')
                ->subject('Uji Coba Email');
    });
    return 'Email telah dikirim!';
});
