<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HospitalManagerModel;
use App\Models\UserModel;
use Auth;
use Illuminate\Http\Request as Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input as Input;
use Redirect;
use View;

/*
 * login()
 * post_login()
 * edit_profile()
 * post_edit_profile()
 * getEditFormValidationMessages ()
 */

class Account extends Controller {

	public function login() {

		if (Auth::check()) {
			return redirect('edit-profile');
		}

		$pageTitle = "تسجيل الدخول";
		return View::make('admin/account/login', compact('pageTitle'));
	}//end login

	public function post_login() {
		$userName = Input::get('user-name');
		$password = Input::get('password');
		$remember = booleanValue(Input::get('remember'));

		if (Auth::attempt(array('name' => $userName, 'password' => $password, 'active' => 1), $remember)) {


			if (Auth::check()) {
				return redirect('edit-profile');
			}
		} else {
			$error = "لا يمكن تسجيل الدخول";
			return Redirect::back()->withErrors([$error]);

		}
	}//end post login

	public function edit_profile() {
		$pageTitle = "تعديل الحساب الشخصي";
		$mUser     = Auth::user();
		return view('admin.account.edit-profile', compact('pageTitle', 'mUser'));
	}

	public function post_edit_profile(Requests $request) {
		$rules    = $this->getUpdateEditFormValidationRules(Auth::user());
		$messages = $this->getEditFormValidationMessages();
		$this->validate($request, $rules, $messages);

		UserModel::update_current_user();

		return redirect('edit-profile?msg=2');
	}

	private function getEditFormValidationMessages() {
		return array(
			'user_name.required' => "رجاء إدخال اسم المستخدم",
			'email.unque'        => 'تم استخدام هذا البريد الالكتروني من قبل',

		);
	}//end get validation messages

	private function getUpdateEditFormValidationRules($mUser) {
		return array(
			'name'     => 'alpha_num|required|max:99|unique:users,name,'.$mUser->id,
			'email'    => 'required|max:99|email|unique:users,email,'.$mUser->id,
			'password' => 'confirmed',
			'avatar'   => 'max:1500',

		);
	}//end get validation rules

	public function register() {
		$pageTitle = "إنشاء حساب";
		return View::make('site/account/register', compact('pageTitle'));
	}//end login

	public function store(Requests $request) {
		$messages = $this->getFormValidationMessages();
		$rules    = $this->getFormValidationRules();
		$this->validate($request, $rules, $messages);
		User::saveMember();
		return redirect('done/2');}

	public function edit() {
		if (!Auth::check()) {
			return redirect('/');
		}

		$pageTitle = "تعديل حساب";
		$mUser     = Auth::user();
		return View::make('site/account/register', compact('pageTitle', 'mUser'));
	}

	public function post_edit(Requests $request) {

		$rules    = $this->getUpdateFormValidationRules(Auth::id());
		$messages = $this->getFormValidationMessages();
		$this->validate($request, $rules, $messages);

		$mUser          = Auth::user();
		$mUser->tel     = Request::get('tel');
		$mUser->address = Request::get('address');
		$mUser->name    = Request::get('name');
		$mUser->email   = Request::get('email');
		$mUser->save();
		return redirect('done/3');

	}

	private function getFormValidationMessages() {
		return array(
			'name.required'                  => "رجاء إدخال الاسم رباعي",
			'password.required'              => "رجاء إدخال كملة المرور",
			'password.confirmed'             => "كلمتي المرور غير متطابقتين",
			'password_conformation.required' => 'رجاء إدخال تأكيد كلمة المرور',
			'email.email'                    => 'رجاء إدخال بريد إلكتروني صحيح',
			'email.unique'                   => 'رجاء إدخال بريد الكتروني أخر ، تم التسجيل بهذا البريد من قبل',
			'address.required'               => 'رجاء إدخال البريد الالكتروني',
			'tel.required'                   => 'رجاء إدخال رقم التليفون',
		);
	}
	private function getFormValidationRules() {
		return array(
			'name'                  => 'required|unique:users|max:255',
			'password'              => 'required|confirmed',
			'password_confirmation' => 'required',
			'email'                 => 'required|email|unique:users',
			'address'               => 'required',
			'tel'                   => 'required',

		);

	}

	private function getUpdateFormValidationRules($userId) {
		return array(
			'name'    => 'required|max:255|unique:users,name,id'.$userId,
			'email'   => 'required|unique:users,email,id'.$userId,
			'address' => 'required',
			'tel'     => 'required',
		);

	}

	public function logout() {
		Auth::logout();
		return redirect('admin');
	}

	public function change_password() {
		$this->middleware('auth');

		$pageTitle = "تغير كلمة المرور";
		return View::make('site.account.change-password', compact('pageTitle'));
	}//end change password

	public function post_change_password(Requests $request) {
		$rules    = $this->getChangePasswordValidationRules();
		$messages = $this->getChangePasswordValidationMessages();
		$this->validate($request, $rules, $messages);
		$currPassword = Request::get('current_password');
		$newPassword  = Request::get('password');
		$mUser        = Auth::user();
		if (Hash::check($currPassword, $mUser->password) || !empty($mUser->fb_id)) {
			$mUser->password = Hash::make($newPassword);
			$mUser->save();
			return redirect('done/1');

		} else {
			return Redirect::back()->withErrors(['كلمة المرور الحالية غير صحيحة']);}

	}//end change password

	private function getChangePasswordValidationMessages() {
		return array(
			'password.required'              => "رجاء إدخال كملة المرور",
			'password.confirmed'             => "كلمتي المرور غير متطابقتين",
			'password_conformation.required' => 'رجاء إدخال تأكيد كلمة المرور',

		);
	}
	private function getChangePasswordValidationRules() {
		return array(
			'password'              => 'required|confirmed',
			'password_confirmation' => 'required',
			'current_password'      => 'required',
		);

	}

	/* public function facebook_login(){
return Socialize::with('facebook')->redirect();
}//end facebook login

public function facebook_callback()
{
$fbUser = Socialize::with('facebook')->user();
$fb_id = $fbUser->getId();

if(User::isNewFacebookUser($fb_id)){

$user = User::create([
'name'=> $fbUser->getName(),
'fb_id' => $fbUser->getId(),
]);
Auth::loginUsingId($user->id);
return redirect('/edit-profile');
}else{
$user = User::getUserByFacebookId($fb_id);
Auth::loginUsingId($user->id);
return redirect('/');

}

}//end facebook callback*/

}//end class account