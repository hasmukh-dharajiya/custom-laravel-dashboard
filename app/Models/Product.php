<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    protected $table = 'product';
    public $incrementing = false;
    public $timestamps = false;
    public function getProduct(){
        try {
            $result = $this->get();
            if (count($result)){
                return $result;
            }
            return null;
        }catch (QueryException $ex){
            Log::info('ProductModel Error',['getProfileData'=>$ex->getMessage(),'line'=>$ex->getLine()]);
            return null;
        }
    }
    public function deleteProduct($id){
        try {
            $result = $this->where('id',$id)->delete();
            if ($result){
                return $result;
            }
            return null;
        }catch (QueryException $ex){
            Log::info('ProductModel Error',['deleteProduct'=>$ex->getMessage(),'line'=>$ex->getLine()]);
            return null;
        }
    }
    public function addProduct($name,$quantity,$price,$category){
        try {
            $this->name = $name;
            $this->category = $category;
            $this->price = $price;
            $this->qnt = $quantity;
            if ($this->save()){
                return true;
            }
            return false;
        }catch (QueryException $ex){
            Log::info('UserModel Error',['profileUpdate'=>$ex->getMessage(),'line'=>$ex->getLine()]);
            return false;
        }
    }
}
