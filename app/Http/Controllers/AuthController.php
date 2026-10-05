<?php



namespace App\Http\Controllers;



use App\Models\User;
use App\Models\Otp;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;

use App\Helpers\NotificationHelper;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

use App\Models\Notification;

use Socialite;

use Illuminate\Support\Facades\Session;



class AuthController extends Controller

{

    public function showRegister()

    {

        return view('auth.register');

    }



    public function register(Request $request)

    {

  
        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:255',

            'email' => 'nullable|email|max:255|unique:users,email',

            'phone' => 'required|string|max:30|unique:users,phone',

            'password' => 'required|string|min:6|confirmed',

            'role' => 'nullable|in:customer,vendor',

        ]);



        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();

        }

        $user = User::create([

            'name' => $request->name,

            'email' => $request->email,

            'phone' => $request->phone,

            'password' => Hash::make($request->password),

            'role' => $request->role,

            'phone_code' => $request->phone_code,

            'status' => 1,

        ]);



        Notification::create([

            'user_id' => 1, // Default admin ID

            'user_type' => 'admin',

            'type' => 'user_registered',

            'title' => 'New User Registration',

            'message' => "New {$user->role} registered: {$user->name} ({$user->email})",

            'is_read' => 0,

        ]);

        return redirect()->route('login')->with('success', 'Registration successful.');

    }

    public function showLogin()

    {

        return view('auth.login');

    }



    // Accept phone and password, then show OTP page

    // public function login(Request $request)

    // {

    //     $validator = Validator::make($request->all(), [

    //         'phone' => 'required',

    //         'password' => 'required|string',

    //     ]);



    //     if ($validator->fails()) {

    //         return redirect()->back()->withErrors($validator)->withInput();

    //     }



    //     $credentials = ['phone' => $request->phone, 'password' => $request->password];



    //     // Attempt to validate credentials first

    //     $user = User::where('phone', $request->phone)->first();

    //     if (!$user || !Hash::check($request->password, $user->password)) {

    //         return redirect()->back()->withErrors(['phone' => 'Invalid phone or password'])->withInput();

    //     }



    //     // Store user id in session for OTP verification

    //     session(['auth_otp_user_id' => $user->id]);

    //     session(['auth_otp_phone' => $user->phone]);

    //     session(['auth_otp_phone_code' => $user->phone_code]);

        

    //     $this->sendOtp($user->phone);



    //     return redirect()->route('auth.otp')->with('info', 'Enter the 4-digit OTP sent to your phone.');

    // }
    
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email',$request->email)->first();

    if(!$user || !Hash::check($request->password,$user->password)){
        return back()->withErrors(['email'=>'Invalid email or password']);
    }

    $otp = rand(1000,9999);

    // delete old otp
    Otp::where('email',$user->email)->delete();

    // store new otp
    Otp::create([
        'email'=>$user->email,
        'otp'=>$otp,
        'expires_at'=>now()->addMinutes(5)
    ]);

    Mail::to($user->email)->send(new OtpMail($otp));

    session([
        'auth_otp_user_id'=>$user->id,
        'auth_otp_email'=>$user->email
    ]);

    return redirect()->route('auth.otp');
}


    

    private function sendOtp($phone)

    {

        

        $phone = preg_replace('/\D/', '', $phone);
    $countryCode = preg_replace('/\D/', '', session('auth_otp_phone_code'));
    $twilioPhone = '+' . $countryCode . $phone;



        $accountSid = env('TWILIO_ACCOUNT_SID');

        $authToken  = env('TWILIO_AUTH_TOKEN');

        $verifySid  = env('TWILIO_VERIFY_SID');



        $url = "https://verify.twilio.com/v2/Services/{$verifySid}/Verifications";



        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([

            'To' => $twilioPhone,

            'Channel' => 'sms'

        ]));

        curl_setopt($ch, CURLOPT_USERPWD, "{$accountSid}:{$authToken}");

        $response = curl_exec($ch);

        curl_close($ch);



        return $response;

    }

    



    public function showOtp()

    {

        if (!session('auth_otp_user_id')) {

            return redirect()->route('auth.login')->with('error', 'No login attempt found.');

        }



        return view('auth.otp');

    }



//     public function postOtp(Request $request)

//     {

       

//         $validator = Validator::make($request->all(), [

//             'otp' => 'required|string',

//         ]);



//         if ($validator->fails()) {

//             return redirect()->back()->withErrors($validator)->withInput();

//         }



//         // $otp = $request->otp;

//         // $expected = '1234';



//         // if ($otp !== $expected) {

//         //     return redirect()->back()->withErrors(['otp' => 'Invalid OTP'])->withInput();

//         // }



//         $user = User::find(session('auth_otp_user_id'));

//         if (!$user) {

//             return redirect()->route('auth.login')->with('error', 'User not found.');

//         }
        
// // bypass code Start
//     if($request->otp == '1234'){
        
        
//         Auth::login($user);

//         session()->forget(['auth_otp_user_id', 'auth_otp_phone']);



//         // Redirect based on user role

//         if ($user->role === 'vendor') {
            
//             return redirect()->route('owner.dashboard')->with('success', 'Logged in successfully.');

//         }



//         return redirect()->route('user.dashboard')->with('success', 'Logged in successfully.');
        
//     }
//     // bypass code End

//         $twilioPhone = session('auth_otp_phone_code') . ltrim($user->phone, '0');

        

//             $accountSid = env('TWILIO_ACCOUNT_SID');

//             $authToken  = env('TWILIO_AUTH_TOKEN');

//             $verifySid  = env('TWILIO_VERIFY_SID');

        

//             $url = "https://verify.twilio.com/v2/Services/{$verifySid}/VerificationCheck";

        

//             $ch = curl_init($url);

//             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//             curl_setopt($ch, CURLOPT_POST, true);

//             curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([

//                 'To'   => $twilioPhone,

//                 'Code' => $request->otp

//             ]));

//             curl_setopt($ch, CURLOPT_USERPWD, "{$accountSid}:{$authToken}");

        

//             $response = curl_exec($ch);

//             $twilioResponse = json_decode($response, true);

//             curl_close($ch);

        

//             if (!isset($twilioResponse['status']) || $twilioResponse['status'] !== 'approved') {

//                 return back()->withErrors(['otp' => 'Invalid or expired OTP.']);

//             }



//         // Login the user and forget otp session

//         Auth::login($user);

//         session()->forget(['auth_otp_user_id', 'auth_otp_phone']);



//         // Redirect based on user role

//         if ($user->role === 'vendor') {
            
//             return redirect()->route('owner.dashboard')->with('success', 'Logged in successfully.');

//         }



//         return redirect()->route('user.dashboard')->with('success', 'Logged in successfully.');

//     }



public function postOtp(Request $request)
{
    $request->validate([
        'otp'=>'required'
    ]);

    $email = session('auth_otp_email');

    $otp = Otp::where('email',$email)
            ->where('otp',$request->otp)
            ->where('expires_at','>',now())
            ->first();

    if(!$otp){
        return back()->withErrors(['otp'=>'Invalid or expired OTP']);
    }

    $user = User::where('email',$email)->first();

    Auth::login($user);

    // delete otp after login
    $otp->delete();

    session()->forget(['auth_otp_user_id','auth_otp_email']);

    if($user->role == 'vendor'){
        return redirect()->route('owner.dashboard');
    }

    return redirect()->route('user.dashboard');
}




    public function showForgot()

    {

        return view('auth.forgot');

    }



    // public function postForgot(Request $request)

    // {

    //     $validator = Validator::make($request->all(), [

    //         'email' => 'required|exists:users,email',

    //     ]);



    //     if ($validator->fails()) {

    //         return redirect()->back()->withErrors($validator)->withInput();

    //     }



    //     $user = User::where('email', $request->email)->first();

    //     session(['forgot_otp_user_id' => $user->id, 'forgot_otp_phone' => $user->email]);

        

    //     $this->sendOtp($user->phone);



    //     return redirect()->route('auth.forgot.otp')->with('info', 'Enter the 4-digit OTP sent to your phone to reset your password.');

    // }
    
    public function postForgot(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|exists:users,email',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = User::where('email', $request->email)->first();

    $otp = rand(1000,9999);

    DB::table('otps')->insert([
        'email' => $user->email,
        'otp' => $otp,
        'expires_at' => now()->addMinutes(5),
        'created_at' => now()
    ]);

    Mail::raw("Your password reset OTP is: ".$otp, function($message) use ($user){
        $message->to($user->email)
                ->subject('Password Reset OTP');
    });

    session([
        'forgot_otp_user_id' => $user->id,
        'forgot_otp_email' => $user->email
    ]);

    return redirect()->route('auth.forgot.otp')
        ->with('info','Enter the 4-digit OTP sent to your email.');
}




   public function showForgotOtp()
    {
        if (!session('forgot_otp_user_id')) {
            return redirect()->route('auth.forgot')
                ->with('error', 'No forgot-password attempt found.');
        }
    
        return view('auth.forgot_otp');
    }


    // public function postForgotOtp(Request $request)

    // {

    //     $validator = Validator::make($request->all(), [

    //         'otp' => 'required|string|size:4',

    //     ]);

    

    //     if ($validator->fails()) {

    //         return redirect()->back()->withErrors($validator)->withInput();

    //     }

        

    //     // FIXED HERE

    //     $user = User::find(session('forgot_otp_user_id'));

    

    //     if (!$user) {

    //         return redirect()->route('auth.login')->with('error', 'User not found.');

    //     }

    

    //     $twilioPhone = '+91' . ltrim($user->phone, '0');

    

    //     $accountSid = env('TWILIO_ACCOUNT_SID');

    //     $authToken  = env('TWILIO_AUTH_TOKEN');

    //     $verifySid  = env('TWILIO_VERIFY_SID');

    

    //     $url = "https://verify.twilio.com/v2/Services/{$verifySid}/VerificationCheck";

    

    //     $ch = curl_init($url);

    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //     curl_setopt($ch, CURLOPT_POST, true);

    //     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([

    //         'To'   => $twilioPhone,

    //         'Code' => $request->otp

    //     ]));

    //     curl_setopt($ch, CURLOPT_USERPWD, "{$accountSid}:{$authToken}");

    

    //     $response = curl_exec($ch);

    //     $twilioResponse = json_decode($response, true);

    //     curl_close($ch);

    

    //     if (!isset($twilioResponse['status']) || $twilioResponse['status'] !== 'approved') {

    //         return back()->withErrors(['otp' => 'Invalid or expired OTP.']);

    //     }

    

    //     return redirect()->route('auth.reset')->with('info', 'Enter your new password.');

    // }
    
    public function postForgotOtp(Request $request)
{
    $validator = Validator::make($request->all(), [
        'otp' => 'required|digits:4',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $email = session('forgot_otp_email');

    $otp = DB::table('otps')
        ->where('email', $email)
        ->where('otp', $request->otp)
        ->where('expires_at', '>', now())
        ->latest()
        ->first();

    if(!$otp){
        return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
    }

    return redirect()->route('auth.reset')
        ->with('info', 'Enter your new password.');
}



    /**

     * Resend OTP for login OTP flow (static OTP is reused)

     */

    // public function resendOtp(Request $request)

    // {

    //     $phone = session('auth_otp_phone');

    //     $masked = $this->maskPhone($phone);

    //     // In a real system, generate and send OTP here. We reuse static OTP.

    //     return redirect()->back()->with('success', "OTP resent to {$masked}");

    // }


public function resendOtp()
{
    $email = session('auth_otp_email');

    $otp = rand(1000,9999);

    Otp::where('email',$email)->delete();

    Otp::create([
        'email'=>$email,
        'otp'=>$otp,
        'expires_at'=>now()->addMinutes(5)
    ]);

    Mail::to($email)->send(new OtpMail($otp));

    return back()->with('success','OTP resent successfully');
}


    public function showReset()

    {

        if (!session('forgot_otp_user_id')) {

            return redirect()->route('auth.forgot')->with('error', 'No reset attempt found.');

        }



        return view('auth.reset');

    }



    public function postReset(Request $request)

    {

        $validator = Validator::make($request->all(), [

            'password' => 'required|string|min:6|confirmed',

        ]);



        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();

        }



        $user = User::find(session('forgot_otp_user_id'));

        if (!$user) {

            return redirect()->route('auth.forgot')->with('error', 'User not found');

        }



        $user->password = Hash::make($request->password);

        $user->save();



        // clean up forgot session

        session()->forget(['forgot_otp_user_id', 'forgot_otp_phone']);



        // Redirect to login (user will be prompted to login with new password, then redirected to role-based dashboard)

        return redirect()->route('auth.login')->with('success', 'Password reset successfully. Please login.');

    }



    /**

     * Resend OTP for forgot-password flow

     */

    // public function resendForgotOtp(Request $request)

    // {

    //     $phone = session('forgot_otp_phone');

    //     $masked = $this->maskPhone($phone);

    //     return redirect()->back()->with('success', "OTP resent to {$masked}");

    // }
    
    
    public function resendForgotOtp(Request $request)
{
    $email = session('forgot_otp_email');

    if (!$email) {
        return redirect()->route('auth.forgot')
            ->with('error','Session expired. Please try again.');
    }

    $otp = rand(1000,9999);

    DB::table('otps')->insert([
        'email' => $email,
        'otp' => $otp,
        'expires_at' => now()->addMinutes(5),
        'created_at' => now()
    ]);

    Mail::raw("Your password reset OTP is: ".$otp, function($message) use ($email){
        $message->to($email)
                ->subject('Password Reset OTP');
    });

    // email masking
    $masked = substr($email,0,3) . '******' . strstr($email,'@');

    return redirect()->back()->with('success', "OTP resent to {$masked}");
}




    /**

     * Mask phone helper (simple, shows last 4 digits with +91 xxxxxx prefix)

     */

    private function maskPhone($phone)

    {

        $digits = preg_replace('/\D/', '', $phone ?? '');

        $last4 = strlen($digits) >= 4 ? substr($digits, -4) : $digits;

        return '+91 xxxxxx' . $last4;

    }



    public function logout()

    {

        Auth::logout();

        return redirect()->route('home')->with('success', 'Logged out successfully.');

    }

    


    public function redirect()
    {

        return Socialite::driver('google')->stateless()->redirect();

    }



    // public function callback()

    // {

    //     try {

    //         // $googleUser = Socialite::driver('google')->user();

    //         $googleUser = Socialite::driver('google')->stateless()->user();

    //         $user = User::where('email', $googleUser->email)->first();



    //         // Existing user ? login

    //         if ($user) {

    //             if (!$user->google_id) {

    //                 $user->update([

    //                     'google_id' => $googleUser->id,

    //                 ]);

    //             }



    //             Auth::login($user);

    //             return redirect()->route('home');

    //         }



    //         // New user ? store google data temporarily

    //         Session::put('google_user', [

    //             'name' => $googleUser->name,

    //             'email' => $googleUser->email,

    //             'google_id' => $googleUser->id,

    //         ]);



    //         return redirect()->route('google.role.form');



    //     } catch (\Exception $e) {

    //         return redirect()->route('auth.login')

    //             ->with('error', 'Google login failed.');

    //     }

    // }
    
    public function callback()
{
    try {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $googleUser->email)->first();

        if ($user) {
            if (!$user->google_id) {
                $user->update([
                    'google_id' => $googleUser->id,
                ]);
            }

            Auth::login($user);
            return redirect()->route('home');
        }

        Session::put('google_user', [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'google_id' => $googleUser->id,
        ]);

        return redirect()->route('google.role.form');

    } catch (\Exception $e) {
        return redirect()->route('auth.login')
            ->with('error', $e->getMessage());
    }
}



    public function showRoleForm()

    {

        if (!Session::has('google_user')) {

            return redirect()->route('auth.login');

        }



        return view('auth.google-role');

    }



    public function saveRole()

    {

        request()->validate([

            'role' => 'required|in:customer,vendor',

        ]);



        $googleUser = Session::get('google_user');



        $user = User::create([

            'name' => $googleUser['name'],

            'email' => $googleUser['email'],

            'google_id' => $googleUser['google_id'],

            'role' => request('role'),

            'password' => bcrypt(uniqid()), // random

        ]);



        Session::forget('google_user');



        Auth::login($user);



        return $user->role === 'vendor'

        ? redirect()->route('owner.dashboard')

        : redirect()->route('user.dashboard');

    }

    

    

}

