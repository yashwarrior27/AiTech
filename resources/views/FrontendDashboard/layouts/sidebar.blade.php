<div class="top_bor_dashbord">
</div>
  <nav class="navbar-expand-lg dashbord_manu " style="overflow:auto ">
     <a class="navbar-brand" href="{{url('/dashboard')}}">
     <img src="{{asset('assets/frontend/img/logo.png')}}" alt="header-Logo" class="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText3">
       <i class="fa fa-bars" aria-hidden="true"></i>
     </button>
     <div class="collapse navbar-collapse2" id="navbarText3">
         <ul class="navbar-nav line">
          <li class="nav-item">
                 <a class="nav-link {{ request()->segment(1)=='dashboard' ?'active': '' }}" href="{{url('/dashboard')}}" ><i class="fa fa-tachometer-alt"></i> Dashboard</a>
             </li>
             <li class="nav-item">
                <a class="nav-link {{ request()->segment(1)=='packages' ?'active': '' }} " href="{{url('packages')}}" ><i class="fa fa-toolbox"></i> Packages</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1)=='wallet' ?'active': '' }}" href="{{url('/wallet')}}"><i class="fa fa-wallet"></i> Wallet</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1)=='level_rewards' ?'active': '' }}" href="{{url('/level_rewards')}}" ><i class="fa fa-gift" aria-hidden="true"></i> Level Rewards</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1)=='rewards' ?'active': '' }}" href="{{url('/rewards')}}" ><i class="fa fa-trophy"></i> Rewards</a>
            </li>
             <li class="nav-item">
                 <a class="nav-link {{ request()->segment(1)=='daily_income' ?'active': '' }}" href="{{url('/daily_income')}}" ><i class="fa fa-signal" aria-hidden="true"></i> Daily ROI Income</a>
             </li>

             <li class="nav-item">
                <a class="nav-link {{ request()->segment(1)=='level_income' ?'active': '' }}" href="{{url('/level_income')}}" ><i class="fa fa-bar-chart" aria-hidden="true"></i>Daily Level Income</a>
            </li>


            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1)=='reward_income' ?'active': '' }}" href="{{url('/reward_income')}}" ><i class="fa fa-pie-chart" aria-hidden="true"></i>Daily Reward Income</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1)=='direct_team' ?'active': '' }}" href="{{url('/direct_team')}}" ><i class="fa fa-sitemap" aria-hidden="true"></i>Direct Team</a>
            </li>
             <li class="nav-item">
                 <a class="nav-link {{ request()->segment(1)=='team' ?'active': '' }}" href="{{url('/team')}}" ><i class="fa fa-toolbox"></i> Team</a>
             </li>

             <li class="nav-item">
                 <a class="nav-link {{ request()->segment(1)=='profile' ?'active': '' }}" href="{{url('/profile')}}" ><i class="fa fa-user"></i> Profile</a>
             </li>
             <li class="nav-item">
                <a class="nav-link {{ request()->segment(1)=='help_desk' ?'active': '' }}" href="{{url('/help_desk')}}" ><i class="fa fa-desktop" aria-hidden="true"></i> Help Desk</a>
            </li>
             <li class="nav-item">
                 <a href="#" class="nav-link" id='logout'><i class="fa fa-sign-in-alt"></i>Logout</a>
             </li>
         </ul>
     </div>
 </nav>
