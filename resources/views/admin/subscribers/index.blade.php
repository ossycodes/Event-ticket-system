@extends('layouts.adminlayout.admin_design')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Newsletter Subscribers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Dashboard</a></li>
              <li class="breadcrumb-item active">Newsletter Subscribers</li>
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

            
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>

                <tr>

                  <th>Id</th>
                  <th>Email</th>
                  <th>Registered At</th>
                  

                </tr>

                </thead>

                <tbody>
                
                @foreach($subscribers as $subscriber)

                <tr>

                  <td>{{ $subscriber->id }}</td>   
                  <td>{{ $subscriber->email }}</td>
                  <td>{{ $subscriber->created_at ? $subscriber->created_at->toDayDateTimeString() : 'No date given' }}</td>
                  
                   <!-- 
                     <td>
                     <a href="{{ route('system-admin.subscribers.edit', $subscriber->id) }}" class="btn btn-info">Edit</a>
                     <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger">Delete</a>
                     <form action="{{ route('system-admin.subscribers.destroy', $subscriber->id) }}" method="post">
                      @method('DELETE')
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                    </td>
                    -->
                   
                </tr>
               
                @endforeach 
                
                </tbody>
                <tfoot>

                <tr>

                  <th>Id</th>
                  <th>Email</th>
                  <th>Subscribed At</th>
                
                
                </tr>
                </tfoot>

              </table>
        
            </div>
            <!-- /.card-body -->
          </div>		

@endsection