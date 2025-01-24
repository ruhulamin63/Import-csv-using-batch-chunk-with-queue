<?php

use App\Http\Controllers\ShowDataController;
use App\Http\Controllers\StudentImportController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('students-import', [StudentImportController::class, 'index'])->name('students.import.index');
Route::post('students-import', [StudentImportController::class, 'store'])->name('students.import.store');
Route::get('students', [ShowDataController::class, 'index'])->name('students.index');

//test mail pass
Route::get('send-mail', function () {
    $details = [
        'title' => 'Mail from a AmarSolution',
        'body' => 'This is for testing email using smtp',
    ];

    Mail::to('task@akaarit.com')->send(new \App\Mail\SendJobMail($details));

    dd("Email is Sent.");
})->name('sent.mail');
