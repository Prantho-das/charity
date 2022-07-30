<?php

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

use App\Models\User;
use Spatie\Permission\Models\Role;

Route::get('/', 'Frontend\HomeController@index')->name('landing');
Route::get('/coming-to-donate/{bRequestId}/{userId}', "Backend\BloodRequestController@comingToDonate")->name('comingToDonate');

Auth::routes();
Route::group(['as' => 'home.', 'prefix' => 'home', 'middleware' => ['auth']], function () {
    Route::get('/get-role-access', function () {
        if (auth()->user()->hasAnyRole(Role::all())) {
            abort(401);
        }
        return view('backend.users.get-role-access');
    });
    Route::get('/get-role-access/{role}', function ($role) {
        if (auth()->user()->hasAnyRole(Role::all())) {
            abort(401);
        }
        if ($role === 'Donor' || $role === 'Volunteer') {
            $user = User::where('id',auth()->id())->first();
            $rol = Role::where('name', $role)->first();
            $user->assignRole($rol);
           // return Auth::user()->getRoleNames();
            return redirect()->route('home.dashboard')->with('success', 'You are now a ' . $role);
        }
        return response()->json(['success' => false]);
    })->name('get-role-access');


    Route::group(['middleware' => ['roleGiveCheck', 'role:Admin|Volunteer']], function () {
        Route::get('/', 'Backend\DashboardController@index')->name('dashboard');



        Route::get('/profile', 'Backend\ProfileController@edit')->name('profile');
        Route::put('/profile-update/{user}', 'Backend\ProfileController@update')->name('profile-update');
        Route::put('change-password/{user}', "Backend\ProfileController@changePassword")->name('change-password');

        /* ---------------------------- User Profile end ---------------------------- */

        Route::group(['as' => 'blood.', 'prefix' => 'blood'], function () {

            Route::get('/', "Backend\BloodRequestController@index")->name('index');
            Route::get('/requests', "Backend\BloodRequestController@requests")->name('requests');

            Route::group(["middleware" => 'role:Volunteer'], function () {
                Route::post('/request', "Backend\BloodRequestController@requestBlood")->name('request');
                Route::delete('/request-delete/{id}', "Backend\BloodRequestController@requestBloodDelete")->name('request.delete');
            });

            Route::group(["middleware" => 'role:Admin'], function () {
                Route::post('/accept/{id}', "Backend\BloodRequestController@accept")->name('accept');
                Route::post('/reject/{id}', "Backend\BloodRequestController@reject")->name('reject');
            });
        });
        Route::group(['as' => 'users.', 'prefix' => 'users'], function () {

            Route::get('/', "Backend\UserController@index")->name('index');
            Route::get('/donor', "Backend\UserController@donor")->name('donor');

            Route::group(["middleware" => 'role:Admin'], function () {
                Route::get('create', "Backend\UserController@create")->name('create');
                Route::post('/', "Backend\UserController@store")->name('store');
            });

            Route::get('/{user}', "Backend\UserController@show")->name('show');

            Route::group(["middleware" => 'role:Admin'], function () {
                Route::get('edit/{user}', "Backend\UserController@edit")->name('edit');
                Route::put('/{user}', "Backend\UserController@update")->name('update');
                Route::put('change-password/{user}', "Backend\UserController@changePassword")->name('change-password');
                Route::delete('/{user}', "Backend\UserController@destroy")->name('delete');
            });
        });

        Route::group(['as' => 'events.', 'prefix' => 'events'], function () {

            Route::get('/', "Backend\EventController@index")->name('index');

            Route::group(["middleware" => 'role:Admin'], function () {
                Route::get('create', "Backend\EventController@create")->name('create');
                Route::post('/', "Backend\EventController@store")->name('store');
            });

            Route::get('/{event}', "Backend\EventController@show")->name('show');

            Route::group(["middleware" => 'role:Admin'], function () {
                Route::get('edit/{event}', "Backend\EventController@edit")->name('edit');
                Route::put('/{event}', "Backend\EventController@update")->name('update');
                Route::delete('/{event}', "Backend\EventController@destroy")->name('delete');
            });
        });

        Route::group(['as' => 'products.', 'prefix' => 'products'], function () {

            Route::get('/', "Backend\ProductController@index")->name('index');

            Route::group(["middleware" => 'role:Admin'], function () {
                Route::get('create', "Backend\ProductController@create")->name('create');
                Route::post('/', "Backend\ProductController@store")->name('store');
            });

            Route::get('/{product}', "Backend\ProductController@show")->name('show');

            Route::group(["middleware" => 'role:Admin'], function () {
                Route::get('edit/{product}', "Backend\ProductController@edit")->name('edit');
                Route::put('/{product}', "Backend\ProductController@update")->name('update');
                Route::delete('/{product}', "Backend\ProductController@destroy")->name('delete');
            });
        });

        Route::group(['as' => 'requests.', 'prefix' => 'requests'], function () {

            Route::get('/', "Backend\RequestController@index")->name('index');

            Route::get('create/{product}', "Backend\RequestController@create")->name('create');
            Route::post('store/{product}', "Backend\RequestController@store")->name('store');
            Route::get('/{productRequest}', "Backend\RequestController@show")->name('show');

            Route::group(["middleware" => 'role:Admin'], function () {
                Route::put('accept/{productRequest}', "Backend\RequestController@accept")->name('accept');
                Route::put('reject/{productRequest}', "Backend\RequestController@reject")->name('reject');
            });
        });

        Route::group(['as' => 'members.', 'prefix' => 'members'], function () {

            Route::get('/', "Backend\MemberController@index")->name('index');

            Route::get('/{user}', "Backend\MemberController@show")->name('show');

            Route::group(["middleware" => 'role:Admin'], function () {
                Route::put('accept/{user}', "Backend\MemberController@accept")->name('accept');
                Route::put('reject/{user}', "Backend\MemberController@reject")->name('reject');
            });
        });
    });

    /* --------------------------- User Profile Start --------------------------- */
});

/* -------------------------- Stripe Donation Start ------------------------- */

Route::group(['middleware' => ['role:Donor']], function () {
    Route::get('donate', 'StripePaymentController@donate')->name('home.donate');
    Route::post('stripe', 'StripePaymentController@stripePost')->name('home.stripe.post');
    Route::get('volunteer', function () {
        if (auth()->check() && !auth()->user()->hasRole('Volunteer')) {
            auth()->user()->update(['status' => 1]);
        }
        return back();
    })->name('volunteer');
});

    /* --------------------------- Stripe Donation End -------------------------- */
