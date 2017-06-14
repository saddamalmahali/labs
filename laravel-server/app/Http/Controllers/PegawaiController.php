<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Pegawai;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function store(Request $request)
    {
        $res = $request->input('pegawai');
        $pegawai = new Pegawai();
        $pegawai->nama_depan = $res['nama_depan'];
        $pegawai->nama_belakang = $res['nama_belakang'];
        $pegawai->alamat = $res['alamat'];
        $pegawai->no_telp = $res['no_telp'];
        $pegawai->email = $res['email'];

        return response($pegawai, 200);
    }
    //
}
