@extends('layouts.adminLayout.admin_design')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Image Sliders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Dashboard</a></li>
              <li class="breadcrumb-item active">Image Sliders</li>
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
 			       <a href="{{ route('system-admin.eventsimagesliders.create') }}" class="btn btn-primary">Add New Slider</a>
 	  	     </p>
            
            @if($sliders->count() > 0)

              <h3 class="card-title">All Uploaded Sliders</h3>
             </div>
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped table-responsive">
                  <thead>

                  <tr>
                    
                    <th>Image</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>

                  </tr>

                  </thead>

                  <tbody>
                  
                  @foreach($sliders as $slider)

                  <tr>

                    <td><a href="{{ asset($slider->lider_imagename) }}"><img src="{{ asset($slider->slider_imagename) }}" href="{{ asset($slider->slider_imagename) }}" height="100px"/><a/></td> 
                    <td>{{ $slider->created_at->toDayDateTimeString() }}</td>
                    <td>{{ $slider->updated_at->toDayDateTimeString() }}</td>
                    <td>
                      {{-- <a href="{{ route('system-admin.eventsimagesliders.edit', $slider->id) }}" class="btn btn-info">Edit</a> --}}
                      <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger">Delete</a>
                        <form action="{{ route('system-admin.eventsimagesliders.destroy', $slider->id) }}" method="post">
                          @method('DELETE')
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </td>
                    
                  </tr>
                
                  @endforeach 
                  
                  </tbody>
                  <tfoot>

                  <tr>

                    <th>Image</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                  
                  </tr>
                  </tfoot>

                </table>
            
            @else
               <h3 class="card-title">No Uploaded Slider At The Moment</h3>
            @endif

          </div>
         
        </div>		

@endsection