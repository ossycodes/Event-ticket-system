@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ Route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Add Category</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <!-- Main content -->
 <section class="content">
 	<div class="container-fluid">
 		<form method="post" action="{{ route('system-admin.categories.store') }}">{{ csrf_field() }}
     <div class="form-group">
      <div class="row">
       <label class="col-md-3"> Name </label>
       <div class="col-md-6"><input type="text" name="name" class="form-control" required></div>
       <div class="clearfix"></div>
       </div>
     </div> 
     <div class="form-group">
       <input type="submit" class="btn btn-info" value="Save">
     </div>

    </form>
 	</div>
 </section>	

 @include('layouts.errors2')		

@endsection