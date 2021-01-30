<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input as Input;
use Auth;
class PrefsModel extends Model {

    protected $table = 'prefs_tb';

    public static function update_prefs(){
        $mPrefs           = PrefsModel::find(1);
        $mPrefs->title    = Input::get('title');
        $mPrefs->slogan   = Input::get('slogan');
        $mPrefs->address   = Input::get('address');
        //$mPrefs->address2   = Input::get('address2');
        $mPrefs->tel      = Input::get('tel');
        $mPrefs->email    = Input::get('email');
        /*$mPrefs->dribbble    = Input::get('dribbble');
        $mPrefs->google    = Input::get('google');
        $mPrefs->pinterest    = Input::get('pinterest');*/
        $mPrefs->instagram    = Input::get('instagram');
                $mPrefs->twitter    = Input::get('twitter');
        $mPrefs->facebook = Input::get('facebook');
        $mPrefs->youtube = Input::get('youtube');
/*        $mPrefs->whatsapp = Input::get('whatsapp');*/
        $mPrefs->manager_talk = Input::get('manager_talk');
        $mPrefs->user_id  = Auth::id();
        $mPrefs->save();
    }//end update prefs


    public static function get_title_value(){
        return PrefsModel::find(1)->title;
    }//end title value


    public static function get_slogan_value(){
        $mPrefs = PrefsModel::find(1);
        return $mPrefs->slogan;
    }//end description value

    public static function get_address_value(){
        $mPrefs = PrefsModel::find(1);
        return $mPrefs->address;
    }//end address1 value

    public static function get_address2_value(){
        $mPrefs = PrefsModel::find(1);
        return $mPrefs->address2;
    }//end address2 value


    public static function get_tel_value(){
        $mPrefs = PrefsModel::find(1);
        return $mPrefs->tel;
    }//end tel value


    public static function get_email_value(){
        $mPrefs = PrefsModel::find(1);
        return $mPrefs->email;
    }//end email value

    public static function get_dribbble_value(){
        $mPrefs = PrefsModel::find(1);
        return $mPrefs->dribbble;
    }//end dribbble value

    public static function get_youtube_value(){
        $mPrefs = PrefsModel::find(1);
        return $mPrefs->youtube;
    }//end google value
    public static function get_pinterest_value(){
        $mPrefs = PrefsModel::find(1);
        return $mPrefs->pinterest;
    }//end pinterest value
    //
    public static function get_instagram_value(){
        $mPrefs = PrefsModel::find(1);
        return $mPrefs->instagram;
    }//end instagram value
    //
    public static function get_twitter_value(){
        $mPrefs = PrefsModel::find(1);
        return $mPrefs->twitter;
    }//end twitter value


    public static function get_facebook_value(){
        $mPrefs = PrefsModel::find(1);
        return $mPrefs->facebook;
    }//end facebook value


    public static function get_whatsapp_value(){
        $mPrefs = PrefsModel::find(1);
        return $mPrefs->whatsapp;
        // return '';
    }//end whatsapp value


    public static function get_manager_talk_value(){
        $mPrefs = PrefsModel::find(1);
        return $mPrefs->manager_talk;
    }//end manager_talk value


}//end Prefs Model
