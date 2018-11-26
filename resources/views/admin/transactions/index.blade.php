@extends('layouts.adminLayout.admin_design')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Transactions</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Dashboard</a></li>
              <li class="breadcrumb-item active">All Transactions</li>
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

               

                @if($noOfTransactions > 0)

                <table id="example1" class="table table-bordered table-striped table-responsive">
                  <thead>

                  <tr>
                    
                    <th>Status</th>
                    <th>User Email</th>
                    <th>Reference Id</th>
                    <th>Transaction Id</th>
                    <th>Amount Paid</th>
                    <th>Paid Through</th>
                    <th>Event Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>

                  </tr>

                  </thead>

                  <tbody>
                  
                  @foreach($allTransactions as $transaction)

                  <tr>

                    <td>{{ $transaction->status }}</td>
                    <td>{{ $transaction->user->email }}</td>
                    <td>{{ $transaction->reference_id }}</td>
                    <td>{{ $transaction->tran_id }}</td>
                    <td>{{ $transaction->amount }}</td>
                    <td>{{ $transaction->paid_through }}</td>
                    <td>{{ $transaction->event_name }}</td>
                    <td>{{ $transaction->created_at->toDayDateTimeString() }}</td>
                    <td>{{ $transaction->updated_at->toDayDateTimeString() }}</td>
                    
                    
                  </tr>

                  @endforeach 
                  
                  </tbody>
                  <tfoot>

                  <tr>

                    <th>Status</th>
                    <th>User Email</th>
                    <th>Reference Id</th>
                    <th>Transaction Id</th>
                    <th>Amount Paid</th>
                    <th>Paid Through</th>
                    <th>Event Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                  
                  </tr>
                  </tfoot>

                </table>
            
            @else
               <h3 class="card-title">No transactions  at the moment</h3>
            @endif

          </div>
         
        </div>		

@endsection