<?php

use Illuminate\Support\Facades\Route;
use Modules\AuthUser\Http\Actions\CreateUserAction;

Route::name('auth')->prefix('authUser')->group(function () {
    Route::name('create')->post('/create', CreateUserAction::class);
});
