<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;


Route::get('/', function () {
    return redirect('/employee');
});


Route::resource("/employee", EmployeeController::class);

