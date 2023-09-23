<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\WebsiteController;
use App\Http\Livewire\CompanySetup;
use App\Http\Middleware\CompanyMiddleware;
use App\Http\Middleware\HasCompanyMiddleware;
use App\Http\Middleware\IsActiveUser;
use App\Http\Middleware\SetupMiddleware;
use Illuminate\Support\Facades\Auth;
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
// ['verify' => true]
Auth::routes();
// sitemap
Route::get('sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.xml');

Route::get('/', [WebsiteController::class, 'homepage'])->name('homepage');
Route::get('about-us', [WebsiteController::class, 'about'])->name('about');
Route::get('features', [WebsiteController::class, 'features'])->name('features');
Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('products');
    Route::get('/independent', [ProductController::class, 'show'])->name('products.independent');
    Route::get('/recovery', [ProductController::class, 'show'])->name('products.recovery');
    Route::get('/enterprise', [ProductController::class, 'show'])->name('products.enterprise');
});
Route::get('pricing', [PricingController::class, 'index'])->name('pricing');
Route::post('pricing/quote', [PricingController::class, 'quote'])->name('package.quote');
Route::get('contact-us', [WebsiteController::class, 'contact'])->name('contact');
Route::post('contact-us', [WebsiteController::class, 'saveMessage'])->name('message.save');
Route::get('blog', [WebsiteController::class, 'blog'])->name('blog');
Route::get('careers', [CareerController::class, 'index'])->name('careers');
Route::post('careers/apply', [CareerController::class, 'store'])->name('careers.apply');
Route::post('careers/cv', [CareerController::class, 'upload_cv'])->name('careers.cv');
Route::get('company/offering', [WebsiteController::class, 'search_garage'])->name('services');
Route::get('{page}', [WebsiteController::class, 'page'])->name('page');
Route::get('language/{lang}', [WebsiteController::class, 'language'])->name('lang');


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/subscription', [HomeController::class, 'subscription'])->name('subscription');

// , 'verified'
Route::middleware(['auth', IsActiveUser::class])->group(function () {
    // account route
    Route::get('company/account', [HomeController::class, 'account'])->name('company.account');
    Route::put('company/account', [HomeController::class, 'updateAccount'])->name('company.account.update');

    // if company is not registered
    Route::middleware(HasCompanyMiddleware::class)->group(function () {
        Route::get('company/setup', CompanySetup::class)->name('company.setup');
        // Support Account Routes
        Route::group(['prefix' => 'company', 'as' => 'company.', 'middleware' => CompanyMiddleware::class], function () {
            // if company setup is not cinfigured then redirect to setup page
            Route::middleware(SetupMiddleware::class)->group(function () {
                Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

                // supports tickets route
                Route::resource('supports', SupportController::class)->only(['index', 'create', 'show']);

                // billing routes
                Route::get('billings', [BillingController::class, 'index'])->name('billing.index');

                // payment route
                Route::get('payment', [PaymentController::class, 'index'])->name('payment.index');
                Route::post('payment', [PaymentController::class, 'payment'])->name('payment.save');
            });
        });
    });
});
