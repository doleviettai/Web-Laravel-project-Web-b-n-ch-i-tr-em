<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

         Auth::login($user);

        // return redirect(route('dashboard', absolute: false));
        $authUserRole = Auth::user()->role;
        // câu lệnh này sẽ lấy role từ database và kiểm tra role .
        // câu lệnh này giúp phân quyền . đề admin client có thể đăng nhập

        if($authUserRole == 0){
            return redirect()->intended(route('admin', absolute: false));
        }else if($authUserRole==1){
            return redirect()->intended(route('vendor' , absolute:false));
        }else if($authUserRole==2){
            return redirect()->intended(route('customer.dashboard' , absolute:false));
        }
    }
}
