
@extends('layouts.adminLayout.admin_design')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Event</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ Route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Add Event</li>
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
 		<form method="post" action="{{ route('user.events.store') }}" enctype="multipart/form-data"> {{ csrf_field() }}
     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Name</label>
       <div class="col-md-6"><input type="text" name="name" class="form-control" value="{{ old('name') }}" required></div>
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
            <option value="{{ $c->id }}">{{ $c->name }}</option>
          @endforeach
           </select>
         </div>
         <div class="clearfix"></div>
         </div>
     </div>     

     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Image</label>
       <div class="col-md-6"><input type="file" name="image" required></div>
       <div class="clearfix"></div>
       </div>
     </div> 
    
     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Venue</label>
       <div class="col-md-6"><textarea name="venue" class="form-control" required>{{ old('venue') }}</textarea></div>
       <div class="clearfix"></div>
       </div>
     </div> 

     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Description</label>
       <div class="col-md-6"><textarea name="description" class="form-control" rows="10px" required>{{ old('description') }}</textarea></div>
       <div class="clearfix"></div>
       </div>
     </div> 

     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Date</label>
       <div class="col-md-6"><input type="text" name="date" class="form-control" value="{{ old('date') }}" required></div>
       <div class="clearfix"></div>
       </div>
     </div>

     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Time</label>
       <div class="col-md-6"><input type="text" name="time" class="form-control" value="{{ old('time') }}"></div>
       <div class="clearfix"></div>
       </div>
     </div>
     
     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Actors</label>
       <div class="col-md-6"><textarea name="actors" class="form-control">{{ old('actors') }}</textarea></div>
       <div class="clearfix"></div>
       </div>
     </div> 

     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Age</label>
       <div class="col-md-6"><input type="text" name="age" class="form-control" value="{{ old('age') }}" required></div>
       <div class="clearfix"></div>
       </div>
     </div>

     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Dresscode</label>
       <div class="col-md-6"><input type="text" name="dresscode" class="form-control" value="{{ old('dresscode') }}" ></div>
       <div class="clearfix"></div>
       </div>
     </div>
     
     <br>
     <h3>Event Ticket Type And Price</h3>
     <br>

     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Regular</label>
       <div class="col-md-6"><input type="number" name="regular" class="form-control" value="{{ old('regular') }}" ></div>
       <div class="clearfix"></div>
       </div>
     </div>
     
     <div class="form-group">
      <div class="row">
       <label class="col-md-3">VIP</label>
       <div class="col-md-6"><input type="number" name="vip" class="form-control" value="{{ old('vip') }}" ></div>
       <div class="clearfix"></div>
       </div>
     </div>

     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Table for 10</label>
       <div class="col-md-6"><input type="number" name="tableforten" class="form-control" value="{{ old('tableforten') }}" ></div>
       <div class="clearfix"></div>
       </div>
     </div>

     <div class="form-group">
      <div class="row">
       <label class="col-md-3">Table for 100</label>
       <div class="col-md-6"><input type="number" name="tableforhundred" class="form-control" value="{{ old('tableforhundred') }}"></div>
       <div class="clearfix"></div>
       </div>
     </div>
     
     

     <div class="form-group">
       <input type="submit" class="btn btn-info" value="Save">
     </div>

    </form>
 	</div>
 </section>			

@endsection