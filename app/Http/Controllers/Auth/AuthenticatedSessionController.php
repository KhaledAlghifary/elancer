<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

      

/////////a way to make the login, usually used to customize  
        // $user= User::where('email','=',$request->post('email'))
        // //->orWhere('mobile','=',$request->post('email')) //to add another option to login but we must delete the 'email' from validation, and it check with default input
        
        
        
        //->first();

        // if(!$user|| !Hash::check($request->post('password'),$user->password) ){

            
        // throw ValidationException::withMessages([
        //     'email'=>'Khaled'
        // ]);

        // };

        //Auth::login($user);

//////////////////////

//////2nd way
// Auth::attempt([
//     'email'=>$request->post('email'),
//     'password'=>$request->post('password')

// ]);


///////////////////
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME); //redierct if the user didn't log in
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
