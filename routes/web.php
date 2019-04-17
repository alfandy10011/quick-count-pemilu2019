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
Route::group(['middleware' => 'cors'],function(){
    Route::get('/', function () {
        return view('dashboard');
    });
    Route::get('/data/suara', 'HomeController@api')->name('api');
    Route::get('/data/proses', 'HomeController@proggress')->name('proggress');
});


Route::get('/python', 'HomeController@runPython')->name('python');

Auth::routes();
Route::get('login',function(){
    return view('auth.login');
})->name('login');
Route::get('qr-login','Auth\LoginController@qrCodeLogin')->name('qr.login');
Route::get('face_login','Auth\LoginController@faceLogin')->name('face.login');
Route::post('login','Auth\LoginController@attemptLogin')->name('login');
Route::post('upload_image','Auth\LoginController@uploadImage')->name('upload_image');
Route::get('logout','Auth\LoginController@logout')->name('logout');

Route::post('/home/upload_image', 'HomeController@uploadImage')->name('upload.image');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('testing',function(){
    $data = file_get_contents('https://pemilu2019.kpu.go.id/static/json/hhcw/ppwp.json');
    // $result = json_encode($data);
    $final  = json_decode($data,true);
    for($i=0; $i<count($final['chart']);$i++) {
        $prabowo = $final['chart']['22'];
        $jokowi = $final['chart']['21'];

        return response()->json([
            'jokowi' => $jokowi,
            'prabowo' => $prabowo
        ],200);
    }
    
});
