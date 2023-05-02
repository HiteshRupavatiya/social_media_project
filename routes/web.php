<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TwoFactorAuthenticationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::get('register-form', 'registerForm')->name('register.view');
    Route::post('register', 'register')->name('register');
    Route::get('login-form', 'loginForm')->name('login.view');
    Route::post('login', 'login')->name('login');
    Route::get('dashboard', 'dashboard')->name('dashboard');
    Route::get('verify-email/{token}', 'verifyEmail')->name('verify.email');
    Route::get('forgot-password-form', 'forgotPasswordForm')->name('forgot.password.view');
    Route::post('forgot-password', 'forgotPassword')->name('forgot.password');
    Route::get('reset-password/{token}', 'resetPasswordForm')->name('reset.password.view');
    Route::post('reset-password', 'resetPassword')->name('reset.password');

    Route::get('login/google', 'redirectToGoogle')->name('login.google');
    Route::get('login/google/callback', 'handleGoogleCallback');
    Route::get('github', 'redirectToGithub')->name('login.github');
    Route::get('github/callback', 'handleGithubCallback');
    Route::get('login/facebook', 'redirectToFacebook')->name('login.facebook');
    Route::get('login/facebook/callback', 'handleFacebookCallback');
});

Route::controller(TwoFactorAuthenticationController::class)->prefix('auth')->group(function () {
    Route::get('two-factor-authentication', 'index')->name('two.factor.authentication.view');
    Route::post('two-factor-authentication', 'store')->name('two.factor.authentication.store');
    Route::get('two-factor-authentication/resend', 'resend')->name('two.factor.authentication.resend');
});

Route::group(['middleware' => 'auth'], function () {
    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('logout', 'logout')->name('logout');
    });
});
