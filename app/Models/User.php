<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function register($full_name,$email_id,$password,$user_ip)
    {
        try {
            $result = $this->checkUserRegister($email_id);
            if (!$result){
                $this->name = $full_name ;
                $this->email = $email_id;
                $this->password = Hash::make($password);

                if ($this->save()){
                    $this->lastLogin($email_id,$user_ip);
                    return true;
                }
                return false;
            }
        }catch (QueryException $ex){
            Log::info('UserModel Error',['register'=>$ex->getMessage(),'line'=>$ex->getLine()]);
            return false;
        }
    }
    public function checkUserRegister($email_id)
    {
        try {
            $result = $this->where('email',$email_id)->exists();
            if ($result){
                return true;
            }
            return false;
        }catch (QueryException $ex){
            return view('error.500');
        }
    }
    public function login($email_id,$password,$user_ip){
        try {
            $check_active = $this->checkUserActive($email_id);
            $check_status = $this->checkUserstatus($email_id);
            if (isset($check_active) && isset($check_status) && $check_active == 1 && $check_status == 1){
                $user = $this->where('email',$email_id)->first();
                if (isset($user) && !empty($user)){
                    if (Hash::check($password,$user->password)){
                        $this->lastLogin($email_id,$user_ip);
                        return true;
                    }
                }
                return false;
            }
            return false;
        }catch (QueryException $ex){
            Log::info('UserModel Error',['login'=>$ex->getMessage(),'line'=>$ex->getLine()]);
        }
    }
    public function lastLogin($email_id,$user_ip): bool
    {
        try {
            $result = $this->where('email',$email_id)
                            ->update(['last_login_at' => \Carbon\Carbon::now('Asia/Kolkata'),'last_login_ip'=>$user_ip]);
            if ($result){
                return true;
            }
            return false;
        }catch (QueryException $ex){
            Log::info('UserModel Error',['lastLogin'=>$ex->getMessage(),'line'=>$ex->getLine()]);
            return false;
        }
    }
    public function checkUserActive($email_id){
        try {
            $result = $this->select('active')->where('email',$email_id)->get();

            if (count($result)){
                return $result[0]->active;
            }
            return null;
        }catch (QueryException $ex){
            Log::info('UserModel Error',['checkUserActive'=>$ex->getMessage(),'line'=>$ex->getLine()]);
            return null;
        }
    }
    public function checkUserstatus($email_id){
        try {
            $result = $this->select('status')->where('email',$email_id)->get();
            if (count($result)){
                return $result[0]->status;
            }
            return null;
        }catch (QueryException $ex){
            Log::info('UserModel Error',['checkUserActive'=>$ex->getMessage(),'line'=>$ex->getLine()]);
            return null;
        }
    }
    public function getProfileData($email_id){
        try {
            $result = $this->select('name','email','location','profile_pic','gender')->where('email',$email_id)->get();
            if (count($result)){
                return $result;
            }
            return null;
        }catch (QueryException $ex){
            Log::info('UserModel Error',['getProfileData'=>$ex->getMessage(),'line'=>$ex->getLine()]);
            return null;
        }
    }
    public function profileUpdate($email_id,$name,$gender,$location){
        try {
            $result = $this->where('email',$email_id)
                            ->update(['name'=>$name,'gender'=>$gender,'location'=>$location]);
            if ($result){
                return true;
            }
            return false;
        }catch (QueryException $ex){
            Log::info('UserModel Error',['profileUpdate'=>$ex->getMessage(),'line'=>$ex->getLine()]);
            return false;
        }
    }
    public function getUserdetail($email_id){
        try {
            $user_name = $this->select('name')->where('email',$email_id)->get();
            if (count($user_name)){
                return $user_name[0]->name;
            }
            return null;
        }catch (QueryException $ex){
            Log::info('UserModel Error',['getUserdetail'=>$ex->getMessage(),'line'=>$ex->getLine()]);
            return null;
        }
    }
    public function updateVerifyCode($email_id,$hash_key){
        try {
            $result = $this->where('email',$email_id)
                      ->update(['confirmation_code'=>$hash_key]);
            if ($result){
                return true;
            }
            return false;
        }catch (QueryException $ex){
            Log::info('UserModel Error',['updateVerifyCode'=>$ex->getMessage(),'line'=>$ex->getLine()]);
            return false;
        }
    }
    public function getverifyKey($key){
        try {
            $result = $this->where('confirmation_code',$key)->first();
            if ($result){
                return $result;
            }
            return null;
        }catch (QueryException $ex){
            Log::info('UserModel Error',['updateVerifyCode'=>$ex->getMessage(),'line'=>$ex->getLine()]);
            return null;
        }
    }
    public function updateVerifyStatus($email_id,$key){
    try {
        $result = $this->where('email',$email_id)->where('confirmation_code',$key)->update(['confirmed'=>1]);
        if ($result){
            return true;
        }
        return false;
    }catch (QueryException $ex){
        Log::info('UserModel Error',['updateVerifyCode'=>$ex->getMessage(),'line'=>$ex->getLine()]);
        return false;
    }
}
    public function updatePassword($email_id,$current_password,$new_password){
        try {
            $user_email = $this->where('email',$email_id)->first();
            if (isset($user_email) && !empty($user_email)){
                if (Hash::check($current_password, $user_email->password)){
                    $result = $this->where('email',$email_id)->update(['password'=>Hash::make($new_password)]);
                    return true;
                }
                return false;
            }
            return false;
        }catch (QueryException $ex){
            Log::info('UserModel Error',['updatePassword'=>$ex->getMessage(),'line'=>$ex->getLine()]);
            return false;
        }
    }
    public function checkUserExist($email){
        try {
            $result = $this->where('email',$email)->first();
            if ($result){
                return true;
            }
            return false;
        }catch (QueryException $ex){
            Log::info('UserModel Error',['checkUserExist'=>$ex->getMessage(),'line'=>$ex->getLine()]);
            return false;
        }
    }
    public function resetPassword($email,$password){
        try {
            $result = $this->where('email',$email)
                            ->update(['password'=>Hash::make($password)]);
            if ($result){
                return true;
            }
            return false;
        }catch (QueryException $ex){
            Log::info('UserModel Error',['resetPassword'=>$ex->getMessage(),'line'=>$ex->getLine()]);
            return false;
        }
    }
}
