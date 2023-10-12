<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/test/{experience}', [\App\Http\Controllers\TestController::class, 'generate']);
Route::redirect('/', '/login');


require __DIR__ . '/auth.php';

Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'getAttendanceTime'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // dashboard

    Route::get('appply_leave', [\App\Http\Controllers\LeaveController::class, 'apply_leave'])->name('apply_leave');
    // users
    Route::get('all-users', [\App\Http\Controllers\UsersController::class, 'all_users']);
    Route::any('add-employee-user', [\App\Http\Controllers\UsersController::class, 'adduserEmployee']);
    // employees
    Route::any('all-employees', [\App\Http\Controllers\EmployeeController::class, 'index']);
    Route::any('add-employee', [\App\Http\Controllers\EmployeeController::class, 'addEmployee']);
    Route::get('employee/profile/{id}', [\App\Http\Controllers\EmployeeController::class, 'employee_profile'])->name('employee_profile');
    Route::any('edit/employee/{id}', [\App\http\Controllers\EmployeeController::class, 'editEmployee']);
    Route::post('update/employee', [\App\http\Controllers\EmployeeController::class, 'updateEmployee']);
    // Attendences
    Route::any('checkin', [\App\Http\Controllers\AttendanceController::class, 'checkin']);

    Route::get('attendance-list', [\App\Http\Controllers\AttendanceController::class, 'getAllAttendances']);
    Route::any('mark-manual-attendance', [\App\Http\Controllers\AttendanceController::class, 'markManualAttendance']);
    Route::any('upload-attendance', [\App\Http\Controllers\AttendanceController::class, 'SaveUploadAttendance']);
    //Leaves
    Route::any('leaves', [\App\Http\Controllers\LeaveController::class, 'index']);
    Route::post('add-leave', [\App\Http\Controllers\LeaveController::class, 'addLeave']);


    Route::any('approve-leave/{id}', [\App\Http\Controllers\LeaveController::class, 'approveLeave']);
    Route::any('reject-leave/{id}', [\App\Http\Controllers\LeaveController::class, 'rejectLeave']);
    Route::post('leave/delete',[\App\Http\Controllers\LeaveController::class, 'deleteLeave'])->name('delete-leave');

    Route::any('employee_stats', [\App\Http\Controllers\EmployeeController::class, 'employee_stats'])->name('employee_stats');
    Route::get('employee_stats_edit/{id}', [\App\Http\Controllers\EmployeeController::class, 'edit_emp_stat'])->name('employee_stats_edit');
    Route::post('update/employee_stat', [\App\http\Controllers\EmployeeController::class, 'update_emp_stat']);



    // resources routes
    Route::resources([
        'designations' => DesignationController::class,
        'departments' => DepartmentController::class,
        'roles' => RoleController::class,
        'permissions' => PermissionController::class,
        'posts' => PostController::class
    ]);

});


//Demo Routes

// main group
// Route::group(['middleware' => 'auth'], function () {
//     // sub group
//     Route::group([
//         'prefix' => 'admin',
//         'middleware' => 'is_admin',
//         'as' => 'admin.'
//     ], function () {
//         Route::get('users', [\App\Http\Controllers\UsersController::class, 'index'])->name('users');
//     });
//     //Sub group for prefix
//     Route::group([
//         'prefix' => 'user',
//         'as' => 'user.',
//     ], function () {
//         Route::post('posts', [\App\Http\Controllers\AttendanceController::class, 'new'])->name('posts');
//     });
// });
