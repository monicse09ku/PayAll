<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('img/avatar.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
                </span>
            </div>
        </form> -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ Request::is('home') ? 'active' : ''}}">
                <a href=" {{ Request::is('home') ? 'javascript:;' : url('home') }}">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
                </a>
            </li>
            @if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
            <li class="{{ Request::is('resellers') ? 'active' : ''}}">
                <a href=" {{ Request::is('resellers') ? 'javascript:;' : url('resellers') }}">
                <i class="fa fa-users"></i>
                <span>Resellers</span>
                </a>
            </li>
            <li class="{{ Request::is('payments') ? 'active' : ''}}">
                <a href=" {{ Request::is('payments') ? 'javascript:;' : url('payments') }}">
                <i class="fa fa-money"></i>
                <span>Payments</span>
                </a>
            </li>
            @endif
            <li class="{{ Request::is('bd-topups') ? 'active' : ''}}">
                <a href=" {{ Request::is('bd-topups') ? 'javascript:;' : url('bd-topups') }}">
                <i class="fa fa-flag"></i>
                <span>Bangladesh</span>
                </a>
            </li>
            <li class="{{ Request::is('ind-topups') ? 'active' : ''}}">
                <a href=" {{ Request::is('ind-topups') ? 'javascript:;' : url('ind-topups') }}">
                <i class="fa fa-flag"></i>
                <span>India</span>
                </a>
            </li>
            <li class="{{ Request::is('pak-topups') ? 'active' : ''}}">
                <a href=" {{ Request::is('pak-topups') ? 'javascript:;' : url('pak-topups') }}">
                <i class="fa fa-flag"></i>
                <span>Pakistan</span>
                </a>
            </li>
            <!-- <li class="treeview">
                <a href="#">
                <i class="fa fa-flag"></i> <span>Nepal</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="javascript:;"><i class="fa fa-circle-o"></i> Top Up</a></li>
                    <li><a href="javascript:;"><i class="fa fa-circle-o"></i> Statements</a></li>
                </ul>
            </li> -->
            <li class="{{ Request::is('profile') ? 'active' : ''}}">
                <a href="javascript:;">
                <!-- <a href=" {{ Request::is('profile') ? 'javascript:;' : url('profile') }}"> -->
                <i class="fa fa-user"></i>
                <span>Profile</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/logout') }}">
                <i class="fa fa-sign-out"></i>
                <span>Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>