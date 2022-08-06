<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCourierController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\Admin\AdminFeedbackController;
use App\Http\Controllers\Controller;
use App\Helper\Helper;


Route::get('/', [Controller::class, 'index'])->name('main');
Route::post('feedback', [Controller::class, 'feedback'])->name('feedback');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:sanctum'], function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.main');

    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('profile/edit', [AdminController::class, 'edit'])->name('admin.profile.edit');
    Route::post('profile/update', [AdminController::class, 'update'])->name('admin.profile.update');

    Route::get('users', [AdminUserController::class, 'index'])->name('admin.users');
    Route::get('users/{user}/show', [AdminUserController::class, 'show'])->name('admin.users.show');
    Route::get('users/{user}/reset-password', [AdminUserController::class, 'resetPassword'])->name('admin.users.reset-password');
    Route::post('users/{user}/reset-password/submit', [AdminUserController::class, 'resetPasswordSubmit'])->name('admin.users.reset-password.submit');
    Route::get('users/{user}/delete', [AdminUserController::class, 'destroy'])->name('admin.users.delete');
    Route::post('users/all/submit', [AdminUserController::class, 'submit'])->name('admin.users.submit');
//    Route::resource('users', AdminUserController::class)->except([
//        'index', 'show', 'destroy'
//    ]);

    Route::get('couriers', [AdminCourierController::class, 'index'])->name('admin.couriers');
    Route::get('couriers/create', [AdminCourierController::class, 'create'])->name('admin.couriers.create');
    Route::post('couriers/store', [AdminCourierController::class, 'store'])->name('admin.couriers.store');
    Route::get('couriers/{courier}/show', [AdminCourierController::class, 'show'])->name('admin.couriers.show');
    Route::get('couriers/{courier}/edit', [AdminCourierController::class, 'edit'])->name('admin.couriers.edit');
    Route::post('couriers/{courier}/update', [AdminCourierController::class, 'update'])->name('admin.couriers.update');
    Route::get('couriers/{courier}/delete', [AdminCourierController::class, 'destroy'])->name('admin.couriers.delete');
    Route::post('couriers/all/submit', [AdminCourierController::class, 'submit'])->name('admin.couriers.submit');

    Route::get('orders', [AdminOrderController::class, 'index'])->name('admin.orders');
    Route::get('orders/{order}/show', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::get('orders/{order}/delete', [AdminOrderController::class, 'destroy'])->name('admin.orders.delete');
    Route::post('orders/all/submit', [AdminOrderController::class, 'submit'])->name('admin.orders.submit');

    Route::get('feedbacks', [AdminFeedbackController::class, 'index'])->name('admin.feedbacks');
    Route::get('feedbacks/{feedback}/show', [AdminFeedbackController::class, 'show'])->name('admin.feedbacks.show');
    Route::get('feedbacks/{feedback}/delete', [AdminFeedbackController::class, 'destroy'])->name('admin.feedbacks.delete');
    Route::post('feedbacks/all/submit', [AdminFeedbackController::class, 'submit'])->name('admin.feedbacks.submit');
});

// Route::get('/send-request', function () {
//     $response = \Illuminate\Support\Facades\Http::post('kenguru-2/api/registration/1', [
//         "full_name" => "Nurbolat Abdraim",
//         "email" => "nurlight05@gmail.com",
//         "birthday" => "16-06-1999",
//         "phone" => "77087060890",
//         "password" => "password"
//     ]);

//    echo $response;
// });

Route::prefix('api')->group(function() {
    Route::match(['post', 'get'], 'registration/1', [AdminUserController::class, 'registrationFirst']);
    Route::match(['post', 'get'], 'registration/2', [AdminUserController::class, 'registrationSecond']);
    Route::match(['post', 'get'], 'resend', [AdminUserController::class, 'resendCode']);
    Route::match(['post', 'get'], 'login', [AdminUserController::class, 'login']);
    Route::match(['post', 'get'], 'profile/edit', [AdminUserController::class, 'editProfile']);
    Route::match(['post', 'get'], 'order', [AdminOrderController::class, 'store']);
    Route::match(['post', 'get'], 'order-details', [AdminOrderController::class, 'getOrder']);
    Route::match(['post', 'get'], 'all-orders', [AdminOrderController::class, 'getAllOrders']);
    Route::match(['post', 'get'], 'payment', [AdminPaymentController::class, 'store']);
    Route::match(['post', 'get'], 'couriers/registration/1', [AdminCourierController::class, 'registrationFirst']);
    Route::match(['post', 'get'], 'couriers/registration/2', [AdminCourierController::class, 'registrationSecond']);
    Route::match(['post', 'get'], 'couriers/resend', [AdminCourierController::class, 'resendCode']);
    Route::match(['post', 'get'], 'couriers/login', [AdminCourierController::class, 'login']);
    Route::match(['post', 'get'], 'courier/orders/all', [AdminCourierController::class, 'getAllOrders']);
    Route::match(['post', 'get'], 'courier/orders/accepted', [AdminCourierController::class, 'getAcceptedOrders']);
    Route::match(['post', 'get'], 'courier/orders/order', [AdminCourierController::class, 'getOrder']);
    Route::match(['post', 'get'], 'courier/orders/order/accept', [AdminCourierController::class, 'acceptOrder']);
});

// Route::get('test', function() {
//     $res = Helper::send_sms('77087060890', 'Ваш код: 123456');
//     if (sizeof($res) == 2)
//     var_dump($res);
// });

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect()->route('admin.main');
});
