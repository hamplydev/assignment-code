<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/


// Dashboard
Route::get(
    '/', [DashboardController::class, 'index']
)->name('dashboard');



// Department
Route::get('/department', [DepartmentController::class, 'index'])->name('department.index');
Route::get('/department/create', [DepartmentController::class, 'create'])->name('department.create');
Route::post('/department/store', [DepartmentController::class, 'store'])->name('department.store');
Route::get('/department/show/{id}', [DepartmentController::class, 'show'])->name('department.show');
Route::get('/department/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
Route::put('/department/update/{id}', [DepartmentController::class, 'update'])->name('department.update');
Route::delete('/department/destroy/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');

Route::get('/dept-export-excel', [DepartmentController::class, 'exportToExcel'])->name('department.export-excel');
Route::get('/dept-list-export-csv', [DepartmentController::class, 'exportToCSV'])->name('department.export-csv');

// Position
Route::get('/position', [PositionController::class, 'index'])->name('position.index');
Route::get('/position/create', [PositionController::class, 'create'])->name('position.create');
Route::post('/position/store', [PositionController::class, 'store'])->name('position.store');
Route::get('/position/show/{id}', [PositionController::class, 'show'])->name('position.show');
Route::get('/position/edit/{id}', [PositionController::class, 'edit'])->name('position.edit');
Route::put('/position/update/{id}', [PositionController::class, 'update'])->name('position.update');
Route::delete('/position/destroy/{id}', [PositionController::class, 'destroy'])->name('position.destroy');

// Employee
Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('/employee/show/{id}', [EmployeeController::class, 'show'])->name('employee.show');
Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::put('/employee/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
Route::delete('/employee/destroy/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

// Export
Route::get('/employee/list-export-excel', [EmployeeController::class, 'exportToExcel'])->name('employee.list-export-excel');
Route::get('/employee/list-export-csv', [EmployeeController::class, 'exportToCSV'])->name('employee.list-export-csv');

// load data
Route::get('/employee/get-position/{id}', [EmployeeController::class, 'getPositionByDept'])->name('employee.position');
Route::get('/employee/list-search', [EmployeeController::class, 'listSearch'])->name('employee.list-search');

// Attendance
Route::get('/attendance/form', [AttendanceController::class, 'form'])->name('attendance.form');
Route::post('/attendance/checkin', [AttendanceController::class, 'checkin'])->name('attendance.checkin');
Route::post('/attendance/checkout', [AttendanceController::class, 'checkout'])->name('attendance.checkout');

Route::get('/daily-presents', [AttendanceController::class, 'rptDailyPresents'])->name('attendance.daily-presents');
Route::get('/monthly-presents', [AttendanceController::class, 'rptMonthlyPresents'])->name('attendance.monthly-presents');
// Export
Route::get('/daily-presents-excel', [AttendanceController::class, 'attDailyExcel'])->name('attendance.att-daily-excel');
Route::get('/daily-presents-csv', [AttendanceController::class, 'attDailyCSV'])->name('attendance.att-daily-csv');

Route::get('/monthly-presents-excel', [AttendanceController::class, 'attMonthlyExcel'])->name('attendance.att-monthly-excel');
Route::get('/monthly-presents-csv', [AttendanceController::class, 'att_monthly'])->name('attendance.att-monthly-csv');