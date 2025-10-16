<?php

use App\Livewire\Categories\CategoryManager;
use App\Livewire\Media\MediaManager;
use App\Livewire\Posts\PostTable;
use App\Livewire\Posts\PostForm;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use App\Livewire\Tags\TagManager;
use App\Livewire\Users\UserManager;
use App\Models\Media;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return view('maintainance', [
        'data' => [
            'appName' => 'Nagara AC Batang',
            'image' => Media::where('media_type', 'galleries')->get(),
        ],
    ]);
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::redirect('settings', 'dashboard/settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('users', UserManager::class)->name('users');
    Route::get('categories', CategoryManager::class)->name('categories');
    Route::get('tags', TagManager::class)->name('tags');
    Route::get('media', MediaManager::class)->name('media');

    Route::prefix('posts')->group(function () {
        Route::get('/', PostTable::class)->name('posts.index');
        Route::get('/create', PostForm::class)->name('posts.create');
        Route::get('/{id}', PostForm::class)->name('posts.edit');
    });

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
