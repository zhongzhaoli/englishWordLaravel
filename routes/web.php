<?php
/*
 * @Author: Custer
 * @Date: 2021-10-06 02:40:50
 * @LastEditors: Custer
 * @LastEditTime: 2021-12-28 10:41:48
 * @Description: file content
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordController;
use App\Http\Controllers\DayController;

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

// header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Credentials: true");
// header("Access-Control-Allow-Methods: *");
// header("Access-Control-Allow-Headers: Content-Type,Access-Token");
// header("Access-Control-Expose-Headers: *");


Route::get("/api/wordList", [WordController::class, 'index']);
Route::get("/api/wordSelect", [WordController::class, 'selectDay']);
Route::post("/api/wordCreate", [WordController::class, 'create']);
Route::post("/api/dayCreate", [DayController::class, 'create']);
Route::get("/api/dayList", [DayController::class, 'index']);

Route::post("/api/bookSaveImage", [DayController::class, 'saveBook']);