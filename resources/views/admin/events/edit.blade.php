
@extends('layouts.adminLayout.admin_design')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Event</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ Route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Edit Event</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @include('layouts.errors2')
        <!-- Main content -->
 <section class="content">
 	<div class="container-fluid">
 		
         <form method="post" action="{{ route('system-admin.events.update', $event->id) }}" enctype="multipart/form-data"> {{ csrf_field() }}
         @Method('PUT')
   
     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Name</label>
       <div class="col-md-6"><input type="text" name="name" class="form-control" value="{{ $event->name }}"></div>
       <div class="clearfix"></div>
       </div>
     </div> 

     <div class="form-group">
        <div class="row">
         <label class="col-md-3">Category</label>
         <div class="col-md-6">
          <select name="category_id" class="form-control" >
          <option value="">Choose Category</option>
          @foreach($categories as $c)
            <option value="{{ $c->id }}" {{ $event->category->id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
          @endforeach
           </select>
         </div>
         <div class="clearfix"></div>
         </div>
     </div>   

     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Image</label>
       <div class="col-md-9"><input type="file" name="image"></div>
         <div class="clearfix"></div>
         @if($event->image)
         <div class="col-md-3"></div>
          <div class="col-md-9">
          <br>
           <img src="{{ asset($event->image)}}" style="width: 256px; height: 380px">
            </div>  
          <div class="clearfix"></div>
         @endif
       </div>
     </div> 
    
     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Venue</label>
       <div class="col-md-6"><textarea name="venue" class="form-control" >{{ $event->dresscode }}</textarea></div>
       <div class="clearfix"></div>
       </div>
     </div> 

     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Description</label>
       <div class="col-md-6"><textarea name="description" class="form-control" rows="10px">{{ $event->description }}</textarea></div>
       <div class="clearfix"></div>
       </div>
     </div> 

     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Date</label>
       <div class="col-md-6"><input type="text" name="date" class="form-control" value="{{ $event->date }}"></div>
       <div class="clearfix"></div>
       </div>
     </div>

     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Time</label>
       <div class="col-md-6"><input type="text" name="time" class="form-control" value="{{ $event->time }}"></div>
       <div class="clearfix"></div>
       </div>
     </div>

     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Tickets Type and Price</label>
       <div class="col-md-6"><textarea name="ticket" class="form-control" >{{ $event->ticket }}</textarea></div>
       <div class="clearfix"></div>
       </div>
     </div> 
     
     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Actors</label>
       <div class="col-md-6"><textarea name="actors" class="form-control" >{{ $event->actors }}</textarea></div>
       <div class="clearfix"></div>
       </div>
     </div> 

     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Age</label>
       <div class="col-md-6"><input type="text" name="age" class="form-control" value="{{ $event->age }}"></div>
       <div class="clearfix"></div>
       </div>
     </div>

     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Dresscode</label>
       <div class="col-md-6"><input type="text" name="dresscode" class="form-control" value="{{ $event->dresscode }}" ></div>
       <div class="clearfix"></div>
       </div>
     </div>

    <input type="text" name="imagename" value="{{ $event->image }}" class="form-control"/>

     <div class="form-group">
       <input type="submit" class="btn btn-info" value="Update" >
     </div>

    </form>
 	</div>
 </section>			

@endsection