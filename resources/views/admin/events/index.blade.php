@extends('layouts.adminlayout.admin_design')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Events</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Dashboard</a></li>
              <li class="breadcrumb-item active">Events</li>
            </ol>
          </div><!-- /.col -->

          <br><br>
          @if(Session::has('flash_message_error'))
          <div class="alert alert-error alert-block">
              <button type="button" class="close" data-dismiss="alert"> x </button>
                <strong>{!! session('flash_message_error') !!}</strong>
          </div>
          @endif
          @if(Session::has('flash_message_success'))
          <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert"> x </button>
                <strong>{!! session('flash_message_success') !!}</strong>
          </div>
          @endif 
                   


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="card">
            <div class="card-header">
            <p>
 			<a href="{{ route('system-admin.events.create') }}" class="btn btn-primary">Add New Event</a>
 		</p>
              <h3 class="card-title">Data Table With Full Features</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

            
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>

                <tr>

                  <th>Id</th>
                  <th>Image</th>
                  <th>Category</th>
                  <th>Name</th>
                  <th>Venue</th>
                  <th>Description</th>
                  <th>Actors</th>
                  <th>Time</th>
                  <th>Date</th>
                  <th>Age</th>
                  <th>Ticket</th>
                  <th>Dress code</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Action</th>

                </tr>

                </thead>

                <tbody>
                
                @foreach($events as $event)

                <tr>

                  <td>{{ $event->id }}</td>   
                  <td><a href="{{ asset($event->image) }}"><img src="{{ asset($event->image) }}" href="{{ asset($event->image) }}" height="100px"/><a/></td>   
                  <td>{{ $event->category->name }}</td>
                  <td>{{ $event->name }}</td>
                  <td>{{ $event->venue }}</td>
                  <td>{{ $event->description }}</td>
                  <td>{{ $event->actors }}</td>
                  <td>{{ $event->time }}</td>
                  <td>{{ $event->date }}</td>
                  <td>{{ $event->age }}</td>
                  <td>{{ $event->ticket }}</td>
                  <td>{{ $event->dresscode }}</td>
                  <td>{{ $event->created_at->toDayDateTimeString() }}</td>
                  <td>{{ $event->updated_at->toDayDateTimeString() }}</td>
                  <td>Delete | Edit</td>
                   
                </tr>
               
                @endforeach 
                
                </tbody>
                <tfoot>

                <tr>

                  <th>Id</th>
                  <th>Image</th>
                  <th>Category</th>
                  <th>Name</th>
                  <th>Venue</th>
                  <th>Description</th>
                  <th>Actors</th>
                  <th>Time</th>
                  <th>Date</th>
                  <th>Age</th>
                  <th>Ticket</th>
                  <th>Dress code</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Action</th>
                
                </tr>
                </tfoot>

              </table>
        
            </div>
            <!-- /.card-body -->
          </div>		

@endsection