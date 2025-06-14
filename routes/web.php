<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\PayController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::middleware(['auth','verified'])->group(function(){
    Route::redirect('user-dashboard','dashboard');
    Route::get('dashboard', [ViewController::class, 'dashboard'])->name('dashboard');
    Route::get('file-repository',[ViewController::class, 'view_repository'])->name('repository.show');
    Route::get('information',[ViewController::class, 'view_information'])->name('information');
    Route::get('add-project',[ViewController::class, 'view_add'])->name('project.show');
    Route::get('edit-project/{id}',[ViewController::class, 'view_edit'])->name('edit.show');
    Route::post('project',[ProjectController::class, 'add'])->name('project.add');
    Route::post('edit-success',[ProjectController::class, 'edit'])->name('project.edit');
    Route::post('user-dashboard', [ProjectController::class, 'delete'])->name('project.delete');
    Route::post('download', [ProjectController::class, 'downloadFILE'])->name('file');
    Route::post('payment', [ViewController::class, 'view_payment'])->name('checkout.view');
    Route::post('checkout',[PayController::class,'checkout'])->name('checkout');
    Route::get('checkout-success', [PayController::class,'handleSuccess'])->name('checkout.success');
    Route::get('checkout-cancel', function () {
        return view('checkout.cancel');
    })->name('checkout.cancel');
});

Route::middleware(['auth','admin','verified'])->group(function(){
    Route::redirect('admin-dashboard', 'admin/dashboard');
    Route::get('categories',[ViewController::class, 'view_categories'])->name('categories');
    Route::post('add-categories',[AdminController::class, 'add_categories'])->name('categories.add');
    Route::get('admin-categories',[AdminController::class, 'edit_categories'])->name('categories.edit');
    Route::post('admin-categories/{id}',[AdminController::class, 'delete_categories'])->name('categories.destroy');
    Route::get('admin-events',[ViewController::class, 'view_events'])->name('events.show');
    Route::post('add-events',[AdminController::class, 'add_events'])->name('events.add');
    Route::get('admin-events/{id}',[AdminController::class, 'edit_events'])->name('events.edit');
    Route::post('admin-events/{id}',[AdminController::class, 'delete_events'])->name('events.destroy');
    Route::get('admin-details/{id}',[ViewController::class, 'view_details'])->name('details.show');
    Route::get('upload-templates', function () {
        return view('admin/upload-templates');})->name('upload-templates');
    Route::get('/generate-pdf', [AdminController::class, 'downloadPDF'])->name('pdf');
    Route::get('/generate-excel', [AdminController::class, 'downloadExcel'])->name('excel');
    Route::get('/download-template', [AdminController::class, 'downloadExcel2'])->name('template');
    Route::post('/update-award-status', [AdminController::class, 'update_awardStatus']);
});

require __DIR__.'/auth.php';