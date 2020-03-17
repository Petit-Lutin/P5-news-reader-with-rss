<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit($id)
    {

        $user = Auth::user();
        return view('user/edit')->withCategory($category);


    }

    public function destroy($id)
    {
        $user = \User::find(Auth::user()->id);

        Auth::logout();
        if ($user->delete()) {
            return Redirect::route('welcome')->with('global', 'Your account has been deleted!');
        }
    }


}
