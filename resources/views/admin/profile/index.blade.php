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
                       src="../../dist/img/user4-128x128.jpg"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                <p class="text-muted text-center">{{ Auth::user()->email }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Newsletter Subscribers</b> <a class="float-right">{{ $noOfSubscribers }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Registered Users</b> <a class="float-right">{{ $noOfRegisterdUsers }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Events Posted</b> <a class="float-right">{{ $noOfEventsPosted }}</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
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
                {{ Auth::user()->profile->education ? Auth::user()->profile->education : 'Not set yet' }}
                </p>

                <hr>

                <strong><i class="fa fa-map-marker mr-1"></i> Location</strong>

                <p class="text-muted">{{ Auth::user()->profile->location ? Auth::user()->profile->location : 'Not set yet' }}</p>

                <hr>

                <strong><i class="fa fa-pencil mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">{{ Auth::user()->profile->skills ? Auth::user()->profile->skills : 'Not set yet' }}</span>
                  
                </p>

                <hr>

                <strong><i class="fa fa-file-text-o mr-1"></i> Phonenumber</strong>

                <p class="text-muted">{{ Auth::user()->profile->phonenumber ? Auth::user()->profile->phonenumber : 'Not set yet' }}</p>
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
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                          <a href="#">{{ $commentOnEvent->name }}</a>
                          <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a>
                        </span>
                        <span class="description">Commented on {{ $commentOnEvent->event->name }} Event - {{ $commentOnEvent->created_at->diffForHumans() }}</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        {{ $commentOnEvent->message }}
                      </p>

                      <p>
                        <a href="#" class="link-black text-sm mr-2"><i class="fa fa-share mr-1"></i> Share</a>
                        <a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up mr-1"></i> Like</a>
                        <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="fa fa-comments-o mr-1"></i> Comments (5)
                          </a>
                        </span>
                      </p>

                      <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                    </div>
                    <!-- /.post -->

                    <!-- Post -->
                    <div class="post clearfix">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">{{ $message->name }}</a>
                          <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a>
                        </span>
                        <span class="description">Sent you a message - {{ $message->created_at->diffForHumans() }}</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                      {{ $message->message }}.
                      </p>

                      <form class="form-horizontal">
                        <div class="input-group input-group-sm mb-0">
                          <input class="form-control form-control-sm" placeholder="Response">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-danger">Send</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.post -->

                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">USERS</a>
                          <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a>
                        </span>
                        <span class="description">Registed Users</span>
                      </div>
                      <!-- /.user-block -->
                      <div class="row mb-3">
                      @foreach($registeredUsers as $user)
                        <div class="col-sm-12">
                          
                            <span class="username">
                              <a href="#">{{ $user->name }}</a>
                              <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a>
                              <br>
                            </span>
                          
                            <span class="description">Registered {{ $user->created_at->diffForHumans() }}</span>
                            
                        </div>
                        <!-- /.col -->
                        @endforeach
                        
                      
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <p>
                        <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="fa fa-comments-o mr-1"></i> Comments (5)
                          </a>
                        </span>
                      </p>

                      <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                    </div>
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <ul class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <li class="time-label">
                        <span class="bg-danger">
                          {{ now()->toDayDateTimeString() }}
                        </span>
                      </li>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i>{{ $latestEvent->created_at->diffForHumans() }}</span>

                          <h3 class="timeline-header"><a href="#">{{ $latestEvent->name }} Event </a> Status: {{ ($latestEvent->status == 1) ? 'Active' : 'Not Active' }}</h3>

                          <div class="timeline-body">
                            {{ $latestEvent->description }}
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn {{ ($latestEvent->status == 1) ? 'btn-danger' : 'btn-primary' }} btn-sm">{{ ($latestEvent->status == 1) ? 'De activate' : 'Activate' }}</a>
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-user bg-info"></i>

                      @foreach($usersOnline as $online)
                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> Came Online {{ $online->updated_at->diffForHumans() }} </span>

                          <h3 class="timeline-header no-border"><a href="#">{{ $online->name }}</a> is online
                          </h3>
                        </div>
                      @endforeach  
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-comments bg-warning"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i>{{ $postComment->created_at->diffForHumans() }}</span>

                          <h3 class="timeline-header"><a href="#">{{ $postComment->name }}</a> commented on  <br><strong>{{ $postComment->blog->title }}</strong></h3>

                          <div class="timeline-body">
                            {{ $postComment->message }}
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                     
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-camera bg-purple"></i>

                      </li>
                      <!-- END timeline item -->
                      <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                      </li>
                    </ul>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="{{ Auth::user()->name }}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="{{ Auth::user()->email }}" disabled>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">Phonenumber</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="{{ Auth::user()->profile->phonenumber ? Auth::user()->profile->phonenumber : 'Enter Phonenumber' }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Education</label>

                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="{{ Auth::user()->profile->education ? Auth::user()->profile->education : 'Enter Education' }}"></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Location</label>

                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="{{ Auth::user()->profile->location ? Auth::user()->profile->location : 'Enter location' }}"></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="{{ Auth::user()->profile->skills ? Auth::user()->profile->skills : 'Enter Skills' }}">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Update</button>
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