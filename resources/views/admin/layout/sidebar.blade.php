<aside class="main-sidebar">
<?php $direction = get_locale() == "ar" ? "pull-left" : "pull-right-container" ;
      $angle = get_locale() == "ar" ? "right" : "left" ; ?>
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Active</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li id='dashboard'><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> <span>{{ __("Home")}}</span></a></li>

        <li class="header">{{ __("Members Area") }}</li>
        <!-- Optionally, you can add icons to the links -->
        <!--Members Area-->
      <li id="accountsprofile"><a href="{{ route('accounts.profile') }}"><i class="fa fa-user"></i> <span>{{ __("Profile")}}</span></a></li>
        <li id='salesmain'><a href="{{route('sales.main')}}"><i class="fa fa-shopping-cart"></i> <span>{{ __("Sales")}}</span></a></li>
        <li class='hidden'><a href="#"><i class="fa fa-money"></i> <span>{{ __("My Salary")}}</span></a></li>
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
            <li id='shiftsmain'><a href="{{route('shifts.main')}}">{{__("Shifts")}}</a></li>
            <li id='suppliersmain'><a href="{{route('suppliers.main')}}">{{__("Suppliers")}}</a></li>
            <li id='categoriesmain'><a href="{{route('categories.main')}}">{{__("Categories")}}</a></li>
            <li id='productsmain'><a href="{{route('products.main')}}">{{__("Products")}}</a></li>
            <li id='inventorymain'><a href="{{route('inventory.main')}}">{{__("Inventory")}}</a></li>
            

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
            <li id='accountscreate'><a href="{{ route('accounts.create')}}">{{__("Create Account")}}</a></li>
            <li id='accountslist'><a href="{{ route('accounts.list') }}">{{__("List Accounts")}}</a></li>
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
              <li id='empmain'><a href="{{route("emp.main")}}">{{__("List Employees")}}</a></li>
            <li id='empatt'><a href="{{route("emp.att")}}">{{__("Employees Attendance")}}</a></li>
          </ul>
        </li>
          
          <li class="treeview">
          <a href="#"><i class="fa fa-line-chart"></i> <span>{{ __("Reports") }}</span>
            <span class="{{ $direction }}">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">  
            <li class='hidden' id='reportstotal'><a href="{{ route('reports.total') }}">{{__("Overall Report")}}</a></li>
            <li id='reportstoday'><a href="{{ route('reports.today') }}">{{__("Current Shift Report")}}</a></li>
            <li id='reportsmonthly'><a href="{{ route('reports.monthly') }}">{{__("Monthly Report")}}</a></li>
            <li id='reportsall'><a href="{{ route('reports.all') }}">{{__("Yearly Report")}}</a></li>
            <li class='hidden' id='reportscustom'><a href="{{ route('reports.custom') }}">{{__("Period Report")}}</a></li>
          </ul>
        </li>
      <li id='backupmain'><a href="{{ route('backup.main') }}"><i class="fa fa-hdd-o"></i> <span>{{ __("Backup")}}</span></a></li>
                <li class='hidden'><a href="#"><i class="fa fa-wrench"></i> <span>{{ __("Settings")}}</span></a></li>        
        @endif
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
  



