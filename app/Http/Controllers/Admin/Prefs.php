<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

//use App\Models\PrefsModel;
use App\Models\PrefsModel;
use Illuminate\Support\Facades\Input as Input;
use Auth;
use Illuminate\Http\Request as Requests;

use Redirect;
use Request;
use View;

class Prefs extends Controller {

	public function index() {
		$pageTitle = "بيانات الموقع";
		$mPrefs    = PrefsModel::find(1);
		return View::make('admin/prefs', compact('pageTitle','mPrefs'));
	}//end function prefs

	public function update(Requests $request) {

		PrefsModel::update_prefs();
		return redirect('admin/prefs?msg=1');
	}//end update

	public function toggle_online_support(){
		$mPrefs= PrefsModel::find(1);
		$mPrefs->online_support  = !$mPrefs->online_support;
		$mPrefs->save();
		$url = explode('?',$_SERVER['HTTP_REFERER'])[0]."?msg=100";
		return redirect($url);
	}
}//end prefs class