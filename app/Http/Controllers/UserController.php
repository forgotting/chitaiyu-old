<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    //
    public function login(Request $request) {
        $id = $request->id;
        $password = $request->password;
        $user = new User;
        $user = $user::where('id', $id)->where('password', $password);

        if ($user->count() > 0) {
            Auth::login($user->firstOrFail());

            if (Auth::check()) {
                //return redirect()->intended('punch/' . $id);
                return response()->json(['result' => true]);
            }
        }

        return response()->json(['result' => false, 'msg' => '請輸入正確的密碼']);
    }

    public function svg() {

        return view('svg');
    }
}
