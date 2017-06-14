<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return response()->json([
        ["id"=>1, "nama"=>"Saddam Almahali", "alamat"=>"Kp. Sukasono"],
        ["id"=>2, "nama"=>"Amanda Abdurahman", "alamat"=>"Kp. Sukasono"],
        ["id"=>3, "nama"=>"Irham Hakim", "alamat"=>"Kp. Sukasono"],
    ]);
});

$app->post('/tambah_pegawai', 'PegawaiController@store');
