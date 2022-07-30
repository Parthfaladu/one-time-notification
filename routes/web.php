<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\User\UserController;

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

Route::redirect("/", "/user");

//user routes
Route::get("/user", [UserController::class, "userList"])->name("user-list");
Route::get("/user/dt", [UserController::class, "userDt"]);
Route::get("/user/dashboard/{user_id}", [UserController::class, "userDashboard"])->name("user-dashboard");

Route::get("/user/{user}", [UserController::class, "userSettings"]);
Route::put("/user/{user}", [UserController::class, "updateUserSettings"]);

// notification routes
Route::get("/notification", [NotificationController::class, "notificationList"])->name("notification-list");
Route::get("/notification/dt", [NotificationController::class, "notificationDt"]);
Route::get("/user/notifications/{user_id}", [NotificationController::class, "userNotifications"]);

Route::get("/notification/create", [NotificationController::class, "postNotification"])->name("notification-post");
Route::post("/notification", [NotificationController::class, "createNotification"]);

Route::post("/notification/{notification}/mark-as-read", [NotificationController::class, "markAsReadNotification"]);
