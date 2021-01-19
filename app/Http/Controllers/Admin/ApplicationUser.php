<?php

namespace App\Http\Controllers\Admin;

use App\Models\AppUserModel;
use App\Models\Equivalent;
use Illuminate\Http\Request as Requests;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Auth;
use DB;
use Illuminate\Support\Facades\Redirect;

class ApplicationUser extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $mAppUsers = AppUserModel::where('active', '=', '1')->orderBy('macAddress', 'desc')->orderBy('id', 'desc')->orderBy('macAddress', 'desc')->get();
        $pageTitle = "??????? ???????";
        return view('admin.app-users.all', compact('mAppUsers', 'pageTitle'));
    }




    public function store(Requests $request)
    {
//        echo json_encode('reach');
//        echo json_encode('start store user');

       $mAppUser =  AppUserModel::create_app_user();

        $return = [];
        $return ['success'] = true;
        $return ['user_no'] = $mAppUser->user_no;

        echo json_encode($return);

//        echo json_encode($mAppUser);
//        echo json_encode('done');

    }//end store

    public function make_discount($id){
        $mAppUser = AppUserModel::find($id);
        $mAppUser->discount_datetime = date('Y-m-d h:i:s');
        $mAppUser->has_gotten_discount = 1;
        $mAppUser->save();
        return Redirect::back();
    }


    public function destroy($id)
    {
        $mNews = NewsModel::find(intval($id));

        if (!empty($mNews->id)) {
            $mNews->deactivate();
        }

        return redirect(NewsModel::get_news_url());
    }


    private function getFormValidationMessages()
    {
        return array(
            'title.required' => "???? ????? ??? ?????",
            'content.required' => "???? ????? ?????",
            'img.max' => "??? ?????? ???? ?????? ???? ??????",
        );
    }//end get validation messages

    private function getFormValidationRules()
    {
        return array(
            'title' => 'required|max:99',
            'content' => 'required|max:2048',
            'img' => 'image|max:3000',
        );
    }//end get validation rules

}//end application user