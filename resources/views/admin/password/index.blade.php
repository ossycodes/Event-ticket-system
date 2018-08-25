@extends('layouts.adminLayout.admin_design')
@section('content')


 @include('layouts.errors2')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Change Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ Route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <!-- Main content -->
 <section class="content">
 	<div class="container-fluid">
 		<form method="post" action="{{ url('system-admin/admin/update-password') }}">{{ csrf_field() }}
     <div class="form-group">

      <div class="row">
       <label class="col-md-3"> Old Password </label>
       <div class="col-md-6"><input type="password" name="old_password" class="form-control" ></div>
       <div class="clearfix"></div>
       </div>
      </div> 


    <div class="row">
       <label class="col-md-3"> New Password </label>
       <div class="col-md-6"><input type="password" name="new_password" class="form-control" ></div>
       <div class="clearfix"></div>
       </div>
    </div> 
      


     <div class="form-group">
       <input type="submit" class="btn btn-info" value="Change">
     </div>

    </form>
 	</div>
 </section>	

		

@endsection