<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;

use function Symfony\Component\String\b;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // Admin dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->middleware('role:admin')
        ->name('admin.dashboard');

        Route::get('/admin/borrowings', [BorrowingController::class, 'index'])->name('admin.borrowings.index');
        Route::patch('/admin/borrowings/{id}/approve', [BorrowingController::class, 'approve'])->name('admin.borrowings.approve');
        Route::patch('/admin/borrowings/{id}/reject', [BorrowingController::class, 'reject'])->name('admin.borrowings.reject');
        Route::patch('/admin/borrowings/{id}/returned', [BorrowingController::class, 'markReturned'])->name('admin.borrowings.returned');

    //CRUD Books for admin
    Route::resource('admin/books', BookController::class)->names([
        'index' => 'admin.books.index',
        'create' => 'admin.books.create',
        'store' => 'admin.books.store',
        'edit' => 'admin.books.edit',
        'update' => 'admin.books.update',
        'destroy' => 'admin.books.destroy',
    ]);

    // User dashboard
    Route::get('/user/dashboard', [UserController::class, 'index'])
        ->middleware('role:user')
        ->name('user.dashboard');

        Route::get('/user/borrowings', [BorrowingController::class, 'index'])->name('user.borrowings.index');
        Route::post('/user/borrowings', [BorrowingController::class, 'store'])->name('user.borrowings.store');
        Route::get('/user/borrowings/history', [BorrowingController::class, 'history'])->name('user.borrowings.history');


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
