<?php namespace App\Http\Controllers\Site;

use App\Http\Controllers\Admin\News;
use App\Http\Controllers\Controller;
use App\Models\ClientModel;
use App\Models\followsModel;
use App\Models\HospitalManagerModel;
use App\Models\NewsModel;
use App\Models\OffersImageModel;
use App\Models\OffersModel;
use App\Models\ProjectModel;
use App\Models\UserModel;
use App\Models\VersionModel;
use App\Models\WorkModel;
use Auth;
use Illuminate\Http\Request as Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input as Input;
use Redirect;
use View;
use App\Models\ServiceModel;
use Mail;
use App\Models\ClientTypeModel;

class Pages extends Controller {

    public function home (){
        $pageTitle = "الرئيسية";
        $offers = OffersModel::all();
        //$projects = ProjectModel::where('active','=','1')->orderBy('id','desc')->get();
        //$news = NewsModel::where('active','=','1')->orderBy('id','desc')->get();
        return view('site.home',compact('pageTitle','offers'));
    }

    public function products()
    {
        $pageTitle = "معرض المنتجات";

        return view('site.products', compact('pageTitle'));
    }
    public function agencies()
    {
        $pageTitle = "التوكيلات";

        return view('site.agencies', compact('pageTitle'));
    }
    public function about_us()
    {
        $pageTitle = "من نحن ؟";

        return view('site.about-us', compact('pageTitle'));
    }
    public function offers()
    {
        $pageTitle = "العروض والخصومات";

        $offers = OffersModel::where('active','=','1')->paginate(10);
        $mOffers = OffersModel::get_top_view_offers(6);
        return view('site.offers', compact('pageTitle','offers','mOffers'));
    }//end about
    //
     public function single_offer($id)
    {
        $Offer = OffersModel::find($id);

        if(empty($Offer->title))
            return redirect('/');

        $Offer->page_views = $Offer->page_views + 1; // or 'page_views'`
        $Offer->save();

        $pageTitle = $Offer->title;
        $mOffers = OffersModel::get_top_view_offers(6);
        $lastOffers = OffersModel::get_last_offers(6,$id);
        $offerImages = OffersImageModel::get_offer_all_images($id);

        return view('site.single-offer', compact('pageTitle','Offer','mOffers','offerImages','lastOffers'));
    }//end about

    public function single_news($id)
    {
        $mNews = NewsModel::find($id);
        if(empty($mNews->title))
            return redirect('/');

        $pageTitle = $mNews->title;
        $news = NewsModel::get_last_news('7',$id);
       $projects = ProjectModel::get_last_projects(6);
        return view('site.news.single', compact('pageTitle','news','mNews','projects'));
    }//end about

    public function contact()
    {
        $pageTitle = "تواصل معنا";
        return view('site.contact', compact('pageTitle'));
    }//end contact

    public function post_contact(Requests $request){
        $this->validate($request, $this->get_contact_form_validation_rules(), $this->get_contact_form_validation_messages());
          $name  = Input::get('name');
           $text  = Input::get('msg');
           $title  = Input::get('subject');
           $email = Input::get('email');

           Mail::send(['html' => 'emails.contact'], ['text' => $text,'email'=>$email,'name'=>$name,'title'=>$title], function ($message) use ($email, $title, $text) {
               $message->from($email, $title);

               $message->to('info@alromanygroup.com')->subject($title);
           });
//        return Redirect('/');
    }//end post contact

    private function get_contact_form_validation_messages() {
        return array(
            'title.required'                => "رجاء إدخال الاسم",
        );
    }//end get validation messages

    private function get_contact_form_validation_rules()
    {
        return array(
            'name' => 'required',
            'msg' => 'required',
            'email' => 'required',
            'subject' => 'required',
        );
    }

    public function services(){
        $pageTitle = "خدمات المكتب";
        return view('site.services',compact('pageTitle'));

    }

    public function portfolio(){
        $works = WorkModel ::where('active','=','1')->orderBy('id','desc')->get();
        $pageTitle = "سابقة الأعمال";
        $types = WorkModel::get_types_array();
        return view('site.portfolio',compact('works','pageTitle','types'));

    }

    public function teams(){
        $pageTitle = "فريق عمل الديار";

        return view('site.teams',compact('pageTitle'));
    }

}//end pages