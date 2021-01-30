
    <!--Left navigation section start-->
    <section id="left-navigation">
        <!--Left navigation user details start-->
        <div class="user-image">
            <img  class="img-responsive" src="{{URL::asset(Auth::user()->img)}}" alt="{{Auth::user()->name}}"/>
            <div class="user-online-status"><span class="user-status is-online  "></span> </div>
        </div>
        <!--Left navigation user details end-->

        <!--Phone Navigation Menu icon start-->
        <div class="phone-nav-box visible-xs">
            <a class="phone-logo" target="_blank" href="{{URL::to('/')}}" title={{\App\Models\PrefsModel::get_title_value()}}>
                <h1>{{\App\Models\PrefsModel::get_title_value()}}</h1>
            </a>
            <a class="phone-nav-control" href="javascript:void(0)">
                <span class="fa fa-bars"></span>
            </a>
        </div>
        <!--Phone Navigation Menu icon start-->

        <!--Left navigation start-->
        <ul class="mainNav">

            <li class="active">
                <a href="{{URL::to('edit-profile')}}">
                    <i class="fa fa-pencil-square-o"></i> <span>تعديل البيانات الشخصية</span>
                </a>
            </li>

            <li class="active">
                <a href="{{URL::to('admin/prefs')}}">
                    <i class="fa fa-pencil-square-o"></i> <span>بيانات الموقع</span>
                </a>
            </li>


            @if(\App\Models\UserModel::isManger())
                    <li><a id="managers" href="{{URL::to('admin/managers')}}"><span> <i class="fa fa-users-cog"></i>المديرون</span></a></li>
            @endif

            <li><a id="application_users" href="{{URL::to('admin/application-users')}}">
                <span>  <i class="fa fa-users"></i>مستخدمي التطبيق</span></a>
            </li>

            {{--
                        <li>
                            <a id="news"  href="#"> <i class="fa fa-suitcase"></i> <span>الأخبار</span></a>
                            <ul>
                                <li><a href="{{URL::to('admin/news/add')}}"><span>إضافة خبر</span></a></li>
                                <li><a href="{{URL::to('admin/news')}}"><span>كل الأخبار</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a id="news"  href="#"> <i class="fa fa-suitcase"></i> <span>المتابعات</span></a>
                            <ul>
                                <li><a href="{{URL::to('admin/follows/add')}}"><span>إضافة متابعه</span></a></li>
                                <li><a href="{{URL::to('admin/follows')}}"><span>كل المتابعات</span></a></li>
                            </ul>
                        </li>


                        <li><a id="managers" href="{{URL::to('admin/faq')}}"><span> <i class="fa fa-question"></i>أسئلة واجابات </span></a></li>--}}

  {{--          <li>
                <a id="offers" href="#"> <i class="fa fa-suitcase"></i> <span>العروض</span></a>
                <ul>
                    <li><a href="{{URL::to('admin/offers/add')}}"><span>إضافة عرض</span></a></li>
                    <li><a href="{{URL::to('admin/offers')}}"><span>كل العروض</span></a></li>
                </ul>
            </li>--}}

            <li>
                <a id="categories" href="#"> <i class="fa fa-address-card"></i> <span>التصنيفات</span></a>
                <ul>
                    <li><a href="{{URL::to('admin/cat/add')}}"><span>إضافة تصنيف</span></a></li>
                    <li><a href="{{URL::to('admin/cats')}}"><span>كل التصنيفات</span></a></li>
                </ul>
            </li>

            <li>
                <a id="products" href="#"> <i class="fa fa-cubes"></i> <span>المنتجات</span></a>
                <ul>
                    <li><a href="{{URL::to('admin/product/add')}}"><span>إضافة منتج</span></a></li>
                    <li><a href="{{URL::to('admin/products')}}"><span>كل المنتجات</span></a></li>
                </ul>
            </li>

            <li>
                <a id="project-configuration" href="#"> <i class="fa fa-suitcase"></i> <span>برنامج الوفاء</span></a>
                <ul>
                    <li><a href="{{URL::to('admin/project-configuration')}}" id="project-configuration"><span>إعدادات برنامج الوفاء</span></a></li>
                    <li><a href="{{URL::to('admin/employees')}}" id="employees"><span>الفنيين</span></a></li>
                    <li><a href="{{URL::to('admin/clients')}}" id="clients"><span>العملاء</span></a></li>
                    <li><a href="{{URL::to('admin/projects')}}" id="projects2"><span>عمليات الشراء</span></a></li>
                    {{-- <li><a href="{{URL::to('admin/equivalents')}}" id="equivalents"><span>صرف المكافاءات</span></a></li> --}}
                </ul>
            </li>
            
            {{-- <li>
                <a id="clients" href="#"> <i class="fa fa-suitcase"></i> <span>العملاء</span></a>
                <ul>
                    <li><a href="{{URL::to('admin/clients/add')}}"><span>إضافة عميل</span></a></li>
                    <li><a href="{{URL::to('admin/clients')}}"><span>كل عميل</span></a></li>
                </ul>
            </li> --}}

            <li><a href="{{URL::to('logout')}}">
                    <i class="fa fa-power-off"></i>تسجيل الخروج
                </a></li>
        </ul>
        <!--Left navigation end-->
    </section>
    <!--Left navigation section end-->
