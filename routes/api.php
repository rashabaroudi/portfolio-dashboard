<?php




use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('auth:api');
    Route::post('refresh', 'refresh')->middleware('auth:api');
});

//contact

//index
Route::group(['middleware' => 'auth:api'], function () {
    //index-contact
    Route::get('contact', [ContactController::class, 'index'])->name('contacts');
    //Delete-Message(contact)
    Route::Delete('DeleteContact/{id}', [ContactController::class, 'destroy'])->name('DeleteContact');
    //show

    Route::get('showMessage/{id}', [ContactController::class, 'show'])->name('showMessage');
});
//store//send message to admin
Route::POST('StoreContact', [ContactController::class, 'store'])->name('storecontact');


Route::controller(ProjectController::class)->group(function () {

    Route::get('/allprojects', 'index')->name('projects');
    Route::get('/showprojects/{project}', 'show')->name('showprojects');
});
///////////ProjectRoutes//////////////
Route::middleware('auth:api')->controller(ProjectController::class)->group(function () {

    Route::post('/addprojects', 'store')->name('addprojects');
    Route::put('/editprojects/{project}', 'update')->name('editprojects');
    Route::delete('/deleteprojects/{project}', 'destroy')->name('deleteprojects');
});

////////////TypeRoutes///////////////
Route::controller(TypeController::class)->group(function () {

Route::get('/alltypes', 'index')->name('types');
Route::get('/showtypes/{type}', 'show')->name('showtypes');

});
Route::middleware('auth:api')->controller(TypeController::class)->group(function () {

    Route::post('/addtypes', 'store')->name('addtypes');
    Route::put('/edittypes/{type}', 'update')->name('edittypes');
    Route::delete('/deletetype/{type}', 'destroy')->name('deletetype');
});
