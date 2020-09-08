<?php

namespace App\Models;
use Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Input as Input;
use Hash;
use DB;
use App\Helpers\FileHelper;
class UserModel extends Authenticatable
{
    const MALE_LOGO = 'resources/assets/admin/images/logos/male.jpg';

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','img','active',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function update_current_user(){
        $mUser = Auth::user();
        $mUser->name = Input::get('name');
        $password = Input::get('password');

        if(!empty($password)){
            $mUser->password = Hash::make($password);
        }

        $mUser->email = Input::get('email');
        $img = FileHelper::storeImage('avatar','uploads/profiles');
        if(!empty($img)){
            $mUser->img = $img;
        }

        $mUser->save();
    }//end update current user

 public static function update_user($id){
        $mUser = UserModel::find($id);
        $mUser->name = Input::get('name');
        $password = Input::get('password');

        if(!empty($password)){
            $mUser->password = Hash::make($password);
        }

        $mUser->email = Input::get('email');
        $mUser->role = intval(Input::get('role'));


        $mUser->save();
    }//end update  user

    public static function getAllManagers(){
        $query = "select * from users ";
        $query .= "where role < 11 ";
        $query .= "and active = 1 ";
        $users = DB::select($query);
        return $users;

    }

    public static function isManger()
    {

        if (!Auth::check()){
            return False;
        }

        $user = Auth::user();

        if($user->role < 2)
            return true;

        //default value
        return FALSE;

    }
    public static function isSuperVisor(){

        if (!Auth::check())
            return False;


        $user = Auth::user();

        if($user->role < 11)
            return TRUE;

        //default value
        return FALSE;
    }

    public static function saveManager(){

        UserModel::create([
            'name'=> Input::get('name'),
            'password' => Hash::make(Input::get('password')),
            'user_id'=>Auth::id(),
            'role' => intval(Input::get('role')),
            'email'=> Input::get('email'),
            'active'=> 1,
            'img'=> UserModel::MALE_LOGO

        ]);

    }//end save Manager



    public static function checkLogin (){
        if(!Auth::check()){
            return URL::to('/');
        }
    }

    public static function getRoleTitle($roleId){
        switch($roleId){
            case 1: return "مدير عام";
                break;
            case 10: return "مشرف";
                break;
            default:
                return "غير معروف";
        }
    }


    public function deactivate(){
        $this->active = 0;
        $this->save();
    }//end deactivate
}//end user model
