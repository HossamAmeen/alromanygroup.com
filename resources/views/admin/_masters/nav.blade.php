
<!--Navigation Top Bar Start-->
<nav class="navigation">
    <div class="container-fluid">
        <!--Logo text start-->
        <div class="header-logo">
            <a href="{{URL::to('/')}}" title={{\App\Models\PrefsModel::get_title_value()}}>
                <h1>{{\App\Models\PrefsModel::get_title_value()}}</h1>
            </a>
        </div>
        <!--Logo text End-->
        <div class="top-navigation">
            <!--Collapse navigation menu icon start -->
            <div class="menu-control hidden-xs">
                <a href="javascript:void(0)">
                    <i class="fa fa-bars"></i>
                </a>

            </div>

            <!--Collapse navigation menu icon end -->
            <!--Top Navigation Start-->

            <ul>

            </ul>
            <!--Top Navigation End-->
        </div>
    </div>
</nav>
<!--Navigation Top Bar End-->