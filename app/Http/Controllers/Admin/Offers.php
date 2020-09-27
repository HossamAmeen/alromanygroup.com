<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\OffersImageModel;
use App\Models\OffersModel;
use App\Models\ProjectImageModel;

use Illuminate\Http\Request as Requests;
use Illuminate\Support\Facades\Input as Input;

class Offers extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$offers  = OffersModel::where('active', '=', '1')->orderBy('id', 'desc')->get();
		$pageTitle = "كل العروض";
		return view('admin.offers.all', compact('offers', 'pageTitle'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function create() {
		$pageTitle = "إضافة عرض جديد";
        $phases = OffersModel::get_progress_phase();

        return view('admin.offers.add', compact('pageTitle','phases'));

	}//end store

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests $request) {
		$this->validate($request, $this->getFormValidationRules(), $this->getFormValidationMessages());
        
		$id = OffersModel::create_offer();
		OffersImageModel::store_images($id);
		
		return redirect(OffersModel::get_projects_url());
	}//end store

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {

		$mProject = OffersModel::find($id);
        $phases = OffersModel::get_progress_phase();

        if (empty($mProject->title)) {
			return redirect(OffersModel::get_projects_url());
		}

		$pageTitle = "تعديل مشروع  ".$mProject->title;
		return view('admin.offers.update', compact('mProject', 'pageTitle','phases'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function books($id) {

		$mProject = OffersModel::find($id);
		if (empty($mProject->title)) {
			return redirect(OffersModel::get_projects_url());
		}
        $books = explode(',',$mProject->booked);
        $totalFlats = $mProject->levels * $mProject->level_flats_no;
		$pageTitle = "حجز الوحدات ".$mProject->title;
		return view('admin.project.books', compact('mProject', 'pageTitle','totalFlats','books'));
	}

    public function post_books($id, Requests $request) {

        $mProject = OffersModel::find($id);
        if (empty($mProject->title)) {
            return redirect(OffersModel::get_projects_url());
        }

//	    var_dump($_POST);
        if(is_array(Input::get('books'))){
            $mProject->booked = implode(',',Input::get('books'));
            $mProject->save();
        }

        return redirect('admin/project/' . $mProject->id . '/books?msg=12');

	}//end post books

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Requests $request) {
		$id = intval($id);
		$this->validate($request, $this->getFormValidationRules(), $this->getFormValidationMessages());

		OffersModel::update_project($id);
		return redirect(OffersModel::get_projects_url() . "?msg=12");
	}//end update

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$mProject = OffersModel::find(intval($id));
		if (!empty($mProject->title)) {
			$mProject->deactivate();
		}

		return redirect(OffersModel::get_projects_url().'?msg=13');
	}

	public function images($id){
		$mProject = OffersModel::find($id);
		if (empty($mProject->title)) {
			return redirect(OffersModel::get_projects_url());
		}
		$pageTitle =  "صور "  . $mProject->title ;
		$images = OffersImageModel::get_project_all_images($id);
//		var_dump($images);
		return view('admin.offers.images', compact('pageTitle','mProject','images'));

	}

	public function store_images($id , Requests $request){
			$this->validate($request, $this->getImagesFormValidationRules(), $this->getImagesFormValidationMessages());

		$mProject = OffersModel::find($id);
		if (empty($mProject->title)) {
			return redirect(OffersModel::get_projects_url());
		}
        OffersImageModel::store_images($id);
		return redirect(OffersImageModel::get_project_images_url($id) ."?msg=11");
	}//end store images

	public function delete_image($projectId, $imageId){
		$mImage = OffersImageModel::find($imageId);
		if (!empty($mImage->img)) {
			 $mImage->deactivate();
		}
		return redirect(OffersImageModel::get_project_images_url($projectId) ."?msg=13");
	}

	public function get_projects_byID($id){
        $pageTitle = 'المشروعات';
	    $customProject = OffersModel::get_projects_by_id($id);
       //dd($customProject);
        return view('admin.project.custom-project',compact('pageTitle','customProject'));
    }

	private function getFormValidationMessages() {
		return array(
			'title.required' => "رجاء إدخال عنوان العرض",
			'price.required' => "رجاء إدخال السعر الاساسي",
			'discount.required' => "رجاء إدخال نسبة الخصم",
			'content.required' => "رجاء إدخال وصف العرض",
			'img.max'        => "لقد تجاوزت الحد الأقصى لحجم الصورة",
		);
	}//end get validation messages

	private function getFormValidationRules() {
		return array(
			'title'          => 'required|max:99',
			'price'          => 'required',
			'discount'          => 'required',
			'content'    => 'required|max:2048',
			'img'            => 'image|max:3000',
		);
	}//end get validation rules

	private function getImagesFormValidationMessages() {
		return array(
			'images.required' => "رجاء اختيار الصور",
		);
	}//end get validation messages

	private function getImagesFormValidationRules() {
		return array(
			'images'          => 'required|array',
		);
	}//end get validation rules
}
