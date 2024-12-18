<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\State;
use App\Models\User;


class UserController extends Controller
{
    //
    public function index(){
        $user = User::find(session()->get('id'));
        return view('usercreation' ,['stAbb' => State::getAbb(), 'user' => $user]);
    }

    //
    public function create(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:users',
            'address' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'state' => 'required',
            'password' => 'required|min:8',
        ]);
        
        
        $userId = User::insertGetId([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'city' =>$validated['city'],
            'zip' => $validated['zip'],
            'state' => $validated['state'],
            'password' => Hash::make($request->password),
            'role_id' => 2,
        ]);
        $user = User::find($userId);


        return view('auth.login');
    }

    public function login (){
        return view("auth.login");
    }

    public function varifyLogin(LoginRequest $request): RedirectResponse{
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

        if (Auth::attempt($credentials)) {
            
            session()->put('id', Auth::user()->id);
            if (Auth::user()->role_id == 1){
                return redirect()->intended('/dashboard'); // dashbboard redirect
            }
            return redirect()->intended('/cart'); // cart redirect
        }
        return back()->withErrors(['error' => 'Invalid credentials']);
    }

    public function logout (Request $request) {
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }

}
