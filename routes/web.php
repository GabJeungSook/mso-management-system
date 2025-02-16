<?php

use App\Livewire\Admin\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Admin\Announcements;
use App\Livewire\Admin\Events;
use App\Livewire\Admin\Fees;
use App\Livewire\Admin\Members;
use App\Livewire\Admin\PenaltyReport;
use App\Livewire\Admin\MemberReport;
use App\Livewire\Admin\OfficerReport;
use App\Livewire\Admin\AttendanceReport;
use App\Livewire\Admin\Officers;
use App\Livewire\Admin\Positions;
use App\Livewire\Admin\Penalties;
use App\Livewire\Admin\PreRegisteredMembers;
use App\Livewire\Admin\ScanQrCode;
use App\Livewire\Member\Announcement;
use App\Livewire\Member\AnnouncementDetails;
use App\Livewire\Member\EventRegistration;
use App\Livewire\Member\MemberPenalties;
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
Route::get('/admin/scan-qr', ScanQrCode::class)->middleware(['auth', 'verified'])->name('admin.scan-qr');
Route::get('/admin/pre-registered-members', PreRegisteredMembers::class)->middleware(['auth', 'verified'])->name('admin.pre-registered-members');
Route::get('/admin/attendance', Attendance::class)->middleware(['auth', 'verified'])->name('officer.attendance');
Route::get('/admin/penalties', Penalties::class)->middleware(['auth', 'verified'])->name('admin.penalties');
Route::get('/admin/reports/penalties', PenaltyReport::class)->middleware(['auth', 'verified'])->name('admin.report-penalties');
Route::get('/admin/reports/members', MemberReport::class)->middleware(['auth', 'verified'])->name('admin.report-members');
Route::get('/admin/reports/officers', OfficerReport::class)->middleware(['auth', 'verified'])->name('admin.report-officers');
Route::get('/admin/reports/attendance', AttendanceReport::class)->middleware(['auth', 'verified'])->name('admin.report-attendance');



Route::get('/member/events', MemberEvents::class)->middleware(['auth', 'verified'])->name('member.events');
Route::get('/member/event-preregistration/{record}', EventRegistration::class)->middleware(['auth', 'verified'])->name('member.event-preregistration');
Route::get('/member/announcement', Announcement::class)->middleware(['auth', 'verified'])->name('member.anouncement');
Route::get('/member/announcement-details/{record}', AnnouncementDetails::class)->middleware(['auth', 'verified'])->name('member.announcement-details');
Route::get('/member/penalites', MemberPenalties::class)->middleware(['auth', 'verified'])->name('member.penalties');


require __DIR__.'/auth.php';
