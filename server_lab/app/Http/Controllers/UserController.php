<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function get_user_list(){
        $data = User::all();
        return response(['data'=>$data]);
    }
}
