<?php

use App\Http\Controllers\ShowDataController;
use App\Http\Controllers\StudentImportController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('students', [ShowDataController::class, 'index'])->name('students.index');
Route::post('students', [StudentImportController::class, 'store'])->name('students.store');

//test mail pass
Route::get('send-mail', function () {
    $details = [
        'title' => 'Mail from a Laravel app',
        'body' => 'This is for testing email using smtp',
    ];

    Mail::to('test@example.com')->send(new \App\Mail\SendJobMail($details));

    dd("Email is Sent.");
})->name('sent.mail');
