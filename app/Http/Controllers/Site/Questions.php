<?php namespace App\Http\Controllers\Site;

use App\Helpers\APIHelper;
use App\Http\Controllers\Controller;

use App\Models\NewsModel;
use App\Models\ProjectModel;
use App\Models\QuestionsModel;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class Questions extends Controller
{
    /*
    * FAQ Page for male
    */
    public function index ()
    {
        $pageTitle = "أسئلة وإجابات";

        // show Question for each Male Type ( Mans or Females )
        //$division_type = \Auth::user()->gender;
        $mQuestions = QuestionsModel::where('active','=',1)->orderBy('created_at','desc')->paginate(6);
        $lastNews = NewsModel::get_last_news(4);
        $mProject = ProjectModel::get_last_projects(6);
        return view('site.faq.all', compact('pageTitle','mQuestions','lastNews','topNews','mProject'));
    }
    /*
     * FAQ Page for Female
     */
    public function female_index ()
    {
        $pageTitle = "أسئلة وإجابات";
        if(!\Auth::guard('member')->user()){
            alert()->overlay('لا يكمنك الدخول الى هذه الصفحة', 'هذا القسم خاص بالاعضاء فقط .. من فضلك, قم بتسجيل الدخول اولا','warning');
            return redirect('/');
        }
        $gender = \Auth::guard('member')->user()->gender;

        if($gender == 'MALE')
        {

            alert()->error('تنويه هام', 'هذا القسم خاص بالسيدات فقط');
            return redirect('/');
        }
        // show Question for each Male Type ( Mans or Females )
        //$division_type = \Auth::user()->gender;
        $mQuestions = QuestionsModel::where('division_type','=',$gender)->orderBy('created_at','desc')->paginate(6);
        $lastNews = NewsModel::get_last_news(4);
        $topNews = NewsModel::get_top_view_news(4);
        return view('site.faq.all', compact('pageTitle','mQuestions','lastNews','topNews'));
    }

    /*
     * Get Male FAQ by [Angular]
     *
     */
    public function get_FAQ (){


            //System Admin and SuperVisor can see all Question on Site
            if(!\Auth::guard('member')->user())
            {
                $mQuestions = QuestionsModel::where('active','=',1)->orderBy('created_at','desc')->paginate(6);

            }
            else{ // show Question for each Male Type ( Mans or Females )
                $division_type = \Auth::guard('member')->user()->gender;
                $mQuestions = QuestionsModel::where('division_type','=',$division_type)->orderBy('created_at','desc')->get();
            }
            //return response()->json($mQuestions);

            /*$lastNews = NewsModel::get_last_news(4);
            $topNews = NewsModel::get_top_view_news(4);*/
           // return json_encode($mQuestions) ;
            return response()->json($mQuestions) ;
           // return view('site.faq.all', compact('pageTitle','mQuestions','lastNews','topNews'));


    }
    /*
    * Get topNews by [Angular]
    *
    */

    public function get_top_news()
    {
        $topNews = NewsModel::get_top_view_news(10);
        return response()->json($topNews);
    }
    /*
    * Get topNews by [Angular]
    *
    */
    public function get_latest_news()
    {
        $lastNews = NewsModel::get_last_news(10);
        return response()->json($lastNews);
    }



    /*
    * search
    *
    */
    public function search(Request $request){
        $pageTitle = "أسئلة وإجابات";
        $topNews = NewsModel::get_top_view_news(4);
        $lastNews = NewsModel::get_last_news(4);
        $division_type =  \Auth::guard('member')->user()->gender;
        $mQuestions =  QuestionsModel::where('question','LIKE','%'.$request->search.'%')->where('active','=',1)->where('division_type','=',$division_type)->paginate(6);
        return view('site.faq.all', compact('pageTitle', 'mQuestions', 'lastNews', 'topNews'));

    }



    public function question_store(Request $request){


        QuestionsModel::create([

            'question' =>$request->question,
            'active'=> 1,

        ]);

        return redirect('faq');

    }


/*
 * Admin Part
 *
 */
    public function all_faq()
    {
        $pageTitle = "جميع الأسئلة";

        $allQuestions = QuestionsModel::where('active',1)->orderBy('created_at','desc')->get();
        return view('admin.faq.all',compact('allQuestions','pageTitle'));
    }
    public function replay($id)
    {
        $myQ = QuestionsModel::find($id);

        $pageTitle = "الرد على سؤال " ;
        return view('admin.faq.replay', compact('myQ','pageTitle'));

    }
    public function replay_question(Request $request ,$id)
    {
        $id = intval($id);
        $this->validate($request, $this->getFormValidationRules(), $this->getFormValidationMessages());
        QuestionsModel::replay($id);

//        return redirect(ServiceModel::get_services_url()  . "?msg=12");
        return redirect("admin/faq?msg=12");
    }

    public function destroy($id)
    {
        $myQ = QuestionsModel::find(intval($id));

        if(!empty($myQ->id)){
            $myQ->deactivate();
        }

        return redirect('admin/faq?msg=13');
    }

    private function getFormValidationMessages() {
        return array(
            'answer.required'                 => "رجاء إدخال الاجابة",
        );
    }//end get validation messages

    private function getFormValidationRules() {
        return array(
            'answer'               => 'required|max:99',

        );
    }//end get validation rules
}
