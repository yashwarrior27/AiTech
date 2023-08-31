<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo" style="justify-content: space-between;padding:50px;">
        <img src="{{asset('admin_assets/logo.png')}}" class="w-50" alt="">

        <a href="{{url('/admin/logout')}}" class="btn btn-danger btn-sm"><i class='bx bx-log-out'></i></a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
    </div>

    <div class="menu-inner-shadow " style="margin-top: 50px"></div>

    <ul class="menu-inner py-1 mt-2 ">
      <!-- Dashboard -->

      <li class="menu-item  {{ request()->segment(2)=='dashboard' ?'active': '' }}">
        <a href="{{url("/admin/dashboard")}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>

      <li class="menu-item  {{ request()->segment(2)=='users' ?'active': '' }}">
        <a href="{{url('/admin/users')}}" class="menu-link">
            <i class='menu-icon bx bx-user-circle'></i>
          <div data-i18n="Analytics">Users</div>
        </a>
      </li>
      <li class="menu-item  {{ request()->segment(2)=='user-packages' ?'active': '' }}">
        <a href="{{url('/admin/user-packages')}}" class="menu-link">
            <i class='menu-icon bx bx-package'></i>
          <div data-i18n="Analytics">User Packages</div>
        </a>
      </li>
      <li class="menu-item  {{ request()->segment(2)=='buy-package' ?'active': '' }}">
        <a href="{{url('/admin/buy-package')}}" class="menu-link">
            <i class='menu-icon bx bx-purchase-tag' ></i>
          <div data-i18n="Analytics">Buy Package</div>
        </a>
      </li>
      <li class="menu-item  {{ request()->segment(2)=='package-transections' ?'active': '' }}">
        <a href="{{url('/admin/package-transections')}}" class="menu-link">
            <i class='menu-icon bx bx-transfer-alt' ></i>
          <div data-i18n="Analytics">Package Transections</div>
        </a>
      </li>
      <li class="menu-item  {{ request()->segment(2)=='user-level-rewards' ?'active': '' }}">
        <a href="{{url('/admin/user-level-rewards')}}" class="menu-link">
            <i class='menu-icon bx bx-network-chart'></i>
          <div data-i18n="Analytics">User Level Rewards</div>
        </a>
      </li>
      <li class="menu-item  {{ request()->segment(2)=='user-rewards' ?'active': '' }}">
        <a href="{{url('/admin/user-rewards')}}" class="menu-link">
            <i class='menu-icon bx bx-trophy'></i>
          <div data-i18n="Analytics">User Rewards</div>
        </a>
      </li>
      <li class="menu-item  {{ request()->segment(2)=='roi-incomes' ?'active': '' }}">
        <a href="{{url('/admin/roi-incomes')}}" class="menu-link">
            <i class='menu-icon bx bx-bar-chart-alt'></i>
          <div data-i18n="Analytics">Roi Incomes</div>
        </a>
      </li>
      <li class="menu-item  {{ request()->segment(2)=='level-incomes' ?'active': '' }}">
        <a href="{{url('/admin/level-incomes')}}" class="menu-link">
            <i class='menu-icon bx bx-bar-chart-square'></i>
          <div data-i18n="Analytics">Daily Level Incomes</div>
        </a>
      </li>
      <li class="menu-item  {{ request()->segment(2)=='reward-incomes' ?'active': '' }}">
        <a href="{{url('/admin/reward-incomes')}}" class="menu-link">
            <i class='menu-icon bx bx-pie-chart'></i>
          <div data-i18n="Analytics">Daily Reward Incomes</div>
        </a>
      </li>
      <li class="menu-item  {{ request()->segment(2)=='withdrawal-logs' ?'active': '' }}">
        <a href="{{url('/admin/withdrawal-logs')}}" class="menu-link">
            <i class='menu-icon bx bx-wallet'></i>
          <div data-i18n="Analytics">Withdrawal Logs</div>
        </a>
      </li>
      <li class="menu-item  {{ request()->segment(2)=='help-desk-query' ?'active': '' }}">
        <a href="{{url('/admin/help-desk-query')}}" class="menu-link">
            <i class='menu-icon bx bx-help-circle' ></i>
          <div data-i18n="Analytics">HelpDesk Queries</div>
        </a>
      </li>
    </ul>
  </aside>
