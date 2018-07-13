<aside class="main-sidebar">
<?php $direction = get_locale() == "ar" ? "pull-left" : "pull-right-container" ;
      $angle = get_locale() == "ar" ? "right" : "left" ; ?>
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">{{ __("Members Area") }}</li>
        <!-- Optionally, you can add icons to the links -->
        <!--Members Area-->
        <li><a href="#"><i class="fa fa-link"></i> <span>{{ __("Profile")}}</span></a></li>
        <li><a href="#"><i class="fa fa-shopping-cart"></i> <span>{{ __("Sales")}}</span></a></li>
        <li><a href="#"><i class="fa fa-money"></i> <span>{{ __("My Salary")}}</span></a></li>
        @if(Auth::user()->hasRole('admin'))
        <!--Admins Area-->
        <li class="header">{{ __("Admins Area") }}</li>
          
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>{{ __("Products") }}</span>
            <span class="{{ $direction }}">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">  
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>
        <li class='treeview'>
          <span class="{{ $direction }}">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
        <a href="#"><i class="fa fa-user"></i> <span>{{ __("Accounts")}}</span>
          <span class="{{ $direction }}">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
          <ul class="treeview-menu">  
            <li><a href="#">{{__("Create Account")}}</a></li>
            <li><a href="{{ route('accounts.list') }}">{{__("List Accounts")}}</a></li>
          </ul>
        </li>
          
          <li class='treeview'>
          <span class="{{ $direction }}">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
        <a href="#"><i class="fa fa-users"></i> <span>{{ __("Employees")}}</span>
          <span class="{{ $direction }}">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
          <ul class="treeview-menu">  
            <li><a href="#">{{__("Create Account")}}</a></li>
            <li><a href="#">{{__("List Accounts")}}</a></li>
          </ul>
        </li>
          
          <li class="treeview">
          <a href="#"><i class="fa fa-line-chart"></i> <span>{{ __("Reports") }}</span>
            <span class="{{ $direction }}">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">  
            <li><a href="#">{{__("Today Full Report")}}</a></li>
            <li><a href="#">{{__("Monthly Report")}}</a></li>
            <li><a href="#">{{__("Yearly Report")}}</a></li>
            <li><a href="#">{{__("Period Report")}}</a></li>
          </ul>
        </li>
        <li><a href="#"><i class="fa fa-hdd-o"></i> <span>{{ __("Backup")}}</span></a></li>
                <li><a href="#"><i class="fa fa-wrench"></i> <span>{{ __("Settings")}}</span></a></li>

          
        @endif
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
