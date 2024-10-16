<?php

use App\Http\Controllers\AuthController;
use App\Http\Resources\RegisterRoundResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::middleware('auth:sanctum')
    ->group(function () {
        //LogOut
        Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
        //Profile
        Route::prefix('profile')->group(function () {
            Route::get('/', [\App\Http\Controllers\ProfileController::class, 'show'])->name('api.profile.show');
        });
        //Employee
        Route::prefix('employee')->group(function () {
            Route::get('/', [\App\Http\Controllers\EmployeeController::class, 'index'])->name('api.employee.index');
            Route::get('/{id}', [\App\Http\Controllers\EmployeeController::class, 'show'])->name('api.employee.show');
            //Route::post('/', [\App\Http\Controllers\EmployeeController::class, 'store'])->name('api.employee.store');
            //Route::put('/{id}', [\App\Http\Controllers\EmployeeController::class, 'update'])->name('api.employee.update');
        });
        //Place
        Route::prefix('place')->group(function () {
            Route::get('/places', [\App\Http\Controllers\PlaceController::class, 'places'])->name('api.place.places');
            Route::get('/user-place', [\App\Http\Controllers\PlaceController::class, 'user_place'])->name('api.place.user_place');
            Route::get('/elements', [\App\Http\Controllers\PlaceController::class, 'elements'])->name('api.place.elements');
        });
        //Branche
        Route::prefix('branche')->group(function () {
            Route::get('/branches', [\App\Http\Controllers\BrancheController::class, 'branches'])->name('api.branche.branches');
            Route::get('/user-branche', [\App\Http\Controllers\BrancheController::class, 'user_branche'])->name('api.branche.user_branche');
        });
        //Register Round
        Route::prefix('registerRound')->group(function () {
            Route::get('/', [\App\Http\Controllers\RegisterRoundController::class, 'index'])->name('api.registerRound.index');
            Route::get('/{id}', [\App\Http\Controllers\RegisterRoundController::class, 'show'])->name('api.registerRound.show');
            Route::post('/', [\App\Http\Controllers\RegisterRoundController::class, 'store'])->name('api.registerRound.store');
            Route::put('/{id}', [\App\Http\Controllers\RegisterRoundController::class, 'update'])->name('api.registerRound.update');
        });
        //Round
        Route::prefix('round')->group(function () {
            Route::post('/', [\App\Http\Controllers\RoundController::class, 'store'])->name('api.round.store');
        });
        //Register Novelty
        Route::prefix('registerNovelty')->group(function () {
            Route::get('/', [\App\Http\Controllers\NoveltyRegistrationController::class, 'index'])->name('api.registerNovelty.index');
            Route::get('/{id}', [\App\Http\Controllers\NoveltyRegistrationController::class, 'show'])->name('api.registerNovelty.show');
            Route::post('/', [\App\Http\Controllers\NoveltyRegistrationController::class, 'store'])->name('api.registerNovelty.store');
            Route::put('/{id}', [\App\Http\Controllers\NoveltyRegistrationController::class, 'update'])->name('api.registerNovelty.update');
        });
        //Novelty
        Route::prefix('novelty')->group(function () {
            Route::get('/', [\App\Http\Controllers\NoveltyController::class, 'index'])->name('api.novelty.index');
        });
        //User
        Route::prefix('user')->group(function () {
            Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('api.user.index');
        });
        //Register Visit
        Route::prefix('registerVisit')->group(function () {
            Route::get('/', [\App\Http\Controllers\RegistrationVisitController::class, 'index'])->name('api.registerVisit.index');
            Route::post('/', [\App\Http\Controllers\RegistrationVisitController::class, 'store'])->name('api.registerVisit.store');
            Route::get('/{id}', [\App\Http\Controllers\RegistrationVisitController::class, 'show'])->name('api.registerVisit.show');
            Route::put('/{id}', [\App\Http\Controllers\RegistrationVisitController::class, 'update'])->name('api.registerVisit.update');
        });
        //Visit
        Route::prefix('visit')->group(function () {
            Route::get('/', [\App\Http\Controllers\VisitController::class, 'index'])->name('api.visit.index');
            Route::get('/{id}', [\App\Http\Controllers\VisitController::class, 'show'])->name('api.visit.show');
            Route::post('/', [\App\Http\Controllers\VisitController::class, 'store'])->name('api.visit.store');
            Route::post('/search', [\App\Http\Controllers\VisitController::class, 'search'])->name('api.visit.search');
        });
        //Visit Car
        Route::prefix('visitCar')->group(function () {
            Route::get('/', [\App\Http\Controllers\VisitCarController::class, 'index'])->name('api.visitCar.index');
            Route::post('/', [\App\Http\Controllers\VisitCarController::class, 'store'])->name('api.visitCar.store');
            Route::post('/search', [\App\Http\Controllers\VisitCarController::class, 'search'])->name('api.visitCar.search');
            Route::get('/{id}', [\App\Http\Controllers\VisitCarController::class, 'show'])->name('api.visitCar.show');
        });
        //Maintenance Round
        Route::prefix('maintenanceRound')->group(function () {
            Route::get('/', [\App\Http\Controllers\MaintenanceRoundController::class, 'index'])->name('api.maintenanceRound.index');
            Route::post('/', [\App\Http\Controllers\MaintenanceRoundController::class, 'store'])->name('api.maintenanceRound.store');
            Route::post('/storeComplete', [\App\Http\Controllers\MaintenanceRoundController::class, 'store_complete'])->name('api.maintenanceRound.store_complete');
            Route::get('/{id}', [\App\Http\Controllers\MaintenanceRoundController::class, 'show'])->name('api.maintenanceRound.show');
            Route::put('/{id}', [\App\Http\Controllers\MaintenanceRoundController::class, 'update'])->name('api.maintenanceRound.update');
            Route::put('/updateComplete/{id}', [\App\Http\Controllers\MaintenanceRoundController::class, 'update_complete'])->name('api.maintenanceRound.update_complete');
        });
        //Maintenance Round Detail
        Route::prefix('maintenanceRoundDetail')->group(function () {
            Route::get('/', [\App\Http\Controllers\MaintenanceRoundDetailController::class, 'index'])->name('api.maintenanceRoundDetail.index');
            Route::post('/', [\App\Http\Controllers\MaintenanceRoundDetailController::class, 'store'])->name('api.maintenanceRoundDetail.store');
            Route::get('/{id}', [\App\Http\Controllers\MaintenanceRoundDetailController::class, 'show'])->name('api.maintenanceRoundDetail.show');
            Route::put('/{id}', [\App\Http\Controllers\MaintenanceRoundDetailController::class, 'update'])->name('api.maintenanceRoundDetail.update');
        });
        //Site
        Route::prefix('site')->group(function () {
            Route::get('/', [\App\Http\Controllers\SiteController::class, 'index'])->name('api.site.index');
            Route::get('/elements/{id}', [\App\Http\Controllers\SiteController::class, 'elements'])->name('api.site.elements');
            Route::post('/', [\App\Http\Controllers\SiteController::class, 'store'])->name('api.site.store');
            Route::get('/{id}', [\App\Http\Controllers\SiteController::class, 'show'])->name('api.site.show');
            Route::put('/{id}', [\App\Http\Controllers\SiteController::class, 'update'])->name('api.site.update');
        });
        //Element
        Route::prefix('element')->group(function () {
            Route::get('/', [\App\Http\Controllers\ElementController::class, 'index'])->name('api.element.index');
            Route::post('/', [\App\Http\Controllers\ElementController::class, 'store'])->name('api.element.store');
            Route::get('/{id}', [\App\Http\Controllers\ElementController::class, 'show'])->name('api.element.show');
            Route::put('/{id}', [\App\Http\Controllers\ElementController::class, 'update'])->name('api.element.update');
        });
        //Element Detail
        Route::prefix('elementDetail')->group(function () {
            Route::get('/', [\App\Http\Controllers\ElementDetailController::class, 'index'])->name('api.elementDetail.index');
            Route::post('/', [\App\Http\Controllers\ElementDetailController::class, 'store'])->name('api.elementDetail.store');
            Route::get('/{id}', [\App\Http\Controllers\ElementDetailController::class, 'show'])->name('api.elementDetail.show');
            Route::put('/{id}', [\App\Http\Controllers\ElementDetailController::class, 'update'])->name('api.elementDetail.update');
        });
        //Work Orders
        Route::prefix('workOrder')->group(function () {
            Route::get('/', [\App\Http\Controllers\WorkOrderController::class, 'index'])->name('api.workOrder.index');
            Route::post('/', [\App\Http\Controllers\WorkOrderController::class, 'store'])->name('api.workOrder.store');
            Route::get('/{id}', [\App\Http\Controllers\WorkOrderController::class, 'show'])->name('api.workOrder.show');
            Route::put('/{id}', [\App\Http\Controllers\WorkOrderController::class, 'update'])->name('api.workOrder.update');
            Route::put('/closed/{id}', [\App\Http\Controllers\WorkOrderController::class, 'closed'])->name('api.workOrder.closed');
            Route::put('/add/{id}', [\App\Http\Controllers\WorkOrderController::class, 'add'])->name('api.workOrder.add');
        });
        //Work Order Detail
        Route::prefix('workOrderDetail')->group(function () {
            Route::get('/', [\App\Http\Controllers\WorkOrderDetailController::class, 'index'])->name('api.workOrderDetail.index');
            Route::post('/', [\App\Http\Controllers\WorkOrderDetailController::class, 'store'])->name('api.workOrderDetail.store');
            Route::get('/{id}', [\App\Http\Controllers\WorkOrderDetailController::class, 'show'])->name('api.workOrderDetail.show');
            Route::put('/{id}', [\App\Http\Controllers\WorkOrderDetailController::class, 'update'])->name('api.workOrderDetail.update');
        });
        //Employee Work Order
        Route::prefix('employeeWorkOrder')->group(function () {
            Route::get('/', [\App\Http\Controllers\EmployeeWorkOrderController::class, 'index'])->name('api.employeeWorkOrder.index');
            Route::post('/', [\App\Http\Controllers\EmployeeWorkOrderController::class, 'store'])->name('api.employeeWorkOrder.store');
            Route::get('/{id}', [\App\Http\Controllers\EmployeeWorkOrderController::class, 'show'])->name('api.employeeWorkOrder.show');
            Route::put('/{id}', [\App\Http\Controllers\EmployeeWorkOrderController::class, 'update'])->name('api.employeeWorkOrder.update');
        });
        //Scheduled Maintenance
        Route::prefix('scheduledMaintenance')->group(function () {
            Route::get('/', [\App\Http\Controllers\ScheduledMaintenanceController::class, 'index'])->name('api.scheduledMaintenance.index');
            Route::post('/', [\App\Http\Controllers\ScheduledMaintenanceController::class, 'store'])->name('api.scheduledMaintenance.store');
            Route::get('/{id}', [\App\Http\Controllers\ScheduledMaintenanceController::class, 'show'])->name('api.scheduledMaintenance.show');
            Route::put('/{id}', [\App\Http\Controllers\ScheduledMaintenanceController::class, 'update'])->name('api.scheduledMaintenance.update');
        });
        //Scheduled Maintenance Employee
        Route::prefix('scheduledMaintenanceEmployee')->group(function () {
            Route::get('/', [\App\Http\Controllers\ScheduledMaintenanceEmployeeController::class, 'index'])->name('api.scheduledMaintenanceEmployee.index');
            Route::post('/', [\App\Http\Controllers\ScheduledMaintenanceEmployeeController::class, 'store'])->name('api.scheduledMaintenanceEmployee.store');
            Route::get('/{id}', [\App\Http\Controllers\ScheduledMaintenanceEmployeeController::class, 'show'])->name('api.scheduledMaintenanceEmployee.show');
            Route::put('/{id}', [\App\Http\Controllers\ScheduledMaintenanceEmployeeController::class, 'update'])->name('api.scheduledMaintenanceEmployee.update');
        });
    });
//Access
Route::prefix('access')->group(function () {
    Route::post('/set-in', [\App\Http\Controllers\AccessController::class, 'setIn'])->name('api.access.setIn');
    Route::post('/set-out', [\App\Http\Controllers\AccessController::class, 'setOut'])->name('api.access.setOut');
});
