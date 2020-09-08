<?php

namespace App\Models;

use App\Helpers\APIHelper;
use App\Helpers\FileHelper;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Redirect;
use Mpociot\Firebase\SyncsWithFirebase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input as Input;
use Auth;
use DB;

class QuestionsModel extends Model {


    const DEFAULT_MEDIA_COVER = "resources/assets/admin/images/golden_logo.png";
    protected $table = 'aldiar_questions_tb';

    protected $fillable = [
          'question','answer','active',
    ];

    public static function replay($questionId){

        $myQuestion =  QuestionsModel::find(intval($questionId));
        $myQuestion->answer = Input::get('answer');
        $myQuestion->save();

        /*$name  = $myQuestion->name;
        $title  = 'تم الرد على سؤالك ';
        $text  = '  تم الرد على سؤالك , قم بزيارتنا على الرابط التالي';
        $email = $myQuestion->email;

        \Mail::send(['html' => 'emails.contact'], ['text' => $text,'email'=>$email,'name'=>$name,'title'=>$title], function ($message) use ($email, $title, $text) {
            $message->from($email, $title);

            $message->to('info@trustgrp.com')->subject($title);
        });*/

    }

    public function deactivate(){
        $this->active = 0;
        //$this->user_id = Auth::id();
        $this->save();
    }



}//end work Model
