<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Formcontroller extends Controller
{
    //

    function addUser(Request $request){

        $request->validate([
            'username' => 'required | min:3 | max:10 | uppercase',
            'email' => 'required | email',
            'city' => 'required | min:3 | max:10',
            'skills' => 'required'
        ],[
            'username.required' => 'Username is required',
            'username.min' => 'Username must be at least 3 characters',
            'username.max' => 'Username must be at most 10 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'city.required' => 'City is required',
            'city.min' => 'City must be at least 3 characters',
            'city.max' => 'City must be at most 10 characters',
            'skills.required' => 'Skills is required'
        ]);

        return $request;
    }

}
