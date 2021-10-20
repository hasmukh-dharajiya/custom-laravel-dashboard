<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index(){
        return view('dashboard');
    }
    public function profile(){
        try {
            $email_id = Auth::user()->email;
            $result = $this->user->getProfileData($email_id);
            if (isset($result) && !empty($result)){
                return view('profile')->with(['data'=>$result]);
            }
        }catch (\Exception $ex){
            Log::info('DashboardController', ['profile'=>$ex->getMessage(),'line'=>$ex->getLine()]);
            return view('error.500');
        }
    }
    public function profileUpdate(Request $request){
        try {
            $validator = Validator::make($request->all(),[
                'full_name' => 'required',
                'location' => 'required',
                'gender' => 'required',
            ]);
            if ($validator->fails()){
                $error = $validator->errors()->first();
                return redirect()->back()->withErrors(['error'=>$error]);
            }
            $email_id = Auth::user()->email;
            $result = $this->user->profileUpdate($email_id,$request->full_name,$request->gender,$request->location);
            if ($result){
                return redirect()->back()->with(['status'=>true,'message'=>'Update Success']);
            }
            return redirect()->back()->with(['status'=>false,'message'=>'Update Failed']);
        }catch (\Exception $ex){
            Log::info('DashboardController', ['profileUpdate'=>$ex->getMessage(),'line'=>$ex->getLine()]);
            return view('error.500');
        }
    }

}
