@extends('layouts.adminLayout.admin_design')

@section('content')

@include('layouts.errors2')

<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <a href="{{route('home')}}" class="btn btn-primary btn-block mb-3">Back to Dashboard</a>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Folders</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                  {{--<li class="nav-item">--}}
                    {{--<a href="mailbox.html" class="nav-link">--}}
                      {{--<i class="fa fa-inbox"></i> Inbox--}}
                      {{--<span class="badge bg-primary float-right">12</span>--}}
                    {{--</a>--}}
                  {{--</li>--}}
                  <li class="nav-item">
                    <a class="nav-link">
                      <i class="fa fa-envelope-o"></i> Sent
                      <span class="badge bg-primary float-right">{{$sentNotifcations}}</span>
                    </a>
                  </li>
                  {{--<li class="nav-item">--}}
                    {{--<a href="#" class="nav-link">--}}
                      {{--<i class="fa fa-file-text-o"></i> Drafts--}}
                    {{--</a>--}}
                  {{--</li>--}}
                  <li class="nav-item">
                    <a class="nav-link">
                      <i class="fa fa-filter"></i> Read
                      <span class="badge bg-warning float-right">{{$readNotifications}}</span>
                    </a>
                  </li>
                  {{--<li class="nav-item">--}}
                    {{--<a href="#" class="nav-link">--}}
                      {{--<i class="fa fa-trash-o"></i> Trash--}}
                    {{--</a>--}}
                  {{--</li>--}}
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /. box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Action</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('system-admin.admin.delete-notification')}}"><i class="fa fa-circle-o text-danger"></i> Delete all notification </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#myModal"href="{{route('system-admin.admin.view-notifications')}}"><i class="fa fa-circle-o text-warning"></i> View Notifcations</a>
                  </li>
                  <li class="nav-item">
                    {{--<a class="nav-link" href="#"><i class="fa fa-circle-o text-primary"></i> Social</a>--}}
                  {{--</li>--}}
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Compose New Notification Message</h3>
              </div>
              <!-- /.card-header -->
              <form method="post" action = "{{ route('system-admin.notification.store') }}">{{ csrf_field() }}
              <div class="card-body">
               
                <div class="form-group">
                    <textarea id="compose-textarea" class="form-control" style="height: 300px" name="message" required></textarea>
                </div>
              </div>

              <div class="card-footer">
                <div class="float-right">
                  <input type="submit" class="btn btn-primary fa fa-envelope-o" value="Send" span class="fa fa-envelope-o">
                </div>
              </div>

              </form>
              <!-- /.card-body -->
              
              <!-- /.card-footer -->
            </div>
            <!-- /. box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Sent Notification</h4>

            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            @foreach ($allNotifications as $notification)
             <p>{{ $notification->data }}</p>      
            @endforeach
          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
    
      </div>
   </div>

@endsection