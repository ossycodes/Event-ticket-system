@extends('layouts.adminlayout.admin_design')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Contactus Messages</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Dashboard</a></li>
              <li class="breadcrumb-item active">Contactus Messages</li>
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
            <!-- /.card-header -->
            <div class="card-body">
                <?php
                    //counts the number of messages in database
                    $noOfMessages = count($messages);
                    //dd($noOfMessages);
                ?>

            @if($noOfMessages)
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>

                <tr>

                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Message</th>
                  <th>Phonenumber</th>
                  <th>Sent At</th>
                  <th>Action</th>

                </tr>

                </thead>

                <tbody>
                
                @foreach($messages as $message)

                <tr>

                  <td>{{ $message->id }}</td>  
                  <td>{{ $message->name }}</td> 
                  <td>{{ $message->email }}</td>
                  <td>{{ $message->message }}</td>
                  <td>{{ $message->phonenumber }}</td>
                  <td>{{ $message->created_at->toDayDateTimeString() }}</td>
                  <td>Delete | Edit</td>
                   
                </tr>
               
                @endforeach 
                
                </tbody>
                <tfoot>

                <tr>

                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Message</th>
                  <th>Phonenumber</th>
                  <th>Sent At</th>
                  <th>Action</th>
                
                </tr>
                </tfoot>

              </table>
            @else
                <h3>No Messages At The Moment.</h3>
            @endif
            </div>
            <!-- /.card-body -->
          </div>		

@endsection