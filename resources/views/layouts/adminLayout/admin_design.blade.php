<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CinemaXXII | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css') }}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap4.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker-bs3.css') }}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('home') }}" class="nav-link">Home</a>
      </li>

      @unless(Auth::user()->role === "admin")
        <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('contactus') }}" class="nav-link">Contact us</a>
        </li>
      @endunless

    </ul>
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <!-- Notifications Dropdown Menu -->
      @if(Auth::user()->role == "user")
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell-o"></i>
          <span class="badge badge-warning navbar-badge">{{ Auth::user()->unreadNotifications->count() > 0 ? Auth::user()->unreadNotifications->count() : '' }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{ Auth::user()->unreadNotifications->count() }} Notification(s)</span>
          
          <div class="dropdown-divider"></div>
         
          @foreach(Auth::user()->unreadNotifications as $notification)
          <a href="#" class="dropdown-item">
            <a href="" data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope mr-2"></i> {{ str_limit($notification->data['data'],30) }} </a>
            <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
          </a>
          @endforeach

          <br><br><br>

          <a href="{{ url('user/read-notification') }}"><p>{{ Auth::user()->unreadNotifications->count() > 0 ? 'Mark as read' : ' ' }}</p></a>
        </div>
      </li>
      @endif


      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fa fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ Auth::user()->role }} dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">Welcome {{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php
          $segment = Request::segment(2);
          //echo $segment;
          ?>
     
    @if(Auth::user()->role == "admin")
    <!-- If Authenticated as admin, then admin dashboard details goes in here-->   
    @if(Gate::allows('is-Admin'))
    <!-- If User is Authorized as Admin then admin dashoard details goes in here -->
    @can('is-Admin')
    <!-- If User is Authorized as Admin then admin dashoard details goes in here -->
    <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link 
              @if(!$segment)
              active
              @endif
              ">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-tree"></i>
              <p>
                Profile
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('system-admin.profile.index') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>View Profile</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ url('system-admin/admin/change-password') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-edit"></i>
              <p>
                Categories
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('system-admin.categories.index') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>View Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('system-admin.categories.create') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
              </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-edit"></i>
              <p>
                Events
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('system-admin.events.create') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Upload Event</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('system-admin.events.index') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>View Events</p>
                </a>
              </li>
              </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-edit"></i>
              <p>
                Blog
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('system-admin.posts.create') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Upload Post</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('system-admin.posts.index') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>View Posts</p>
                </a>
              </li>
              </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-edit"></i>
              <p>
                Contactus Query
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('system-admin.messages.index') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>View Messages</p>
                </a>
              </li>
              </ul>
          </li>
                    
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-edit"></i>
              <p>
                Subscribers
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('system-admin.subscribers.index') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>View Subscribers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('system-admin/admin/compose-mail') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Send Newsletter</p>
                </a>
              </li>
              </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="" class="nav-link">
              <i class="nav-icon fa fa-edit"></i>
              <p>
                Image sliders
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('system-admin.eventsimagesliders.create') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Upload Sliders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('system-admin.eventsimagesliders.index') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>View Sliders</p>
                </a>
              </li>
              </ul>
          </li>

           <li class="nav-item">
            <a href="{{ route('system-admin.notification.create') }}" class="nav-link">
              <i class="nav-icon fa fa-edit"></i>
              <p>
                Send Notification
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{ route('system-admin.users.index') }}" class="nav-link
              @if($segment == 'news')
              active
              @endif
              ">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('system-admin.admin.transactions') }}" class="nav-link
              @if($segment == 'news')
              active
              @endif
              ">
              <i class="nav-icon fa fa-money"></i>
              <p>
                All Transactions
              </p>
            </a>
          </li>
    
    @endcan
    @endif
    @endif
    <!-- End of admin dashboard section -->  
   
    
    <?php
       $segment = request::segment(2);
    ?>

    @if(Auth::user()->role == "user")
    <!-- If Authenticated as user, then user's dashboard details goes in here--> 
    @if(Gate::denies('is-Admin'))
    <!-- If User is Authorized as User then admin dashoard details goes in here -->
    @cannot('is-Admin')
    <!-- If User is Authorized as User then admin dashoard details goes in here -->

          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link 
              @if(!$segment)
              active
              @endif
              ">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-tree"></i>
              <p>
                Profile
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('user.profile.index') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>View Profile</p>
                </a>
              </li>

              <!-- If the user logged in via facebook hide this button -->
              @if(Auth::user()->password !== '')
              <li class="nav-item">
                <a href="{{ route('user.password') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
              @endif
              <!-- ends here-->

              <li class="nav-item">
                <a href="{{ url('user/delete-account/'.Auth::user()->id) }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Delete Account</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-tree"></i>
              <p>
                Events
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('user.events.create') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Upload Events</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('user.events.index') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Events History</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
          <a href="{{ route('user.transaction') }}" class="nav-link
              @if($segment == 'transactions')
              active
              @endif
              ">
              <i class="nav-icon fa fa-pie-chart"></i>
              <p>
                Transactions
              </p>
            </a>
          </li>
    
    @endcannot 
    @endif     
    @endif
    <!-- End of user dashboard section -->  


          <li class="nav-header">Action</li>
          <li class="nav-item">
             <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="nav-icon fa fa-circle-o text-danger"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
          
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Notification(s)</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      @foreach(Auth::user()->unreadNotifications as $notification)
        <div class="modal-body">
          <strong>Message:<strong> <p>{{ $notification->data['data'] }}</p>
        <strong>Sent: </strong> <p>{{ $notification->created_at->diffForHumans() }} By Admin</p>
        </div>
      @endforeach
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

{{-- 
<script src="{{ asset('js/backend_js/m.js') }}"></script> --}}
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/multipleadd.js') }}"></script>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/knob/jquery.knob.js') }}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquerydataTables.bootstrap4.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
  $(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="key[]" value="" placeholder="Ticket Type" style="color: black; font-size: 13px;  margin-right: 20px;" /><input type="text" name="value[]" value="" placeholder="Price" style="color: black; font-size: 13px;"/> <br><a href="javascript:void(0);" class="remove_button"><i class="fa fa-minus" aria-hidden="true"></i></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
</body>
</html>
