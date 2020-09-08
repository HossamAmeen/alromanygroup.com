<?php namespace App\Helpers;
use Auth;
use Request;
use View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request as Requests;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input as Input;
use Redirect;
use App\Models\UserModel;
use Hash;
class ValidatorHelper  {

    public static function check_logged_user_password(){

        $password = Input::get('check_password');
        $user = Auth::user();
//        $hashed = Hash::make($password);
//        var_dump($password);
//        var_dump($hashed);
//        var_dump($user->password);
        if (Hash::check($password,$user->password))
        {
            return true;
        }else{
            return false;
        }
    }

}//end validator Helper