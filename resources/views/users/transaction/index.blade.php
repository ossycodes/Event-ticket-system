@extends('layouts.adminLayout.admin_design')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Transaction History</h1>
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
             
            </div>
            <!-- /.card-header -->

            <div class="card-body">

              @if($transactions->count() > 0)

              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>

                <tr>

                  <th>Status</th>
                  <th>Reference</th>
                  <th>Transaction_id</th>
                  <th>Amount Paid</th>
                  <th>Paid via</th>
                  <th>Event Name</th>
                  <th>Paid</th>
                  <th>Action</th>

                </tr>

                </thead>

                <tbody>
                
                  @php 
                    $userid = Auth::id();
                  @endphp
                  
                  @foreach($transactions as $transaction) 
                    
                   <tr>

                      <td>{{ $transaction->status }}</td>
                      <td>{{ $transaction->reference_id }}</td>
                      <td>{{ $transaction->tran_id }}</td>
                      <td>{{ $transaction->amount/100 }}</td>
                      <td>{{ $transaction->paid_through }}</td>
                      <td>{{ $transaction->event_name }}</td>
                      <td>{{ $transaction->created_at->diffForHumans() }}</td>
                      <td><a href="{{ url("user/{$userid}/download-ticket/{$transaction->id}") }}"><button type="button" class="btn btn-primary">Download Ticket Receipt</button></a></td>

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
                    <th>Paid</th>
                    <th>Action</th>
      
                
                </tr>
                </tfoot>

              </table>

              @else
                <h3 class="card-title">No transactions at the moment</h3>
              @endif


            </div>
            <!-- /.card-body -->
          </div>		

@endsection