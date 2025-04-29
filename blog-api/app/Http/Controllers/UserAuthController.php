<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return ['success' => false, 'result' => [], 'msg' => 'UnAuthorized'];
        }

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        return ['success' => true, 'result' => $success, 'msg' => 'User Logged In Successfully'];

    }

    public function signup(Request $request)
    {
        $input             = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user              = User::create($input);
        $success['token']  = $user->createToken('MyApp')->plainTextToken;
        $user['name']      = $user->name;
        return ['success' => true, 'result' => $success, 'msg' => 'User Created Successfully'];

    }

}
