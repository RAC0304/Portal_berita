<?php
// app/Http/Controllers/AdminController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

//  In the above code, we have created a new controller named  AdminController  and added three methods:  showLoginForm() ,  login() , and  logout() .
//  The  showLoginForm()  method is used to display the login form. The  login()  method is used to authenticate the admin user. The  logout()  method is used to log out the admin user.
//  Step 5: Create Admin Dashboard
//  Next, we will create an admin dashboard view file.
//  Run the following command to create a new view file:
//  php artisan make:view admin.dashboard

//  Add the following code to the newly created view file:
