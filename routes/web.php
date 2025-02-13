<?php

use App\Livewire\Admin\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Admin\Announcements;
use App\Livewire\Admin\Events;
use App\Livewire\Admin\Fees;
use App\Livewire\Admin\Members;
use App\Livewire\Admin\Officers;
use App\Livewire\Admin\Positions;
use App\Livewire\Member\EventRegistration;
use App\Livewire\Member\Events as MemberEvents;
use App\Livewire\Officer\Attendance;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.positions');
     } elseif(Auth::user()->role === 'officer') {
         return redirect()->route('admin.members');
     }else{
            return redirect()->route('member.events');
     }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', Dashboard::class)->middleware(['auth', 'verified'])->name('admin.dashboard');
Route::get('/admin/positions', Positions::class)->middleware(['auth', 'verified'])->name('admin.positions');
Route::get('/admin/members', Members::class)->middleware(['auth', 'verified'])->name('admin.members');
Route::get('/admin/officers', Officers::class)->middleware(['auth', 'verified'])->name('admin.officers');
Route::get('/admin/events', Events::class)->middleware(['auth', 'verified'])->name('admin.events');
Route::get('/admin/fees', Fees::class)->middleware(['auth', 'verified'])->name('admin.fees');
Route::get('/admin/announcements', Announcements::class)->middleware(['auth', 'verified'])->name('admin.announcements');


Route::get('/officer/attendance', Attendance::class)->middleware(['auth', 'verified'])->name('officer.attendance');

Route::get('/member/events', MemberEvents::class)->middleware(['auth', 'verified'])->name('member.events');
Route::get('/member/event-preregistration/{record}', EventRegistration::class)->middleware(['auth', 'verified'])->name('member.event-preregistration');

require __DIR__.'/auth.php';
