@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Post</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ Route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Edit Post</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <!-- Main content -->
 <section class="content">
 	<div class="container-fluid">
 		<form method="post" action="{{ route('system-admin.posts.update', $post->id) }}" enctype="multipart/form-data">{{ csrf_field() }}
            @Method('PUT')

   <div class="form-group">
      <div class="row">
        <label class="col-md-3">Image</label>
          <div class="col-md-9"><input type="file" name="image"></div>
            <div class="clearfix"></div>
            @if(optional($postImage)->imagename)
            <div class="col-md-3"></div>
            <div class="col-md-9">
            <br>
              <img src="{{ asset(optional($postImage)->imagename) }}" style="width: 640px; height: 426px">
              </div>  
            <div class="clearfix"></div>
            @endif
        </div>
      </div> 
      
      
      <div class="form-group">
      <div class="row">
       <label class="col-md-3"> Title </label>
       <div class="col-md-6"><textarea name="title" class="form-control" >{{ $post->title }}</textarea></div>
       <div class="clearfix"></div>
       </div>
     </div> 

      <div class="form-group">
      <div class="row">
       <label class="col-md-3"> Description </label>
       <div class="col-md-6"><textarea name="description" class="form-control" >{{ $post->description }}</textarea></div>
       <div class="clearfix"></div>
       </div>
     </div> 

     <div class="form-group">
      <div class="row">
       <label class="col-md-3"> Body </label>
       <div class="col-md-6"><textarea name="body" class="form-control" rows="20px">{{ $post->body }}</textarea></div>
       <div class="clearfix"></div>
       </div>
     </div> 

     <input type="hidden" name="public_id" value="{{ $blogImage->public_id }}" class="form-control"/>


     <div class="form-group">
       <input type="submit" class="btn btn-info" value="Update">
     </div>

    </form>
 	</div>
 </section>	

 @include('layouts.errors2')		

@endsection