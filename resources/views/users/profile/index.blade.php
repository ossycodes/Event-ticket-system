@extends('layouts.adminLayout.admin_design')

@section('content')

<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="../../dist/img/co.png"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                <p class="text-muted text-center">{{ Auth::user()->email }}</p>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fa fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                {{ optional(Auth::user()->profile)->education ? optional(Auth::user()->profile)->education : 'Not set yet' }}
                </p>

                <hr>

                <strong><i class="fa fa-map-marker mr-1"></i> Location</strong>

                <p class="text-muted">{{ optional(Auth::user()->profile)->location ? optional(Auth::user()->profile)->location : 'Not set yet' }}</p>

                <hr>

                <strong><i class="fa fa-pencil mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">{{ optional(Auth::user()->profile)->skills ? optional(Auth::user()->profile)->skills : 'Not set yet' }}</span>
                  
                </p>

                <hr>

                <strong><i class="fa fa-file-text-o mr-1"></i> Phonenumber</strong>

                <p class="text-muted">{{ optional(Auth::user()->profile)->phonenumber ? optional(Auth::user()->profile)->phonenumber : 'Not set yet' }}</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                  
                  @include('layouts.errors2')
    
                    <!-- Post -->
                    <div class="post clearfix">
                        <div class="user-block">
                          <img class="img-circle img-bordered-sm" src="../../dist/img/co.png" alt="User Image">
                          <span class="username">
                            <a href="#">Profile Status</a>
                            <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a>
                          </span>
                          <span class="description"> {{ optional($profile)->phonenumber && optional($profile)->gender && optional($profile)->education && optional($profile)->skills && optional($profile)->location ? 'All profile details has been set, good work man.' : 'Please try  update your profile details , most/some details are missing.'}} </span>
                        </div>
                      </div>
                    <!-- /.post -->

                    <!-- Post -->
                    <div class="post clearfix">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../../dist/img/co.png" alt="User Image">
                        <span class="username">
                          <a href="#">Event Tickets Purchased Status</a>
                          <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a>
                        </span>
                        <span class="description"> {{ $noOfEventTicketsPurchased > 0  ? $noOfEventTicketsPurchased.' '.' tickets purchased.' : 'You have\'nt purchased any tickets yet.' }} </span>
              
                      </div>

                      @if($latestEventTicketsPurchased)
                      @foreach($latestEventTicketsPurchased as $ticket)
                        <p>
                          {{$ticket->event_name}}
                        </p>
                      @endforeach
                      @endif

                    </div>
                    <!-- /.post -->

                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../../dist/img/co.png" alt="User Image">
                        <span class="username">
                          <a href="#">Uploaded Events Status</a>
                          <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a>
                        </span>
                      <span class="description"> {{ $noOfEventUploaded > 0 ? $noOfEventUploaded .' '.'of your uploaded events has been activated by Admin.' : 'none of your events has been activated by Admin.' }} </span>
                      </div>
                      <!-- /.user-block -->
                      <div class="row mb-3">
                        <div class="col-sm-12">
                            <span class="description"></span>
                        </div>

                      </div>

                      @if($eventsuploaded)
                        @foreach($eventsuploaded as $event)
                            <p>
                              {{$event->name}}
                            </p>
                        @endforeach
                      @endif

                    </div>

                  </div>


                  <div class="tab-pane" id="settings">
                    <form method="post" action="{{ route('user.profile.update', Auth::user()->id) }}" class="form-horizontal"/>{{ csrf_field() }}
                      
                      @Method('PUT')
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" placeholder="{{ Auth::user()->name }}" name="name" value="{{ Auth::user()->name }}" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="{{ Auth::user()->email }}" name="email" value="" disabled>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">Phonenumber</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="{{ Auth::user()->profile && Auth::user()->profile->phonenumber ? Auth::user()->profile->phonenumber : 'Enter Phonenumber' }}" value="{{ Auth::user()->profile ? Auth::user()->profile->phonenumber : '' }}" name="phonenumber" required>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">Gender</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="{{ Auth::user()->profile && Auth::user()->profile->gender ? Auth::user()->profile->gender : 'Enter Gender' }}" value="{{ Auth::user()->profile ? Auth::user()->profile->gender : '' }}" name="gender" required>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Education</label>

                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="{{ Auth::user()->profile && Auth::user()->profile->education ? Auth::user()->profile->education : 'Enter Education' }}" name="education" required>{{ Auth::user()->profile ? Auth::user()->profile->education : '' }}</textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Location</label>

                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="{{ Auth::user()->profile && Auth::user()->profile->location ? Auth::user()->profile->location : 'Enter location' }}" name="location" required>{{ Auth::user()->profile ? Auth::user()->profile->location : '' }}</textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="{{ Auth::user()->profile && Auth::user()->profile->skills ? Auth::user()->profile->skills : 'Enter Skills' }}" value="{{ Auth::user()->profile ? Auth::user()->profile->skills : '' }}" name="skills" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" required> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-danger" value="Update"/>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection