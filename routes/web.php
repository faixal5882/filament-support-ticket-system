<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Builder;

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
    // dd(User::whereHas('roles', function (Builder $query) {
    //     $query->where('title', Role::ROLES['Staff']);
    // })
    //     ->get());
    return view('welcome');
});
