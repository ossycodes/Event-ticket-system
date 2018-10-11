@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Post</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ Route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Add Post</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <!-- Main content -->
 <section class="content">
 	<div class="container-fluid">
 		<form method="post" action="{{ route('system-admin.posts.store') }}" enctype="multipart/form-data">{{ csrf_field() }}
     
      <div class="form-group">
        <div class="row">
         <label class="col-md-3">Image</label>
         <div class="col-md-6"><input type="file" name="image" required></div>
         <div class="clearfix"></div>
         </div>
       </div> 


      <div class="form-group">
         <div class="row">
          <label class="col-md-3"> Title </label>
            <div class="col-md-6"><input type="text" name="title" class="form-control" required></div>
              <div class="clearfix">
              </div>
        </div>
      </div> 
      

      <div class="form-group">
      <div class="row">
       <label class="col-md-3"> Description </label>
       <div class="col-md-6"><textarea name="description" class="form-control" required></textarea></div>
       <div class="clearfix"></div>
       </div>
     </div> 

     <div class="form-group">
      <div class="row">
       <label class="col-md-3"> Body </label>
       <div class="col-md-6"><textarea name="body" class="form-control" required></textarea></div>
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