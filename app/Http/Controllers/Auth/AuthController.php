<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use App\Service\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
     // =======Constructor==========
     private $authService;
     public function __construct()
     {
         $this->authService = new AuthService();
     }
     // ============================

     // =========Admin/User login========================
     public function loadLogin()
     {
         if (Auth::user()) {
             return redirect()->route('admin.dashboard');
         }
         return view('auth.login');
     }
 
     public function adminLogin(Request $request)
     {
         try {
             $userCredential = $request->only('email', 'password');
             if (Auth::attempt($userCredential)) {
                 // login to admin dashboard
                 if (Auth::user()) {
                     return redirect()->route('admin.dashboard')->with('success', 'You are logged in');
                 }
             } else {
                 return back()->with('error', 'Email or password is incorrect');
             }
         } catch (\Throwable $th) {
             return back()->with('error', $th->getMessage());
         }
     }
     // ===========================================

       // ==========Admin/User Logout==================
    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/login');
    }
    // ===============================================

     // ============Admin/User Forget password===================
     public function forgetPasswordLoad()
     {
         return view('auth.forget-password');
     }

     public function forgetPassword(Request $request)
     {
         try {
             $isReset = $this->authService->forgetPassword($request);
             if ($isReset) { 
                 return back()->with('success', 'Please check your mail to reset your password!');
             } else {
                 return back()->with('error', 'Email not exist!');
             }
         } catch (\Throwable $th) {
             return back()->with('error', $th->getMessage());
         }
     }
     // ========================================================
 
       // ============Reset Admin/User Password===================
    public function resetPasswordLoad(Request $request)
    {
        try{
            $resetDataEmail = PasswordReset::where('token', $request->token)->first()->email;
            if (isset($request->token) && isset($resetDataEmail)) {
                $userEmail = User::where('email', $resetDataEmail)->first()->email;
                return view('auth.resetPassword', compact('userEmail'));
            } else {
                return view('error.404');
            }
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }

    public function resetPassword(Request $request)
    {
        try{
            $this->authService->resetPassword($request);
            return redirect()->route('admin.login')->with('success', 'Password reset successfully!');
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }
    // ========================================================
}