<?php namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ClientModel;
use App\Models\HospitalManagerModel;
use App\Models\UserModel;
use Auth;
use Redirect;
use View;
use App\Models\ServiceModel;


class Service extends Controller
{

    public function ar_index()
    {
        $pageTitle = "الخدمات";
        return view('site.ar.services.all', compact('pageTitle'));
    }

    public function ar_single($id){
        $mService = ServiceModel::findOrNew($id);
        if(!$mService->active){
            return redirect('/');
        }
        $pageTitle = $mService->title;
        return view('site.ar.services.single',compact('pageTitle','mService'));
    }
     public function en_index()
        {
            $pageTitle = "Services";
            return view('site.en.services.all', compact('pageTitle'));
        }

        public function en_single($id){
            $mService = ServiceModel::findOrNew($id);
            if(!$mService->active){
                return redirect('/');
            }
            $pageTitle = $mService->title;
            return view('site.en.services.single',compact('pageTitle','mService'));
        }

}