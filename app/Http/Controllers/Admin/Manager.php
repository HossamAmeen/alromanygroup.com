<?php namespace App\Http\Controllers\admin;

use App\Helpers\ValidatorHelper;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use Auth;
use Illuminate\Http\Request as Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;
use View;

class Manager extends Controller {

	public function __construct() {
		//   $this->middleware('checkAdmin');

	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$users     = UserModel::getAllManagers();
		$pageTitle = "كل المديرين";
		return View::make('admin.manager.all-managers', compact('users', 'pageTitle'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function profile() {
		$mUser     = Auth::user();
		$pageTitle = "الحساب الشخصي";
		return View::make('admin.manager.profile', compact('mUser', 'pageTitle'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$pageTitle = "إضافة مدير";
		return View::make('admin.manager.add-manager', compact('pageTitle'));

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests $request) {
		if(!ValidatorHelper::check_logged_user_password()){
			return Redirect::back()->withErrors('كلمة المرور خاطئة');
		}

		$messages  = $this->getFormValidationMessages();
		$rules     = $this->getFormValidationRules();
		$validator = $this->validate($request, $rules, $messages);
		UserModel::saveManager();
		return redirect('admin/managers?msg=11');

	}

	private function getFormValidationMessages() {
		return array(
			'name.required'                  => "رجاء إدخال الاسم رباعي",
			'name.unique'                    => "لقد تم استخدام اسم المستخدم هذا من قبل",
			'name.max'                       => "لقد تجاوزت الحد الأقصى لاسم المستخدم",
			'password.required'              => "رجاء إدخال كملة المرور",
			'password.confirmed'             => "كلمتي المرور غير متطابقتين",
			'password_conformation.required' => 'رجاء إدخال تأكيد كلمة المرور',
			'email.email'                    => 'رجاء إدخال بريد إلكتروني صحيح',
			'email.unique'                   => 'رجاء إدخال بريد الكتروني أخر ، تم التسجيل بهذا البريد من قبل',
			'address.required'               => 'رجاء إدخال البريد الالكتروني',
			'tel.required'                   => 'رجاء إدخال رقم التليفون',
			'role.required'                   => 'يجب تحديد صلاحية المدير',
		);
	}
	private function getFormValidationRules() {
		return array(
			'name'                  => 'required|max:255|unique:users,name',
			'password'              => 'required|confirmed',
			'password_confirmation' => 'required',
			'email'                 => 'required|unique:users,email',
			'role'                  => 'required|integer',

		);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit_profile($id, Requests $request) {
		$rules     = $this->getUpdateFormValidationRules($id);
		$messages  = $this->getUpdateFormValidationMessages();
		$validator = $this->validate($request, $rules, $messages);

		$mUser        = UserModel::find($id);
		$mUser->name  = Request::get('name');
		$mUser->email = Request::get('email');

		$password = Request::get('password');
		if (!empty($password)) {
			$mUser->password = Hash::make($password);
		}
		$image = $this->storeImage($request, 'avatar', 'uploads/profiles');
		if (!empty($image)) {
			$mUser->image = $image;
		}
		$mUser->save();
		return redirect('admin/profile?msg=12');
	}//end edit

	public function edit($id){
		$mManager = UserModel::find($id);
		$pageTitle = "تعديل مدير";
		return view('admin.manager.update',compact('mManager','pageTitle'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Requests $request) {
		if(!ValidatorHelper::check_logged_user_password()){
			return Redirect::back()->withErrors('كلمة المرور خاطئة');
		}

		$messages  = $this->getFormValidationMessages();
		$rules     = $this->getUpdateFormValidationRules($id);
		$validator = $this->validate($request, $rules, $messages);
		UserModel::update_user($id);
		return redirect('admin/managers?msg=12');

	}

	public function edit_role($id) {
		if ($id != 1) {
			$role = Request::get('role');
			if ($role == 1 || $role == 10) {
				$mUser = UserModel::find($id);

				$mUser->role = $role;
				$mUser->save();
			}
		}
		return redirect('admin/managers?msg=12');
	}

	private function getUpdateFormValidationMessages() {
		return array(
			'name.required'                  => "رجاء إدخال اسم المستخدم",
			'password.required'              => "رجاء إدخال كملة المرور",
			'password.confirmed'             => "كلمتي المرور غير متطابقتين",
			'password_conformation.required' => 'رجاء إدخال تأكيد كلمة المرور',
			'email.email'                    => 'رجاء إدخال بريد إلكتروني صحيح',

		);
	}
	private function getUpdateFormValidationRules($userId = null) {
		return array(
			'name'     => 'required|max:255|unique:users,name,'.$userId,
			'password' => 'confirmed',
			'email'    => 'required|unique:users,email,'.$userId,

		);

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		if ($id != 1) {
			$mUser = UserModel::find(intval($id));
			if (!empty($mUser->name)) {
				$mUser->active = 0;
				$mUser->save();
			}
		}
		return redirect('admin/managers?msg=13');
	}//end destroy


}//end manager
