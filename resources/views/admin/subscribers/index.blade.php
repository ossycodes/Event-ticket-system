@extends('layouts.adminLayout.admin_design')

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
          @include('layouts.errors2')
                   


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              
              @if($subscribers->count() > 0)
            
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>

                <tr>

                  <th>Id</th>
                  <th>Email</th>
                  <th>Subscribed at</th>
                  

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

              @else
                <h5>No Newsletter Subscribers At The Moment</h5>
              @endif
        
            </div>
            <!-- /.card-body -->
          </div>		

@endsection