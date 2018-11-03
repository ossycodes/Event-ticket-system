@extends('layouts.adminLayout.admin_design')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Event Comments</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Dashboard</a></li>
              <li class="breadcrumb-item active">Event Comments</li>
            </ol>
          </div><!-- /.col -->

          <br><br>
         @include('layouts.errors2')
                   


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="card">
            <div class="card-header">
            
              <h3 class="card-title">All Comments </h3>
             </div>
              <!-- /.card-header -->
              <div class="card-body">

               

                @if($noOfComments > 0)

                <table id="example1" class="table table-bordered table-striped table-responsive">
                  <thead>

                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>

                  </tr>

                  </thead>

                  <tbody>
                  
                  @foreach($eventComments as $comments)

                  <tr>

                    <td>{{ $comments->name }}</td>
                    <td>{{ $comments->email }}</td>
                    <td>{{ $comments->message }}</td>
                    <td>{{ $comments->created_at->toDayDateTimeString() }}</td>
                    <td>{{ $comments->updated_at->toDayDateTimeString() }}</td>
                    <td>
                    @if($comments->status === 0) 
                      <a href="{{ url('system-admin/admin/activate/'.$comments->id) }}" class="btn btn-success">Activate</a>
                    @endif  
                    @if($comments->status === 1) 
                      <a href="{{ url('system-admin/admin/de-activate/'.$comments->id) }}" class="btn btn-success">De-Activate</a>
                    @endif 
                    </td>
                    <td>
                      <a href="{{ url('system-admin/admin/delete-comment/'.$comments->id) }}" class="btn btn-danger">Delete Comment</a>
                    </td>
                    
                  </tr>
                
                  @endforeach 
                  
                  </tbody>
                  <tfoot>

                  <tr>

                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                  
                  </tr>
                  </tfoot>

                </table>
            
            @else
               <h3 class="card-title">No comments for this event at the moment</h3>
            @endif

          </div>
         
        </div>		

@endsection