<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->all();

        $user =  $request->user();

        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->name = $data['name'];


        $user->save();

        return response($user);
    }
}
