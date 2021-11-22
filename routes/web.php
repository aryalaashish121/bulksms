<?php

use App\Http\Controllers\DynamicSmsController;
use App\Http\Controllers\StudentController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::resource('/student', StudentController::class);

    Route::post('/send/msg',[StudentController::class,'sendSms'])->name('send-sms');
    Route::post('/send-sms/sendiong',[StudentController::class,'create'])->name('sending-sms');

    Route::post('/check',[DynamicSmsController::class,'handle'])->name('check');

    Route::post('/testing',function(Request $request){

 
    });

    Route::get('/akash-sms', function () {
        $contactList = [9867182424,9861135127];
        $args = http_build_query(array(
            'auth_token'=> '24e37a4f557a608b2d05431670f25d75b464dea735d08297c7eb4ca26b5afbc8',
            'to'    => '9867182424,9861135127',
            'text'  => 'Congratulations you have been selected for node.js job interview. For further proceding, please contact to given numbers.
                9779843176172'));
    $url = "https://sms.aakashsms.com/sms/v3/send/";

    # Make the call using API.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1); ///
    curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    // Response
    $response = curl_exec($ch);
    curl_close($ch);     
       
    echo $response;
    });