<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\PasswordReset;

use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    private $user;
    private $password_reset;

    public function __construct(User $user, PasswordReset $password_reset)
    {
        $this->user = $user;
        $this->password_reset = $password_reset;
    }

    public function registerView()
    {
        return view("auth.register");
    }

    public function loginView()
    {
        return view("auth.login");
    }

    public function register(Request $request)
    {
//        try {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'email_id' => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ], [
            'full_name.required' => 'Name is required !',
            'email_id.required' => 'Email Id is required !',
            'email_id.email' => 'User Name Must be email id !',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return redirect()->back()->withErrors(['message' => $error])->withInput();
        }
        $result = $this->user->register($request->full_name, $request->email_id, $request->password, $request->ip());
        if ($result) {
            $credentials = array();
            $credentials['email'] = $request->email_id;
            $credentials['password'] = $request->password;
            Auth::attempt($credentials);

            return redirect('/dashboard');
        } else {
            return redirect()->back()->withErrors(['error' => 'User Already Register !'])->withInput();
        }
//        }catch (\Exception $ex){
//            Log::info('AuthenticationController Error',['register'=>$ex->getMessage(),'line'=>$ex->getLine()]);
//            return view('error.500');
//        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email_id' => 'required|email',
                'password' => 'required|min:8'
            ], [
                'email_id.required' => 'email Field is required !',
                'email_id.email' => 'User must Valid Email address',
                'password.required' => 'password Field is required !'
            ]);
            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return redirect()->back()->withErrors(['error' => $error])->withInput();
            }
            $result = $this->user->login($request->email_id, $request->password, $request->ip());

            if ($result) {
                $credentials = array();
                $credentials['email'] = $request->email_id;
                $credentials['password'] = $request->password;
                Auth::attempt($credentials);
                return redirect('/dashboard');
            }
            return redirect()->back()->withErrors(['error' => 'Authentication Failed !'])->withInput();
        } catch (\Exception $ex) {
            Log::info('AuthenticationController Error', ['login' => $ex->getMessage(), 'line' => $ex->getLine()]);
            return view('error.500');
        }
    }

    public function logout()
    {
        try {
            if (Auth::check()) {
                Auth::logout();
                return redirect('/login');
            }
        } catch (\Exception $ex) {
            Log::info('AuthenticationController Error', ['logout' => $ex->getMessage(), 'line' => $ex->getLine()]);
            return view('error.500');
        }
    }

    public function sendVerifyEmail()
    {
        try {
            $email_id = Auth::user()->email;
            $hash_key = self::generateRandomString(30);
            $user_name = $this->user->getUserdetail($email_id);
            if (!isset($user_name) && empty($user_name)) {
                $user_name = 'N/A';
            }
            $data = array();
            $data['hash_key'] = $hash_key;
            $data['name'] = $user_name;
            Mail::to($email_id)->send(new VerifyEmail($data));
            $is_update = $this->user->updateVerifyCode($email_id, $hash_key);
            if ($is_update) {
                return response()->json(['status' => true, 'name' => $user_name, 'code' => $hash_key])->setStatusCode(200);
            }
            return response()->json(['status' => false])->setStatusCode(200);
        } catch (\Exception $ex) {
            Log::info('AuthenticationController Error', ['sendVerifyEmail' => $ex->getMessage(), 'line' => $ex->getLine()]);
            return response()->json(['status' => false])->setStatusCode(200);
        }
    }

    public function getVerifyKey($key)
    {
        try {
            $result = $this->user->getverifyKey($key);
            if (isset($result) && !empty($result)) {
                $is_status = $this->user->updateVerifyStatus($result->email, $result->confirmation_code);
                if ($is_status) {
                    return view('auth.verify_email')->with(['status' => true, 'message' => 'Email Verification Success']);
                }
                return view('auth.verify_email')->with(['status' => false, 'message' => 'Error While Activating Emails']);
            }
            return view('auth.verify_email')->with(['status' => false, 'message' => 'Provided Activation Key is not valid or has been expired, Please resend verification mail and try again']);
        } catch (\Exception $ex) {
            Log::info('AuthenticationController Error', ['getverifyKey' => $ex->getMessage(), 'line' => $ex->getLine()]);
            return view('error.500');
        }
    }

    public static function generateRandomString($length = 30)
    {
        try {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        } catch (\Exception $ex) {
            Log::info('AuthenticationController Error', ['logout' => $ex->getMessage(), 'line' => $ex->getLine()]);
            return view('error.500');
        }
    }

    public function forgotPasswordView()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email'
            ], [
                'email.required' => 'Email Id is Required'
            ]);
            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return redirect()->back()->withErrors(['errors' => $error])->withInput();
            }
            $key = self::generateRandomString(30);
            $email = $request->email;
            $user_exist = $this->user->checkUserExist($email);
            if ($user_exist === false) {
                return redirect()->back()->with(['status' => true, 'massage' => 'Mail Send Success']);
            }
            $add_record = $this->password_reset->addNewRecord($email, $key);
            if ($add_record === false) {
                return redirect()->back()->withErrors(['errors' => 'error_while_sending_reset_email'])->withInput();
            }
            $user_name = $this->user->getUserdetail($email);
            $data = array();
            $data['name'] = $user_name;
            $data['hash_key'] = $key;
            if (Mail::to($email)->send(new ResetPassword($data))) ;
            return redirect()->back()->with(['status' => true, 'massage' => 'Mail Send Success']);
        } catch (\Exception $ex) {
            Log::info('AuthenticationController Error', ['forgotPassword' => $ex->getMessage(), 'line' => $ex->getLine()]);
            return view('error.500');
        }
    }

    public function resetPasswordEmail($key)
    {
        try {
            $email_detail = $this->password_reset->getRecord($key);
            if (!isset($email_detail) && empty($email_detail)) {
                return view('auth.reset_password', ['status' => false, 'message' => 'Provided reset key is not valid Or is expired']);
            }
            if ($email_detail->is_used == true) {
                return view('auth.reset_password', ['status' => false, 'message' => 'Provided reset key is not valid Or is expired']);
            }
            return view('auth.reset_password', ['status' => true, 'message' => 'password_reset_success']);
        } catch (\Exception $ex) {
            Log::info('AuthenticationController Error', ['resetPassword' => $ex->getMessage(), 'line' => $ex->getLine()]);
            return view('error.500');
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'key' => 'required',
                'password' => 'required|same:new_password|min:8',
                'new_password' => 'required|min:8'
            ], [
                'key.required' => 'Some Data is missing try Again'
            ]);
            if ($validator->fails()) {
                $error = $validator->errors();
                return redirect()->back()->withErrors($error)->withInput();
            }
            $reset_email = $this->password_reset->getRecord($request->key);
            if (!isset($reset_email) && empty($reset_email)) {
                return view('auth.reset_password', ['status' => false, 'message' => 'Provided reset key is not valid Or is expired']);
            }
            $add_record = $this->password_reset->addRecord($request->key, $reset_email->email);
            if (!$add_record) {
                return redirect()->back()->withErrors('error_while_resetting_password')->withInput();
            }
            $email = $reset_email->email;
            $password = $request->password;
            $reset_password = $this->user->resetPassword($email, $password);
            if ($reset_password) {
                return redirect()->back()->with(['success_status' => true, 'message' => 'password_reset_success']);
            }
            return redirect()->back()->withErrors('error_while_resetting_password')->withInput();
        } catch (\Exception $ex) {
            Log::info('AuthenticationController Error', ['resetPassword' => $ex->getMessage(), 'line' => $ex->getLine()]);
            return view('error.500');
        }
    }
}
