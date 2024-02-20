<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

route::get('/employees',[EmployeeController::class,'index'])->name('employees.index');
route::get('/employees/create',[EmployeeController::class,'create'])->name('employees.create');
route::post('/employees',[EmployeeController::class,'store'])->name('employees.store');
route::get('/employees/{employ}/edit',[EmployeeController::class,'edit'])->name('employees.edit');
route::put('/employees/{employ}',[EmployeeController::class,'update'])->name('employees.update');
route::delete('/employees/{employ}',[EmployeeController::class,'destroy'])->name('employess.destroy');
