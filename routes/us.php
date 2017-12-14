<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('use')->user();

    //dd($users);

    return view('use.home');
})->name('home');

