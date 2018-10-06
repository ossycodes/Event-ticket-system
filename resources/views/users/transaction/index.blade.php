@extends('layouts.adminlayout.admin_design')

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


                  <th>Reference_id</th>
                  <th>Transaction_id</th>
                  <th>Amount Paid</th>
                  <th>Paid via</th>
                  <th>Event Name</th>
                  <th>Ticket Type</th>
                  <th>Ticket Quantity</th>
                  <th>Paid At</th>

                </tr>

                </thead>

                <tbody>
                
                {{-- @foreach($events as $event) --}}

                <tr>

                  
                  <td>jdhndkdhndkd</td>
                  <td>1929299219</td>
                  <td>5,00000</td>
                  <td>CARD</td>
                  <td>EVENDNR  SNS</td>
                  <td>Regular</td>
                  <td>8</td>
                  <td>128390021</td>
                 
                   
                </tr>
               
                {{-- @endforeach  --}}
                
                </tbody>
                <tfoot>

                <tr>


                    <th>Reference_id</th>
                    <th>Transaction_id</th>
                    <th>Amount Paid</th>
                    <th>Paid via</th>
                    <th>Event Name</th>
                    <th>Quantity</th>
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