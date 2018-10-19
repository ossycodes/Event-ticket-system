@extends('layouts.adminLayout.admin_design')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Transactions</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Dashboard</a></li>
              <li class="breadcrumb-item active">Transactions</li>
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
             
             <?php
                //counts the number of events in database
                 //$noOfEvents = count($events);     
              ?> 

            {{-- @if($noOfEvents > 0) --}}

            <h3 class="card-title">Transaction History</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>

                <tr>

                  <th>Status</th>
                  <th>Reference</th>
                  <th>Transaction_id</th>
                  <th>Amount Paid</th>
                  <th>Paid via</th>
                  <th>Event Name</th>
                  <th>Paid At</th>

                </tr>

                </thead>

                <tbody>
                
                  
                  @foreach($transactions as $transaction) 
                <tr>

                  
                  
                  <td>{{ $transaction->status }}</td>
                  <td>{{ $transaction->reference_id }}</td>
                  <td>{{ $transaction->tran_id }}</td>
                  <td>{{ $transaction->amount }}</td>
                  <td>{{ $transaction->paid_through }}</td>
                  <td>{{ $transaction->event_name }}</td>
                  <td>{{ $transaction->created_at->diffForHumans() }}</td>
                 
                  

                </tr>
                @endforeach 
                
                
                </tbody>
                <tfoot>

                <tr>

                    <th>Status</th>
                    <th>Reference</th>
                    <th>Transaction_id</th>
                    <th>Amount Paid</th>
                    <th>Paid via</th>
                    <th>Event Name</th>
                    <th>Created At</th>
      
                
                </tr>
                </tfoot>

              </table>

              {{-- @else --}}

                {{-- <p>You have not uploaded any event yet.</p> --}}

              {{-- @endif --}}


            </div>
            <!-- /.card-body -->
          </div>		

@endsection