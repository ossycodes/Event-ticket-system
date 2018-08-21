@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        
        <div class="col-md-8">
           
            <div class="card">
               
                <div class="card-header">Dashboard</div>

                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- If Authenticated as admin, then admin dashboard details goes in here-->    
                        @if(Auth::user()->role == "admin")
                        
                        You are logged in as Admin!
                    
                        <a href ="{{ url('system-admin/users') }}">View Users</a>
                        <a href ="{{ url('system-admin/events') }}">View Events</a>
                        <a href ="{{ url('system-admin/categories') }}">View Categories</a>

                        @endif
                        <!-- End of admin dashboard section -->

                        <!-- IF Authenticated as User, then user's dashboard goes in here -->
                        @if(Auth::user()->role == "user")

                        You are logged in as user    

                        @endif
                        <!-- End of user's dashboard -->

                    </div>
                
                </div>

            </div>
        
        </div>
   
    </div>

</div>

@endsection
