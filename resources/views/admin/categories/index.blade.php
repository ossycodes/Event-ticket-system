@extends('layouts.adminLayout.admin_design')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Dashboard</a></li>
              <li class="breadcrumb-item active">Categories</li>
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
          
              <p>
 			<a href="{{ route('system-admin.categories.create') }}" class="btn btn-primary">Add New Category</a>
 		          </p>
             
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              
              @if($categories->count() > 0)
            
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>

                <tr>

                  <th>Id</th>
                  <th>Name</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Action</th>

                </tr>

                </thead>

                <tbody>
                
                @foreach($categories as $category)

                <tr>

                  <td>{{ $category->id }}</td>      
                  <td>{{ $category->name }}</td>
                  <td>{{ $category->created_at->toDayDateTimeString() }}</td>
                  <td>{{ $category->updated_at->toDayDateTimeString() }}</td>
                  <td>
                     <a href="{{ route('system-admin.categories.edit', $category->id) }}" class="btn btn-info">Edit</a>
                     <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger">Delete</a>
                     <form action="{{ route('system-admin.categories.destroy', $category->id) }}" method="post">
                      @method('DELETE')
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                  </td>
                   
                </tr>
               
                @endforeach 
                
                </tbody>
                <tfoot>

                <tr>

                  <th>Id</th>
                  <th>Name</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Action</th>
                
                </tr>
                </tfoot>

              </table>

              @else
                  <h5>No Categories Available At The Moment</h5>
              @endif
        
            </div>
            <!-- /.card-body -->
          </div>		

@endsection