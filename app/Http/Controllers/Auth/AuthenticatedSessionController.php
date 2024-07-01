<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
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

        $user = $request->user();

        if ($user->role === 'admin' && $user->status === 'inactive') {
            Auth::logout();
            $notification = array(
                'message' => 'Your account is inactive. Please contact the administrator.',
                'alert-type' => 'error'
            );
            return redirect()->route('admin.login')->with($notification);
        }

        if ($user->role === 'employee' && $user->status === 'inactive') {
            Auth::logout();
            $notification = array(
                'message' => 'Your account is inactive. Please contact the administrator.',
                'alert-type' => 'error'
            );
            return redirect()->route('employee.login')->with($notification);
        }

        if ($user->role === 'user' && $user->status === 'inactive') {
            Auth::logout();
            $notification = array(
                'message' => 'Your account is inactive. Please contact the administrator.',
                'alert-type' => 'error'
            );
            return redirect()->route('login')->with($notification);
        }



        $url = '';

        if (strpos($request->path(), '8ray/login') !== false) {
            $url = '/8ray';
        } elseif (strpos($request->path(), 'datacentre/login') !== false) {
            $url = '/datacentre';
        } elseif ($request->user()->role === 'admin') {
            $url = '/admin/dashboard';
        } elseif ($request->user()->role === 'employee') {
            $url = '/employee/page';
        }

        return redirect()->intended($url);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect based on the current URL
        $url = $request->fullUrl();
        if (strpos($url, '/8ray') !== false) {
            return redirect('/8ray/login');
        } elseif (strpos($url, '/datacentre') !== false) {
            return redirect('/datacentre/login');
        } elseif ($request->user()->role === 'admin') {
            $url = '/admin/login';
        } elseif ($request->user()->role === 'employee') {
            $url = '/employee/login';
        }

        return redirect('/');
    }
}
