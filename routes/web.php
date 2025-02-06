<?php

use App\Livewire\Admin\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\Events;
use App\Livewire\Admin\Fees;
use App\Livewire\Admin\Members;
use App\Livewire\Admin\Officers;
use App\Livewire\Admin\Positions;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', Dashboard::class)->middleware(['auth', 'verified'])->name('admin.dashboard');
Route::get('/admin/positions', Positions::class)->middleware(['auth', 'verified'])->name('admin.positions');
Route::get('/admin/members', Members::class)->middleware(['auth', 'verified'])->name('admin.members');
Route::get('/admin/officers', Officers::class)->middleware(['auth', 'verified'])->name('admin.officers');
Route::get('/admin/events', Events::class)->middleware(['auth', 'verified'])->name('admin.events');
Route::get('/admin/fees', Fees::class)->middleware(['auth', 'verified'])->name('admin.fees');

require __DIR__.'/auth.php';
