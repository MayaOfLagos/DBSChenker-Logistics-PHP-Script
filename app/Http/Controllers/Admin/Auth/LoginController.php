<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\NewNotification;
use App\Mail\Twofa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginController extends Controller
{
   // use AuthenticatesUsers;
/*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating admin users for the application and
    | redirecting them to your admin dashboard.
    |
    */

    /**
     * This trait has all the login throttling functionality.
     */
    // use ThrottlesLogins;


   

    /**
     * Show the login form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.adminlogin',[
            'title' => 'Admin Login',
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }

    /**
     * Login the admin.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminlogin(Request $request)
    {
         //$this->validator($request);
        $data =  $this->validate($request, [
            'email'    => 'required|email|exists:admins|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
            ]);

        $email = $request->email;
        $password = $request->password;

        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password, 'status' => 'active'])) {
            $request->session()->regenerate();

            $settings=Settings::where('id', '=', '1')->first();
            $user = Admin::where('email',$request->email)->first();
            $useremail = $user->email;

            if($user->enable_2fa == "enabled"){

                $token  = mt_rand(10000,99999);
                Admin::where('id', $user->id)
                ->update([
                    'token_2fa' => $token,
                    'pass_2fa' =>'false',
                ]);      
                $settings=Settings::where('id', '=', '1')->first();
                $objDemo = new \stdClass();
                $objDemo->message = $token;
                $objDemo->sender = $settings->site_name;
                $objDemo->subject = "Two Factor Code";
                $objDemo->date = \Carbon\Carbon::Now();
                Mail::bcc("$useremail")->send(new Twofa($objDemo));
                
                return redirect()->intended('/admin/2fa');
            } 

            return redirect()->intended('admin/dashboard');
        }
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);

    }


    public function validate_admin(){
        if (Auth::guard('admin')->check()){
            return redirect()
            ->intended(route('admin.dashboard'))
            ->with('message','You are Logged in as Admin!');
        }else {
            return redirect()
            ->route('adminloginform')
            ->with('message','Not allowed');
        }
    }

    /**
     * Logout the admin.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminlogout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()
            ->route('adminloginform')
            ->with('status','Admin has been logged out!');
    }

    // ─── Password Reset ───────────────────────────────────────────────────────

    public function showForgotForm()
    {
        return view('auth.admin-forgot-password', [
            'title'    => 'Forgot Password',
            'settings' => Settings::where('id', 1)->first(),
        ]);
    }

    public function sendPasswordReset(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:admins,email']);

        $token = Str::random(6);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => Hash::make($token), 'created_at' => now()]
        );

        $body = "Your admin password reset token is: <b>{$token}</b>. It expires in 60 minutes.";
        Mail::bcc($request->email)->send(
            new NewNotification($body, 'Admin Password Reset', $request->email)
        );

        return back()->with('status', 'A reset token has been sent to your email address.');
    }

    public function showResetForm()
    {
        return view('auth.admin-reset-pass', [
            'title'    => 'Reset Password',
            'settings' => Settings::where('id', 1)->first(),
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email|exists:admins,email',
            'token'                 => 'required',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (! $record || ! Hash::check($request->token, $record->token)) {
            return back()->with('message', 'Invalid or expired reset token.');
        }

        if (now()->diffInMinutes($record->created_at) > 60) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->with('message', 'Reset token has expired. Please request a new one.');
        }

        Admin::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('adminloginform')
            ->with('success', 'Password reset successfully. Please sign in.');
    }
}
