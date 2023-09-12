<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\pollingController;
use App\Http\Livewire\AddItems;
use App\Http\Livewire\AddProfileItems;
use App\Http\Controllers\ProductController;
use App\Http\Livewire\EditProfileItems;
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


// Web

// Polling Uni Page
Route::get('/pollingUnit/{id}', [pollingController::class, 'show_unit']);
// View Unit Bar
Route::get('/pollingUnitBar/{id}', [pollingController::class, 'show_bar']);


// Guest User

Route::middleware('guest:web')->group(function () {
    // Home Page
    Route::get('/', [pollingController::class, 'index']);
    // Login Page
    Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
    // Polling Uni Page
    Route::get('/pollingUnit/{id}', [pollingController::class, 'show_unit']);
    // View Unit Bar
    Route::get('/pollingUnitBar/{id}', [pollingController::class, 'show_bar']);
    // View Profile
    Route::get('/showProfile/{id}', [pollingController::class, 'show_profile']);
});


// Route User

// Middleware Auth User
Route::middleware(['auth:web',])->group(function () {
    // Home Page
    Route::get('/home', [pollingController::class, 'index'])->name('home');
    // PollSurvey Page
    Route::post('/pollSurvey', [pollingController::class, 'set_polling_survey']);
    // Polling Uni Page
    Route::get('/pollingUnit/{id}', [pollingController::class, 'show_unit']);
    // View Unit Bar
    Route::get('/pollingUnitBar/{id}', [pollingController::class, 'show_bar']);
    // Action Logout
    Route::get('/auth/google/logout', [GoogleController::class, 'logout'])->name('logout');
    // View Profile
    Route::get('/profile/{id}', [pollingController::class, 'show_profile_item']);
});


// Route Admin

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['guest:admin', 'PreventBackHistory'])->group(function () {
        // Admin Login Page
        Route::get('/login', function () {
            return view('adminLogin', ["title" => "Login"]);
        })->name('login');
        Route::post('/check', [adminController::class, 'check'])->name('check');
    });
    // Middleware Auth Admin
    Route::middleware(['auth:admin', 'is_admin', 'PreventBackHistory'])->group(function () {

        // Admin Page
        Route::get('/', [adminController::class, 'index'])->name('home');

        // Route Page

        // Add Polling Page
        Route::get('/addPolling', [pollingController::class, 'create']);

        // Edit Polling Page
        Route::get('/editPolling/{id}', [pollingController::class, 'edit']);
        Route::post('/editPolling/{id}', [pollingController::class, 'update']);

        // Close Polling Page
        Route::post('/closePolling', [pollingController::class, 'close_polling'])->name('close');

        // Delete Polling Page
        Route::post('/deletePolling', [pollingController::class, 'delete'])->name('delete');

        // Add Unit Page
        Route::get('/addPollItems', function () {
            return view('addPollItems', ["title" => "Add Poll Items"]);
        });
        Route::post('/addUnit', [pollingController::class, 'create_unit'])->name('add-unit');;

        // View Unit Bar
        Route::get('/pollingUnitBar/{id}', [pollingController::class, 'show_bar']);

        // Add Item Page
        Route::get('/addItems/{id}', AddItems::class);

        // Edit Item
        // Route::get('/editPollItems/{id}', function () {
        //     return view('editPollItems', [
        //         "title" => "Edit Polling Items"
        //     ]);
        // });

        Route::get('/editPollItems/{id}', EditProfileItems::class);

        // Result Polling Page
        Route::get('/result/{vote_unit}', [pollingController::class, 'result']);

        // More Profile Page
        Route::get('/moreProfile/{id}', AddProfileItems::class);

        // Show Profile Page
        Route::get('/showProfile/{id}', [pollingController::class, 'show_profile']);

        // edit & delete more Profile
        Route::post('/update-more-profile', [pollingController::class, 'updateMoreProfileItem']);
        Route::get('/delete-more-profile', [pollingController::class, 'deleteMoreProfileItem']);

        // Logout Page
        Route::get('/logout', [adminController::class, 'logout'])->name('logout');
    });
});





// Route::post('/addItems',[pollingController::class,'create_items']);
// Route::get('/addItems/{id}',[pollingController::class,'edit_items']);
// Route::post('/addItems',[StoreItems::class,'storeItems']);

// Route::get('/pollingUnit', function () {
//     return view('pollingUnit', [
//         "title" => "Polling Unit"
//     ]);
// });



Route::get('/pollingUnitBar', function () {
    return view('pollingUnitBar', [
        "title" => "Polling Unit Bar"
    ]);
});



// Route::get('/getPollingUnit',[pollingController::class,'get_polling_json']);
Route::get('/viewPollUnit/{id}', [pollingController::class, 'show_unit']);



Route::get('/profile', function () {
    return view('profile', [
        "title" => "Profile"
    ]);
});



// Route::get('/moreProfile', function () {
//     return view('moreProfile', [
//         "title" => "Add More Profile"
//     ]);
// });








// root Testing
// Route::get('/pollSurvey', function () {
//     return view('pollSurvey', [
//         "title" => "Poll Survey"
//     ]);
// });



Route::get('/pollSurvey/{id}', [pollingController::class, 'polling_survey']);


Route::get('/formPollTes', function () {
    return view('formPollTes', [
        "title" => "Form Poll Tes"
    ]);
});

Route::get('/addMoreProfile', function () {
    return view('addMoreProfile', [
        "title" => "Add More Profile"
    ]);
});

Route::get('/editPolling', function () {
    return view('editPolling', [
        "title" => "Edit Polling Unit"
    ]);
});

Route::get('/editPollItems', function () {
    return view('editPollItems', [
        "title" => "Edit Polling Items"
    ]);
});

Route::get('/viewProfileItems', function () {
    return view('viewProfileItems', [
        "title" => "View Profile Items"
    ]);
});

Route::get('/products', function () {
    return view('products', [
        "title" => "Products"
    ]);
});
Route::post('/save', [ProductController::class, 'save'])->name('save.product');
Route::get('/fetchProducts', [ProductController::class, 'fetchProducts'])->name('fetch.products');
Route::get('/getProductDetails', [ProductController::class, 'getProductDetails'])->name('get.product.details');
Route::post('/updateProduct', [ProductController::class, 'updateProduct'])->name('update.product');
Route::post('/deleteProduct', [ProductController::class, 'deleteProduct'])->name('delete.product');
