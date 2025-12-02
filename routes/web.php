<?php

use App\Livewire\Admin\Genres;
use App\Livewire\Admin\Novels;
use App\Livewire\Admin\Profile;
use App\Livewire\Admin\Reports;
use App\Livewire\User\Homepage;
use App\Livewire\User\Profiles;
use App\Livewire\Admin\Comments;
use App\Livewire\Admin\Episodes;
use App\Livewire\User\Bookmarks;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\SearchResult;
use App\Livewire\User\SearchResults;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\SendNotification;
use App\Livewire\User\NotificationsList;
use App\Livewire\User\NotificationDetail;

// Tambahkan route ini DI ATAS middleware auth
Route::view('/', 'welcome')->name('welcome');
// ==========================
// ROUTE USER
// ==========================
Route::middleware(['auth'])->group(function () {
    Route::get('/homepage', Homepage::class)->name('user.homepage');
    Route::get('/novels', \App\Livewire\User\Novels::class)->name('user.novels');
    Route::get('/novel/{slug}', \App\Livewire\User\NovelDetail::class)->name('user.novel');
    Route::get('/novel/{slug}/{episodeNumber}', \App\Livewire\User\ReadEpisode::class)->name('user.episode');
    Route::get('/user/bookmarks', Bookmarks::class)->name('user.bookmarks');
    Route::get('/profiles', Profiles::class)->name('user.profiles');
    Route::get('/notifications', NotificationsList::class)->name('user.notifications');
    Route::get('/notifications/{id}', NotificationDetail::class)->name('user.notification.detail');
    Route::get('/user/search', SearchResults::class)->name('user.search-results');
    
});

// ==========================
// ROUTE ADMIN
// ==========================
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/admin/novels', Novels::class)->name('admin.novels');
    Route::get('/admin/episodes', Episodes::class)->name('admin.episodes');
    Route::get('/admin/genres', Genres::class)->name('admin.genres');
    Route::get('/admin/comments', Comments::class)->name('admin.comments');
    Route::get('/admin/comments/{novelId}', \App\Livewire\Admin\CommentDetail::class)->name('admin.comment.detail');
    Route::get('/admin/reports', Reports::class)->name('admin.reports');
    Route::get('/admin/reports/detail/{reportId}', \App\Livewire\Admin\ReportDetail::class)->name('admin.report.detail');
    Route::get('/admin/notifications', SendNotification::class)->name('admin.notifications');
    Route::get('/profile', Profile::class)->name('admin.profile');
    Route::get('/search', SearchResult::class)->name('admin.search-result');
});

require __DIR__.'/auth.php';