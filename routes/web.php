<?php

use App\Http\Controllers\productController;
use App\Http\Requests\productRequest;
use Illuminate\Support\Facades\DB;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//商品画面一覧
Route::get('/products','productController@productView')->name('product');
//商品情報詳細画面
Route::get('/product_detail/{id}','productController@productDetailView')->name('detail');
//商品情報登録画面
Route::get('/product_register','productController@productRegistView')->name('regist');
//商品情報編集画面
Route::get('/product_editing/{id}','productController@productEditView')->name('edit');

Route::post('/search','productController@getSearch')->name('search');

//商品新規登録
Route::post('/insertProduct','productController@insertProduct')->name('insertProduct');

//削除ボタン機能。
Route::get('/productDelete/{id}','productController@itemDelete')->name('itemDelete');

//商品情報編集処理
Route::post('/products/{id}','productController@infoUpdate')->name('infoUpdate');

//高田さん
Route::post('/takada', 'productController@productSearch')->name('productSearch');






