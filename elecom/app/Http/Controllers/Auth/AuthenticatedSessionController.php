<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

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

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
