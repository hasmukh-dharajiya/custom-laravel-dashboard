<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function changePassword(){
        return view('change_password');
    }
    public function updatePassword(Request $request){
        try {
            $validator = Validator::make($request->all(),[
                'current_password' => 'required',
                'new_password' => 'required|same:confirm_password|min:8',
                'confirm_password' => 'required|min:8'
            ]);
            if ($validator->fails()){
                $error = $validator->errors();
                return redirect()->back()->withErrors($error)->withInput();
            }
            $email_id = Auth::user()->email;
            $result = $this->user->updatePassword($email_id,$request->current_password,$request->new_password);
            if ($result){
                return redirect()->back()->with(['status'=>true,'massage'=>'Password Change Successfully !']);
            }
            return redirect()->back()->withErrors(['message'=>'Password Not Changed !'])->withInput();
        }catch (\Exception $ex){
            Log::info('UserController', ['updatePassword'=>$ex->getMessage(),'line'=>$ex->getLine()]);
            return view('error.500');
        }
    }
}
